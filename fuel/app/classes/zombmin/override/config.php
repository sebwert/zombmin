<?php
class Config extends \Fuel\Core\Config{

    static $userConfigFile = 'user_config.php';
    static function getGaclOptions()
    {
        $gacl_options = array(
                        'debug' => false,
                        'items_per_page' => 100,
                        'max_select_box_items' => 100,
                        'max_search_return_items' => 200,
                        'db_type' => 'mysql',
                        'db_host' =>
                            $config->getConfigVal('/config/database/host'),
                        'db_user' =>
                            $config->getConfigVal('/config/database/user'),
                        'db_password' =>
                            $config->getConfigVal('/config/database/pw'),
                        'db_name' =>
                            $config->getConfigVal('/config/database/name'),
                        'db_table_prefix' => '',
                        'caching' => FALSE,
                        'force_cache_expire' => TRUE,
                        'cache_dir' => '/tmp/phpgacl_cache',
                        'cache_expire_time' => 600
        );
        return $gacl_options;
    }
    public static function getBootstrapPath() {
        $canonical_path = static::get('base_url', '/');
        return $canonical_path . 'assets/dist';
    }
    public static function getCSSPath() {
        $canonical_path = static::get('base_url', '/');
        return $canonical_path . 'assets/css';
    }
    public static function getImagePath() {
        $canonical_path = static::get('base_url', '/');
        return $canonical_path . 'assets/images';
    }
    public static function getJsPath() {
        $canonical_path = static::get('base_url', '/');
        return $canonical_path . 'assets/js';
    }
    public static function getTelnetPort() {
        return static::get('user.telnet.port', null);
    }
    public static function getTelnetIP() {
        return static::get('user.telnet.ip', null);
    }
    public static function hasTelnet()
    {
        return static::getTelnetIP() && static::getTelnetPort();
    }
    public static function loadUserConfig()
    {
        return static::load(static::$userConfigFile, 'user');
    }
    public static function saveUserConfig()
    {
        return static::save(static::$userConfigFile, 'user');
    }
    public static function getServerVersion()
    {
        return 'alpha5';
    }
}

