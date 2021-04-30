<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait LogTrait
{
    /**
     * Add critical log
     *
     * @param  string $message
     * @param  string $class
     * @param  string $exceptionMessage
     * @return void
     */
    public function criticalLog(string $message, string $class, string $exceptionMessage)
    {
        Log::critical(
            "$message $class",
            [
              'code' => "Unexpected error in $class",
              'exception' => $exceptionMessage,
            ]);
    }
}
