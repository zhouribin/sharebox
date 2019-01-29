<?php

namespace App\Constants;


class BaseConstants
{
    const DATA_TRUE = 1;
    const DATA_FALSE = 2;

    //默认分页数量
    const DEFAULT_PAGE_SIZE = 20;
    const DEFAULT_PAGE_NUM = 1;//默认页码
    const TIMEOUT = 50;

    const RETURN_SUCCESS = 10000;
    const RETURN_ERROR = 20000;
    const TOKEN_ERROR = 30000;

    const USER_STATUS_LOCK = 3;
    const USER_STATUS_NORMAL = 2;
    const USER_STATUS_INIT = 1;

    const USER_STATUS_MAP = [
        self::USER_STATUS_LOCK   => "锁定",
        self::USER_STATUS_NORMAL => "正常",
        self::USER_STATUS_INIT   => "待激活",
    ];

}