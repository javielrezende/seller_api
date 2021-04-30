<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait LogTrait
{
    public function criticalLog($message, $class, $exceptionMessage)
    {
        Log::critical(
            "$message $class",
            [
              'code' => "Unexpected error in $class",
              'exception' => $exceptionMessage,
            ]);
    }
}
