<?php

namespace iNaru\Traits;

use Illuminate\Support\Facades\Log;

trait Logging
{
    protected static function debug($msg, ...$context)
    {
        Log::debug(static::log_formatter($msg) . (empty($context) ? '' : "\n"), static::log_backtrace($context));
    }

    protected static function info($msg, ...$context)
    {
        Log::info(static::log_formatter($msg) . (empty($context) ? '' : "\n"), $context);
    }

    protected static function warn($msg, ...$context)
    {
        Log::warning(static::log_formatter($msg) . (empty($context) ? '' : "\n"), static::log_backtrace($context));
    }

    protected static function err($msg, ...$context)
    {
        Log::error(static::log_formatter($msg) . (empty($context) ? '' : "\n"), static::log_backtrace($context));
    }

    protected static function alert($msg, ...$context)
    {
        try {
            Log::alert($msg = static::log_formatter($msg) . (empty($context) ? '' : "\n"), $context = static::log_backtrace($context));
        } catch (\Exception $e) {
            static::error($e);
        }
    }

    protected static function log_formatter($msg)
    {
        if ($msg instanceof \Exception) {
            $message = '[' . get_class($msg) . '] [' . $msg->getCode() . '] ' . $msg->getMessage() . "\n[\"" . $msg->getFile() . ':' . $msg->getLine() . '"]';
        } else {
            $message = '[' . static::class . '] ' . print_r($msg, true);
        }

        return $message;
    }

    protected static function log_backtrace($context = null)
    {
        if ($backtrace = @debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)[1]) {
            $context[] = "{$backtrace['file']}:{$backtrace['line']}";
        }

        return $context;
    }
}