<?php
/**
 * Created by PhpStorm.
 * User: zhouribin
 * Date: 2019-01-29
 * Time: 13:56
 */

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Ramsey\Uuid\Uuid;

/**
 * 解析异常信息
 * @param Exception $e
 * @return array
 */
function getExceptionInfo(Exception $e)
{
    return [
        "Code"    => $e->getCode(),
        "Message" => $e->getMessage(),
        "File"    => $e->getFile(),
        "Line"    => $e->getLine(),
    ];
}

/**
 * 记录日志
 * @param $loggerName
 * @return \Monolog\Logger
 */
function customerLoggerHandle($loggerName)
{
    $loggerName = $loggerName . "-" . exec('whoami');
    $logger = new \Monolog\Logger($loggerName);
    $loggerFilePath = storage_path('logs') . "/" . $loggerName . ".log";
    $logger->pushHandler(
        new RotatingFileHandler(
            $loggerFilePath, 0,
            env('LOGGER_LEVEL', Logger::DEBUG)
        )
    );

    return $logger;
}

/**
 * 获取uuid
 * @return string
 * @throws Exception
 */
function getNewUuid()
{
    return Uuid::uuid4()->toString();
}