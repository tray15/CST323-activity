<?php
namespace App\Services\Utility;

interface ILogger
{
    static function getLogger();
    public function debug($param);
    public function info($param);
    public function warning($param);
    public function error($param);
}

