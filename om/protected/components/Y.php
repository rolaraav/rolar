<?php

/**
 * Useful Functions Class for Yii Framework
 *
 * @author Leonid Svyatov <leonid@svyatov.ru>
 * @copyright Copyright (c) 2010 Leonid Svyatov
 * @license http://www.opensource.org/licenses/mit-license.php
 * @version 1.0.0 / 01.11.2010
 */
class Y
{
    /**
     * Возвращает относительный URL приложения
     *
     * @return string
     */
    public static function baseUrl()
    {
        return Yii::app()->baseUrl.'/';
    }

	public static function bu()
	{
		return Yii::app()->getBaseUrl(TRUE).'/';
	}

	public static function bua()
	{
		return Yii::app()->baseUrl.'/admin/';
	}

    /**
     * Возвращает ссылку на кэш-компонент приложения
     *
     * @return CCache
     */
    public static function cache()
    {
        return Yii::app()->cache;
    }

    /**
     * Удаляет кэш с ключом $id
     *
     * @param string $id
     * @return boolean
     */
    public static function cacheDelete($id)
    {
        return Yii::app()->cache->delete($id);
    }

    /**
     * Возвращает значение кэша с ключом $id
     *
     * @param string $id
     * @return mixed
     */
    public static function cacheGet($id)
    {
        return Yii::app()->cache->get($id);
    }

    /**
     * Сохраняет значение $value в кэш с ключом $id на время $expire (сек)
     *
     * @param string $id
     * @param mixed $value
     * @param integer $expire
     * @param ICacheDependency $dependency
     * @return boolean
     */
    public static function cacheSet($id, $value, $expire = 0, $dependency = NULL)
    {
        return Yii::app()->cache->set($id, $value, $expire, $dependency);
    }

    /**
     * Удаляет куку
     *
     * @param string $name
     */
    public static function cookieDelete($name)
    {
        if (isset(Yii::app()->request->cookies[$name]))
        {
            unset(Yii::app()->request->cookies[$name]);
        }
    }

    /**
     * Возвращает значение куки
     *
     * @param string $name
     * @return string|null
     */
    public static function cookieGet($name)
    {
        if (isset(Yii::app()->request->cookies[$name]))
        {
            return Yii::app()->request->cookies[$name]->value;
        }
        else
        {
            return null;
        }
    }

    /**
     * Устанавливает куку
     *
     * @param string $name
     * @param string $value
     * @param integer $expire seconds
     * @param string $path
     * @param string $domain
     */
    public static function cookieSet($name, $value, $expire = null, $path = '/', $domain = null)
    {
        $cookie = new CHttpCookie($name, $value);
        $cookie->expire = $expire ? $expire : (time()+31536000);
        $cookie->path   = $path   ? $path   : '';
        $cookie->domain = $domain ? $domain : '';
        Yii::app()->request->cookies[$name] = $cookie;
    }

    /**
     * Возвращает значение токена CSRF
     *
     * @return string
     */
    public static function csrf()
    {
        return Yii::app()->request->csrfToken;
    }

    /**
     * Возвращает имя токена CSRF (по умолчанию YII_CSRF_TOKEN)
     *
     * @return string
     */
    public static function csrfName()
    {
        return Yii::app()->request->csrfTokenName;
    }

    /**
     * Возвращает готовую строчку для передачи CSRF-параметра в ajax-запросе

     * Пример с использованием jQuery:
     *      $.post('url', { param: 'blabla', <?=Y::csrfJsParam();?> }, ...)
     * будет соответственно заменено на:
     *      $.post('url', { param: 'blabla', [csrfName]: '[csrfToken]' }, ...)
     *
     * @return string
     */
    public static function csrfJsParam()
    {
        return Yii::app()->request->csrfTokenName.":'".Yii::app()->request->csrfToken."'";
    }

    /**
     * Сокращение для функции dump класса CVarDumper для отладки приложения
     *
     * @param mixed $var
     */
    public static function dump($var, $toDie = true)
    {
        echo '<pre>';
        CVarDumper::dump($var, 10, true);
        echo '</pre>';

        if ($toDie)
        {
            Yii::app()->end();
        }
    }

