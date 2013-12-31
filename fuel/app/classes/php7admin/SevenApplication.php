<?php

require_once dirname(__FILE__) . '/../functions.php';
require_once dirname(__FILE__) . '/Config.php';
require_once dirname(__FILE__) . '/PageLayout.php';
require_once dirname(__FILE__) . '/Navigation.php';
require_once dirname(__FILE__) . '/Messages.php';
require_once dirname(__FILE__) . '/SevenController.php';
require_once dirname(__FILE__) . '/ConfiguratedController.php';


class SevenApplication {
    private static $isDatabase = false;
    private static $isConfigFile = false;
    private static $dbError = false;

    static function isDatabase()
    {
        return self::$isDatabase;
    }
    static function isConfigFile()
    {
        return self::$isConfigFile;
    }
    static function getDbError()
    {
        return self::$dbError;
    }
    static function initDatabaseAccess()
    {
        $config = Config::get();
        $db_name = $config->getConfigVal('/config/database/name');
        $db_host = $config->getConfigVal('/config/database/host');
        $db_user = $config->getConfigVal('/config/database/user');
        $db_pw = $config->getConfigVal('/config/database/pw');
        try {
            DBManager::getInstance()->setConnection(
                'php7admin',
                'mysql:host=' . $db_host . ';dbname=' . $db_name,
                $db_user,
                $db_pw
            );
            self::$isDatabase = true;
        } catch (Exception $exc) {
//                    && ($action == 'database' || $action == 'index')) {
//                if(!$db_name || !$db_host || !$db_name || !$db_user
//                                                        || !$db_pw ) {
//                    Messages::add('<b>Please complete/add Database'
//                                    .  ' configuration!</b>', 'info');
//                } else {
//                    Messages::add('<b>Error accessing Database:<b>', 'error');
//                    Messages::add($exc->getMessage(), 'error');
//                    $notice = 'Database files are in /db folder. Check if'
//                            . ' database '
//                            . 'user permissions set right. To set up database'
//                            . ' create database "' . $db_name . '" and import'
//                            . ' init_database.sql. Create database with'
//                            . ' collation: "utf8_general_ci"';
//                    Messages::add($notice, 'info');
//                }
//
//
//            } else {
//                return false;
//            }
            self::$dbError = $exc->getMessage();
            self::$isDatabase = false;
        }
        return self::$isDatabase;
    }
    static function initConfiguration()
    {
        $config = Config::get();
        self::$isConfigFile = $config->isConfigFile();
        return self::$isConfigFile;
    }
    static function init()
    {
        Page::initialize();
        self::initConfiguration();
        self::initDatabaseAccess();
    }
}
