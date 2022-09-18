<?php
namespace App\Services\Utility;

use Monolog\Logger;
use Monolog\Handler\LogglyHandler;

class MyLogger2 implements ILogger
{
    private static $logger = null;
    
    static function getLogger()
    {
        if (self::$logger == null) {
            self::$logger = new Logger('playLaravel');
            self::$logger->pushHandler(new LogglyHandler('8c20c58c-5824-4113-894a-fcf30c8e9f76/tag/cst323_logfile_heroku_upload', Logger::DEBUG));
        }
        return self::$logger;
    }
    
    public static function debug($message)
    {
        self::getLogger()->debug($message);
    }
    
    public static function warning($message)
    {
        self::getLogger()->warning($message);
    }
    
    public static function error($message)
    {
        self::getLogger()->error($message);
    }
    
    public static function info($message)
    {
        self::getLogger()->info($message);
    }
    
}