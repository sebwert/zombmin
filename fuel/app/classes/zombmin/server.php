<?php

namespace Zombmin;

class Server 
{
    protected static $instance = null;
    
    public static function _init()
    {

        \Config::loadUserConfig();
        static::setServer(\Config::getServerVersion());
    }
    private static function setServer($version)
    {
        $class_name = '\\Zombmin\\Server_' . ucfirst($version);
        static::$instance = new $class_name();
    }
    public static function get($variable)
    {
        return static::$instance->get($variable);
    }
    public static function getConnectedPlayer()
    {
        return static::$instance->getConnectedPlayer();
    }
    public static function kick($players, $reason = '')
    {
        return static::$instance->kick($players, $reason);
    }
    public static function spawEntity($player_id, $entity_id)
    {
        return static::$instance->spawEntity($player_id, $entity_id);
    }
    public static function isConnectedID($player_id)
    {
        return static::$instance->isConnectedID($player_id);
    }
    public static function ban($players, $time = '1 day',
                                                        $reason = '')
    {
        return static::$instance->ban($players, $time, $reason);
    }
    public static function kickAll($reason = '')
    {
        return static::$instance->kickAll($reason);
    }
    public static function say($string)
    {
        return static::$instance->say($string);
    }
    public static function getPossibleEntities()
    {
        return static::$instance->getPossibleEntities();
    }

}
