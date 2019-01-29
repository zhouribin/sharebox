<?php

namespace App\Http\Controllers;

use App\Constants\BaseConstants;
use App\Constants\ErrorMsgConstants;
use App\Exceptions\CustomException;
use App\Exceptions\ServiceException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected $result = [
        "statusCode" => BaseConstants::RETURN_SUCCESS,
        "message"    => "",
    ];

    protected function wrapSuccessReturn($responseData)
    {
        foreach ($responseData as $key => $value) {
            $this->result[$key] = $value;
        }

        return $this->result;
    }

    protected function wrapErrorReturn($exception)
    {
        $logger = customerLoggerHandle("ErrorReturn");
        $logger->debug("接口异常", getExceptionInfo($exception));
        $this->result['statusCode'] = BaseConstants::RETURN_ERROR;
        $this->result['message'] = ErrorMsgConstants::$errorMsg[ErrorMsgConstants::API_ERROR_MESSAGE];
        $this->result['data'] = [];

        if ($exception instanceof ServiceException) {
            $this->result['message'] = $exception->getMessage();
        } elseif ($exception instanceof CustomException) {
            $this->result['statusCode'] = $exception->getCode();
            $this->result['message'] = $exception->getMessage();
        }

        return $this->result;
    }

    /**
     * 请求参数验证
     * @param Request $request
     * @param array $validatorRules 验证规则
     * @param array $validatorMessages 验证提示
     */
    protected function requestValidator(Request $request, array $validatorRules, array $validatorMessages = [])
    {
        $validator = \Validator::make($request->all(), $validatorRules, $validatorMessages);
        if ($validator->fails()) {
            throw new ServiceException(ErrorMsgConstants::VALIDATION_DATA_ERROR, $validator->messages()->first());
        }
    }

}
