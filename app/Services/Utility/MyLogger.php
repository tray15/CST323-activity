<?php
namespace App\Services\Utility;

use Illuminate\Support\Facades\Log;

class MyLogger implements ILogger
{
    static function getLogger()
    {
        return null;
    }
    
    public function debug($param)
    {
        return Log::debug($param);
    }
    
    public function warning($param)
    {
        return Log::warning($param);
    }
    
    public function error($param)
    {
        return Log::error($param);
    }
    
    public function info($param)
    {
        return Log::info($param);
    }
    
}

