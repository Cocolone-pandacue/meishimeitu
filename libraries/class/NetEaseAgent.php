<?php

namespace Toplan\PhpSms;

use Toplan\PhpSms\Agent;

/**
 * Class NetEaseAgent
 *
 * @property string $appKey
 * @property string $appSecret
 */
class NetEaseAgent extends Agent implements TemplateSms
{
    protected static $sendCodeUrl = 'https://api.netease.im/sms/sendcode.action';
    protected static $sendTemplateUrl = 'https://api.netease.im/sms/sendtemplate.action';

    public function sendTemplateSms($to, $tempId, array $data)
    {
        // 发送短信验证码
        if (isset($data['code']) && count($data) === 1) {
            $params = [
                'templateid' => $tempId,
                'mobile'     => $to,
                'authCode'   => $data['code']
            ];
            return $this->request(self::$sendCodeUrl, $params);
        } else {
            // 发送通知类和运营类短信
            $params = [
                'templateid' => $tempId,
                'mobiles'    => json_encode([$to]),
                'params'     => json_encode(array_values($data))
            ];
            return $this->request(self::$sendTemplateUrl, $params);
        }
    }

    protected function request($sendUrl, array $params)
    {
        $result = $this->curlPost($sendUrl, [], [
            CURLOPT_POSTFIELDS => http_build_query($this->params($params)),
            CURLOPT_HTTPHEADER => $this->createHeader()
        ]);
        $this->setResult($result);
    }

    protected function createHeader()
    {
        $nonce = $this->getRandom();
        $curTime = (string) (time());   //当前时间戳，以秒为单位
        $join_string = $this->appSecret . $nonce . $curTime;

        return array(
            'AppKey:' . $this->appKey,
            'Nonce:' . $nonce,
            'CurTime:' . $curTime,
            'CheckSum:' . sha1($join_string),
            'Content-Type:application/x-www-form-urlencoded;charset=utf-8'
        );
    }

    protected function setResult($result)
    {
        if ($result['request']) {
            $this->result(Agent::INFO, $result['response']);
            $result = json_decode($result['response'], true);
            $this->result(Agent::CODE, $result['code']);
            if ($result['code'] === 200) {
                $this->result(Agent::SUCCESS, true);
            }
        } else {
            $this->result(Agent::INFO, 'request failed');
        }
    }

    protected function getRandom()
    {
        return rand(100000, 999999);
    }
}
