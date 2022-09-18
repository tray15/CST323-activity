<?php
namespace App\Services\Utility;

interface ILogger
{
    static function getLogger();
    public static function debug($param);
    public static function info($param);
    public static function warning($param);
    public static function error($param);
}

