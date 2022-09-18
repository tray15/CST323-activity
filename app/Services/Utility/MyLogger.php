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
        return null;
    }
    
    public function debug($message, $data=array())
    {
        self::getLogger()->addDebug($message, $data);
    }
    
    public function warning($message, $data=array())
    {
        self::getLogger()->addWarning($message, $data);
    }
    
    public function error($message, $data=array())
    {
        self::getLogger()->addError($message, $data);
    }
    
    public function info($message, $data=array())
    {
        self::getLogger()->addInfo($message, $data);
    }
    
}

