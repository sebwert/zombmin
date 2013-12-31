<?php
namespace Php7admin;

class Messages
{
    private $error = array();
    private $success = array();
    private $info = array();

    private static $instance = null;

    private static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new Messages();
        }
        return self::$instance;
    }
    public static function add($message, $type = 'success')
    {
        return self::getInstance()->addMessage($message, $type);
    }
    public static function get($type = 'success')
    {
        return self::getInstance()->getMessages($type);
    }
    public function addMessage($message, $type)
    {
        array_push($this->$type, $message);
    }
    public function getMessages($type)
    {
        $ret = $this->$type;
        $this->$type = array();

        return $ret;
    }

    public function __construct() {
        $this->error = \Fuel\Core\Session::get('messages.error', array());
        $this->success = \Fuel\Core\Session::get('messages.success', array());
        $this->info = \Fuel\Core\Session::get('messages.info', array());
        \Fuel\Core\Session::set('messages.error', array());
        \Fuel\Core\Session::set('messages.success', array());
        \Fuel\Core\Session::set('messages.info', array());
    }
    public function __destruct() {
        \Fuel\Core\Session::set('messages.error', $this->error);
        \Fuel\Core\Session::set('messages.success', $this->success);
        \Fuel\Core\Session::set('messages.info', $this->info);
    }
}
