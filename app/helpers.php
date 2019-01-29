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
 * @param $logName
 * @return \Monolog\Logger
 */
function customerLoggerHandle($logName)
{
    $logName = $logName . "-" . exec('whoami');
    $log = new \Monolog\Logger($logName);
    $logFilePath = storage_path('logs') . "/" . $logName . ".log";
    $log->pushHandler(new RotatingFileHandler($logFilePath, 0, Logger::DEBUG));

    return $log;
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