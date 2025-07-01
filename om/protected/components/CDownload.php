<?php
/**
 * @author Rasmus Schultz
 * @link http://mindplay.dk
 * @copyright Copyright &copy; 2010 Rasmus Schultz
 * @license https://www.gnu.org/licenses/lgpl-3.0.txt
 */

/**
 * This class allows multi-threaded file downloads, and regular file
downloads.
 *
 * You can use this class when you need to control which users are allowed
to
 * download a file from a protected area of the local filesystem.
 *
 * Note that downloading files in this way does result in some memory and
processor
 * overhead - you should not use this class sporadically for all downloads
in your
 * application, only when a regular download is not possible for some
reason (usually
 * because the file in question must not be made available to the general
public).
 *
 * Avoid using this class when you need to log access to a public file -
you're
 * probably better off using a pre-download logging action, which then
redirects to
 * the actual file download.
 */
class CDownload {

  /**
   * Buffer size (memory requirement per download / user / thread)
   */
  const BUFFER_SIZE = 131072; # = 1024*32

  /**
   * Time limit (time allowed to send one buffer)
   */
  const TIME_LIMIT = 300;

  /**
   * Sends a file to the client.
   *
   * This is a blocking method, which means that the method-call will not
return until
   * the client has completed the download of the file (or segment), or
until the client
   * is disconnected and the connection/download is aborted.
   *
   * Check the return value of this method to see if the download was
successful - this
   * if useful, for example, if you need to count and limit the number of
times a user can
   * download a file; you should increase your counters only if the call
returns TRUE.
   *
   * It is important that your action produces <strong>no other
output</strong> before
   * or after calling this method, as this will corrupt the downloaded
binary file.
   *
   * Output buffers will be cleared and disabled, and any active
CWebLogRoute instances
   * (which might otherwise output logging information at the end of the
request) will
   * be detected and disabled.
   *
   * If your application might produce any other output after your action
completes, you
   * should suppress this by using the exit statement at the end of your
action.
   *
   * This method throws a CException if the specified path does not point
to a valid file.
   *
   * This method throws a CHttpException (416) if the requested range is
invalid.
   *
   * @param string full path to a file on the local filesystem being sent
to the client.
   * @param string optional, alternative filename as the client will see it
(defaults to the local filename specified in $path)
   * @return boolean true if the download succeeded, false if the
connection was aborted prematurely.
   */
  public static function send($path, $name=null)
  {
    // turn off output buffering
    @ob_end_clean();

    // disable any CWebLogRoutes to prevent them from outputting at the end of the request
    foreach (Yii::app()->log->routes as $route)
    if ($route instanceof CWebLogRoute)
      $route->enabled = false;

    // obtain headers:
    $envs = '';
    foreach ($_ENV as $item => $value)
    if (substr($item, 0, 5) == 'HTTP_')
      $envs .= $item.' => '.$value."\n";
    if (function_exists('apache_request_headers')) {
      $headers = apache_request_headers();
      foreach ($headers as $header => $value) {
        $envs .= "apache: $header = $value\n";
      }
    }

    // obtain filename, if needed:
    if (is_null($name))
      $name = basename($path);

    // verify path and connection status:
    if (!is_file($path) || !is_readable($path) || connection_status()!=0)
      throw new CException('CDownload::send() : unable to access local file
"'.$path.'"');

    // obtain filesize:
    $size = filesize($path);

    // configure download range for multi-threaded / resumed downloads:
    if (isset($_ENV['HTTP_RANGE']))
    {
      list($a, $range) = explode("=", $_ENV['HTTP_RANGE']);
    }
    else if (function_exists('apache_request_headers'))
    {
      $headers = apache_request_headers();
      if (isset($headers['Range'])) {
        list($a, $range) = explode("=", $headers['Range']);
      } else {
        $range = false;
      }
    }
    else
    {
      $range = false;
    }

    // produce required headers for partial downloads:
    if ($range)
    {
      header('HTTP/1.1 206 Partial content');
      list($begin, $end) = explode("-", $range);
      if ($begin == '')
      {
        $begin = $size-$end;
        $end = $size-1;
      }
      else if ($end == '')
      {
        $end = $size-1;
      }
      $header = 'Content-Range: bytes '.$begin.'-'.$end.'/'.($size);
      $size = $end-$begin+1;
    }
    else
    {
      $header = false;
      $begin = 0;
      $end = $size-1;
    }

    // check range:
    if (($begin > $size-1) || ($end > $size-1) || ($begin > $end))
      throw new CHttpException(416,'Requested range not satisfiable');

    // suppress client-side caching:
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Expires: ".gmdate("D, d M Y H:i:s", mktime(date("H")+2,
date("i"), date("s"), date("m"), date("d"), date("Y")))." GMT");
    header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");

    // send a generic content-type:
    header("Content-Type: application/octet-stream");

    // send content-range header, if present:
    if ($header) header($header);

    // send content-length header:
    header("Content-Length: ".$size);

    // send content-disposition, with special handling for IE:
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
    {
      header("Content-Disposition: inline; filename=".str_replace(' ',
'%20', $name));
    }
    else
    {
      header("Content-Disposition: inline; filename=\"$name\"");
    }

    // set encoding:
    header("Content-Transfer-Encoding: binary\n");

    // stream out the binary data:
    if ($file = fopen($path, 'rb'))
    {
      fseek($file, $begin);
      $sent = 0;
      while ($sent < $size)
      {
        set_time_limit(self::TIME_LIMIT);
        $bytes = $end - ftell($file) + 1;
        if ($bytes > self::BUFFER_SIZE)
          $bytes = self::BUFFER_SIZE;
        echo fread($file, $bytes);
        $sent += $bytes;
        flush();
        if (connection_aborted())
          break;
      }
      fclose($file);
    }

    // check connection status and return:
    $status = (connection_status()==0) and !connection_aborted();
    return $status;
  }

}