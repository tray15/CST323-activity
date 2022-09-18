<?php
namespace App\Services\Utility;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MyLogger implements ILogger
{
    private static $logger = null;
    
    static function getLogger()
    {
        if (self::$logger == null) {
            self::$logger = new Logger('playLaravel');
            self::$logger->pushHandler(new StreamHandler('php://stdout', Logger::DEBUG));
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