    /**
     * Выводит текст и завершает приложение (применяется в ajax-действиях)
     *
     * @param string $text
     */
    public static function end($text = '')
    {
        echo $text;
        Yii::app()->end();
    }

    /**
     * Выводит данные в формате JSON и завершает приложение (применяется в ajax-действиях)
     *
     * @param string $data
     */
    public static function endJson($data)
    {
        echo json_encode($data);
        Yii::app()->end();
    }

    /**
     * Устанавливает флэш-извещение для юзера
     *
     * @param string $key
     * @param string $msg
     */
    public static function flash($key, $msg)
    {
        Yii::app()->user->setFlash($key, $msg);
    }

    /**
     * Устанавливает флэш-извещение для юзера и редиректит по указанному роуту
     *
     * @param string $key
     * @param string $msg
     * @param string $route
     * @param array $params
     */
    public static function flashRedir($key, $msg, $route, $params = array())
    {
        Yii::app()->user->setFlash($key, $msg);
        Yii::app()->request->redirect(self::url($route, $params));
    }

    /**
     * Возвращает true, если пользователь авторизован, иначе - false
     *
     * @return boolean
     */
    public static function isAuthed()
    {
        return !Yii::app()->user->isGuest;
    }

    /**
     * Возвращает true, если пользователь гость и неавторизован, иначе - false
     *
     * @return boolean
     */
    public static function isGuest()
    {
        return Yii::app()->user->isGuest;
    }

    /**
     * Возвращает пользовательский параметр приложения с именем $key
     *
     * @param string $key
     * @return mixed
     */
    public static function param($key)
    {
        return Yii::app()->params[$key];
    }

    /**
     * Редиректит по указанному роуту
     *
     * @param string $route
     * @param array $params
     */
    public static function redir($route, $params = array())
    {
        Yii::app()->request->redirect(self::url($route, $params));
    }

    /**
     * Редиректит по указанному роуту, если юзер авторизован
     *
     * @param string $route
     * @param array $params
     */
    public static function redirAuthed($route, $params = array())
    {
        if (!Yii::app()->user->isGuest)
        {
            Yii::app()->request->redirect(self::url($route, $params));
        }
    }

    /**
     * Редиректит по указанному роуту, если юзер гость
     *
     * @param string $route
     * @param array $params
     */
    public static function redirGuest($route, $params = array())
    {
        if (Yii::app()->user->isGuest)
        {
            Yii::app()->request->redirect(self::url($route, $params));
        }
    }

    /**
     * Возвращает ссылку на компонент request
     *
     * @return CHttpRequest
     */
    public static function request()
    {
        return Yii::app()->request;
    }

    /**
     * Выводит статистику использованных приложением ресурсов
     *
     * @param boolean $return Определяет возвращать результат или сразу выводить
     * @return string
     */
    public static function stats($return = false)
    {
        $db_stats = Yii::app()->db->getStats();

        if (is_array($db_stats))
        {
            $db_stats = 'Выполнено запросов: '.$db_stats[0].' (за '.round($db_stats[1], 5).' сек.)<br />';
        }

        $memory = round(Yii::getLogger()->memoryUsage/1024/1024, 3);
        $time = round(Yii::getLogger()->executionTime, 3);

        $result = $db_stats;
        $result .= 'Использовано памяти: '.$memory.' Мб<br />';
        $result .= 'Время выполнения: '.$time.' сек.';

        if ($return)
        {
            return $result;
        }
        else
        {
            echo $result;
        }
    }

    /**
     * Создает URL на основе указанного роута и параметров
     *
     * @param string $route
     * @param array $params
     * @return string
     */
    public static function url($route, $params = array())
    {
        if (is_object(Yii::app()->controller))
        {
            return Yii::app()->controller->createUrl($route, $params);
        }
        else
        {
            return Yii::app()->createUrl($route, $params);
        }
    }

    /**
     * Возвращает ссылку на компонент пользователя
     *
     * @return CWebUser
     */
    public static function user()
    {
        return Yii::app()->user;
    }

    /**
     * Возвращает Id текущего пользователя, если он авторизован
     *
     * @return integer
     */
    public static function userId()
    {
        return Yii::app()->user->id;
    }

	public static function isIe ()
	{
		$rq = self::request();
		return (strpos ($rq->userAgent,'MSIE')!==FALSE);
	}

}
