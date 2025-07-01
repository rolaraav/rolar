<?php

/** This file is part of KCFinder project
  *
  *      @desc Join all JavaScript files from current directory
  *   @package KCFinder
  *   @version 3.10
  *    @author Pavel Tzonkov <sunhater@sunhater.com>
  * @copyright 2010-2014 KCFinder Project
  *   @license https://opensource.org/licenses/GPL-3.0 GPLv3
  *   @license https://opensource.org/licenses/LGPL-3.0 LGPLv3
  *      @link https://kcfinder.sunhater.com
  */

namespace kcfinder;

chdir("..");
require "core/autoload.php";
$min = new minifier("js");
$min->minify("cache/base.js");

?>