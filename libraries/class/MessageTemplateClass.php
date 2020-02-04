<?php

use App\Modules\Manage\Model\MessageTemplateModel;
use App\Modules\User\Model\MessageReceiveModel;
/**
 * Created by PhpStorm.
 * User: quanke
 * Date: 2018/01/02
 * Time: 09:51
 */
class MessageTemplateClass {

    static public function templateCode()
    {
        $codeArr = [
            'password_back' => '密码找回',
            'task_publish_success' => '任务发布成功',
            'task_win' => '任务中标',
            'task_audit_failure' => '任务审核失败',
            'audit_success' => '审核通过',
            'task_delivery' => '任务交稿',
            'trading_rights' => '交易维权受理',
            'trading_rights_result' => '交易维权结果',
            'agreement_documents' => '任务交付',
            'Automatic_choose' => '自动选稿',
            'manuscript_settlement' => '稿件结算',
            'task_failed' => '任务失败',
            'task_finish' => '任务完成',
            'report' => '举报通知',
            'feedback' => '意见反馈',
            'registration_activation' => '注册激活',
            'shop_rights' => '店铺维权结果',
            'question_accept' => '问答采纳',
            'bid_work_check_success' => '招标任务阶段审核稿件通过',
            'bid_work_check_failure' => '招标任务阶段审核稿件失败',
            'report_result' => '举报处理结果',
            'stylist_apply' => '设计师申请',
        ];
        return $codeArr;
    }

    /**
     * 根据短信模板代号发送站内信息
     * @param string $code 模板代号
     * @param int $uid 接收人uid
     * @param int $type 站内信类型 1:系统消息 2:交易消息
     * @param array $arr 信息变量
     * @param string $messageTitle 信息标题
     * @return bool|static
     */
    static public function getMeaasgeByCode($code,$uid,$type=1,$arr,$messageTitle='',$fuid='')
    {
        //获取信息内容
        $message = self::getMessageContent($code,$arr,1);

        /*switch($code){
            case 'password_back':

                break;
            case 'task_publish_success':
                $message = self::taskPublishSuccess($arr);
                break;
            case 'task_win':
                $message = self::taskWin($arr);
                break;
            case 'task_audit_failure':
                $message = self::taskAudiFailure($arr);
                break;
            case 'audit_success':
                $message = self::auditSuccess($arr);
                break;
            case 'task_delivery':
                $message = self::taskDelivery($arr);
                break;
            case 'trading_rights':
                $message = self::tradingRights($arr);
                break;
            case 'trading_rights_result':
                $message = self::tradingRightsResult($arr);
                break;
            case 'agreement_documents':
                $message = self::agreementDocuments($arr);
                break;
            case 'Automatic_choose':
                $message = self::automaticChoose($arr);
                break;
            case 'manuscript_settlement':
                $message = self::manuscriptSettlement($arr);
                break;
            case 'task_failed':
                $message = self::taskfailed($arr);
                break;
            case 'task_finish':
                $message = self::taskFinish($arr);
                break;
            case 'report':
                $message = self::report($arr);
                break;
            case 'feedback':

                break;
            case 'registration_activation':

                break;
            case 'shop_rights':
                $message = self::shopRights($arr);
                break;
            case 'question_accept':
                $message = self::questionAccept($arr);
                break;
            case 'bid_work_check_success':
                $message = self::bidWorkCheckSuccess($arr);
                break;
            case 'bid_work_check_failure':
                $message = self::bidWorkCheckFailure($arr);
                break;
            case 'report_result':
                $message = self::reportResult($arr);
                break;
            default:
                $message = '';

        }*/
        if(isset($message) && !empty($message)){
            if(empty($messageTitle)){
                $codeArr = self::templateCode();
                if(in_array($code,array_keys($codeArr))){
                    $messageTitle = $codeArr[$code];
                }
            }
            $data = [
                'message_title'   => $messageTitle,
                'code_name'            => $code,
                'message_content' => $message,
                'js_id'           => $uid,
                'fs_id'           => $fuid,
                'message_type'    => $type,
                'receive_time'    => date('Y-m-d H:i:s',time()),
                'status'          => 0,
            ];
            $res = MessageReceiveModel::create($data);
            return $res;
        }
        return false;

    }


    /**
     * 根据短信模板代号发送邮件
     * @param string $code 模板代号
     * @param string $email 接收人email
     * @param array $arr 信息变量
     * @param string $messageTitle 信息标题
     * @return bool|static
     */
    static public function sendEmailByCode($code,$email,$arr,$messageTitle='')
    {
        if($email){
           /* switch($code){
                case 'password_back':

                    break;
                case 'task_publish_success':
                    $message = self::taskPublishSuccess($arr,2);
                    break;
                case 'task_win':
                    $message = self::taskWin($arr,2);
                    break;
                case 'task_audit_failure':
                    $message = self::taskAudiFailure($arr,2);
                    break;
                case 'audit_success':
                    $message = self::auditSuccess($arr,2);
                    break;
                case 'task_delivery':
                    $message = self::taskDelivery($arr,2);
                    break;
                case 'trading_rights':
                    $message = self::tradingRights($arr,2);
                    break;
                case 'trading_rights_result':
                    $message = self::tradingRightsResult($arr,2);
                    break;
                case 'agreement_documents':
                    $message = self::agreementDocuments($arr,2);
                    break;
                case 'Automatic_choose':
                    $message = self::automaticChoose($arr,2);
                    break;
                case 'manuscript_settlement':
                    $message = self::manuscriptSettlement($arr,2);
                    break;
                case 'task_failed':
                    $message = self::taskfailed($arr,2);
                    break;
                case 'task_finish':
                    $message = self::taskFinish($arr,2);
                    break;
                case 'report':
                    $message = self::report($arr,2);
                    break;
                case 'feedback':

                    break;
                case 'registration_activation':

                    break;
                case 'shop_rights':
                    $message = self::shopRights($arr,2);
                    break;
                case 'question_accept':
                    $message = self::questionAccept($arr,2);
                    break;
                case 'bid_work_check_success':
                    $message = self::bidWorkCheckSuccess($arr,2);
                    break;
                case 'bid_work_check_failure':
                    $message = self::bidWorkCheckFailure($arr,2);
                    break;
                case 'report_result':
                    $message = self::reportResult($arr,2);
                    break;
                default:
                    $message = '';

            }*/
            //获取信息内容
            $message = self::getMessageContent($code,$arr,2);
            if(isset($message) && !empty($message)){
                if(empty($messageTitle)){
                    $codeArr = self::templateCode();
                    if(in_array($code,array_keys($codeArr))){
                        $messageTitle = $codeArr[$code];
                    }
                }
                $data = [
                    'title' => $messageTitle,
                    'email' => $email,
                    'message' => $message
                ];
                if (\MessagesClass::sendMsg($data, 'email.sitemessage')){
                    return true;
                }
                return false;
            }
            return false;

        }
        return false;
    }

    /**
     * 获取信息内容
     * @param  string $code  模板别名
     * @param array $arr 变量数组
     * @param int $type 1: 站内信 2:邮件
     * @return mixed
     */
    static public function getMessageContent($code,$arr=[],$type=1)
    {
        $messageVariableArr = [];
        if(!empty($arr) && is_array($arr)){
            foreach($arr as $k => $v){
                $messageVariableArr[$k] = $v;
            }
        }
        $message = MessageTemplateModel::sendMessage($code,$messageVariableArr,$type);
        return $message;
    }




    /**
     * 举报通知
     * @param $arr
     * @param int $type
     * @return mixed
     */
    static public function report($arr,$type=1)
    {
        $messageVariableArr = [
            'username'  => isset($arr['username']) ? $arr['username'] : '',
            'href'      => isset($arr['href']) ? $arr['href'] : '',
            'tasktitle' => isset($arr['tasktitle']) ? $arr['tasktitle'] : '',
            'website'   => isset($arr['website']) ? $arr['website'] : '',

        ];
        $message = MessageTemplateModel::sendMessage('report',$messageVariableArr,$type);
        return $message;
    }

    /**
     * 举报处理结果
     * @param $arr
     * @param int $type
     * @return mixed
     */
    static public function reportResult($arr,$type=1)
    {
        $messageVariableArr = [
            'username'  => isset($arr['username']) ? $arr['username'] : '',
            'href'      => isset($arr['href']) ? $arr['href'] : '',
            'tasktitle' => isset($arr['tasktitle']) ? $arr['tasktitle'] : '',
            'result'    => isset($arr['result']) ? $arr['result'] : '',
            'website'   => isset($arr['website']) ? $arr['website'] : '',

        ];
        $message = MessageTemplateModel::sendMessage('report_result',$messageVariableArr,$type);
        return $message;
    }

    /**
     * 任务发布成功
     * @param array $arr
     * @param int $type 类型 1:站内信  2:email
     * @return mixed
     */
    static public function taskPublishSuccess($arr,$type=1)
    {
        $messageVariableArr = [
            'username'            => isset($arr['username']) ? $arr['username'] : '',
            'task_number'         => isset($arr['task_number']) ? $arr['task_number'] : '',
            'task_title'          => isset($arr['task_title']) ? $arr['task_title'] : '',
            'task_status'         => isset($arr['task_status']) ? $arr['task_status'] : '',
            'website'             => isset($arr['website']) ? $arr['website'] : '',
            'href'                => isset($arr['href']) ? $arr['href'] : '',
            'task_link'           => isset($arr['task_link']) ? $arr['task_link'] : '',
            'start_time'          => isset($arr['start_time']) ? $arr['start_time'] : '',
            'manuscript_end_time' => isset($arr['manuscript_end_time']) ? $arr['manuscript_end_time'] : '',
        ];
        $message = MessageTemplateModel::sendMessage('task_publish_success', $messageVariableArr,$type);
        return $message;
    }

    /**
     * 任务中标通知
     * @param $arr
     * @return mixed
     */
    static public function taskWin($arr,$type=1)
    {
        $messageVariableArr = [
            'username'    => isset($arr['username']) ? $arr['username'] : '',
            'website'     => isset($arr['website']) ? $arr['website'] : '',
            'task_number' => isset($arr['task_number']) ? $arr['task_number'] : '',
            'href'        => isset($arr['href']) ? $arr['href'] : '',
            'task_title'  => isset($arr['task_title']) ? $arr['task_title'] : '',
            'win_price'   => isset($arr['win_price']) ? $arr['win_price'] : '',
        ];
        $message = MessageTemplateModel::sendMessage('task_win',$messageVariableArr,$type);
        return $message;
    }

    /**
     * 任务审核失败
     * @param $arr
     * @return mixed
     */
    public function taskAudiFailure($arr,$type=1)
    {
        $messageVariableArr = [
            'username'   => isset($arr['username']) ? $arr['username'] : '',
            'href'       => isset($arr['href']) ? $arr['href'] : '',
            'task_title' => isset($arr['task_title']) ? $arr['task_title'] : '',
            'website'    => isset($arr['website']) ? $arr['website'] : '',
        ];
        $message = MessageTemplateModel::sendMessage('task_audit_failure', $messageVariableArr,$type);
        return $message;
    }

    /**
     * 任务审核成功
     * @param $arr
     * @return mixed
     */
    static public function  auditSuccess($arr,$type=1){
        $messageVariableArr = [
            'username'    => isset($arr['username']) ? $arr['username'] : '',
            'website'     => isset($arr['website']) ? $arr['website'] : '',
            'task_number' => isset($arr['task_number']) ? $arr['task_number'] : '',
            'task_link'   =>isset($arr['task_link']) ? $arr['task_link'] : '',
        ];
        $message = MessageTemplateModel::sendMessage('audit_success', $messageVariableArr,$type);
        return $message;
    }

    /**
     * 任务交稿
     * @param $arr
     * @return mixed
     */
    static public function taskDelivery($arr,$type=1)
    {
        $messageVariableArr = [
            'username'   => isset($arr['username']) ? $arr['username'] : '',
            'name'       => isset($arr['name']) ? $arr['name'] : '',
            'href'       => isset($arr['href']) ? $arr['href'] : '',
            'task_title' => isset($arr['task_title']) ? $arr['task_title'] : '',
            'website'    => isset($arr['website']) ? $arr['website'] : '',
        ];
        $message = MessageTemplateModel::sendMessage('task_delivery',$messageVariableArr,$type);
        return $message;
    }

    /**
     * 交易维权受理
     * @param $arr
     * @return mixed
     */
    static public function tradingRights($arr,$type=1)
    {
        $fromMessageVariableArr = [
            'username'  => isset($arr['username']) ? $arr['username'] : '',
            'tasktitle' => isset($arr['tasktitle']) ? $arr['tasktitle'] : '',
            'website'   => isset($arr['website']) ? $arr['website'] : '',
        ];
        $message = MessageTemplateModel::sendMessage('trading_rights',$fromMessageVariableArr,$type);
        return $message;
    }

    /**
     * 交易维权结果
     * @param $arr
     * @return mixed
     */
    static public function tradingRightsResult($arr,$type=1)
    {
        $ownerMessageVariableArr = [
            'username'   => isset($arr['username']) ? $arr['username'] : '',
            'tasktitle'  => isset($arr['tasktitle']) ? $arr['tasktitle'] : '',
            'ownername'  => isset($arr['ownername']) ? $arr['ownername'] : '',
            'ownermoney' => isset($arr['ownermoney']) ? $arr['ownermoney'] : '',
            'workername' => isset($arr['workername']) ? $arr['workername'] : '',
            'wokermoney' => isset($arr['wokermoney']) ? $arr['wokermoney'] : '',
            'website'    => isset($arr['website']) ? $arr['website'] : '',
        ];
        $message = MessageTemplateModel::sendMessage('trading_rights_result',$ownerMessageVariableArr,$type);
        return $message;
    }

    /**
     * 任务交付
     * @param $arr
     * @return mixed
     */
    static public function agreementDocuments($arr,$type=1)
    {
        $messageVariableArr = [
            'username'       => isset($arr['username']) ? $arr['username'] : '',
            'initiator'      => isset($arr['initiator']) ? $arr['initiator'] : '',
            'agreement_link' => isset($arr['agreement_link']) ? $arr['agreement_link'] : '',
            'website'        => isset($arr['website']) ? $arr['website'] : '',
        ];
        $message = MessageTemplateModel::sendMessage('agreement_documents',$messageVariableArr,$type);
        return $message;
    }

    /**
     * 自动选稿
     * @param $arr
     * @return mixed
     */
    static public function automaticChoose($arr,$type=1)
    {
        $messageVariableArr = [
            'username'    => isset($arr['username']) ? $arr['username'] : '',
            'task_number' => isset($arr['task_number']) ? $arr['task_number'] : '',
            'href'        => isset($arr['href']) ? $arr['href'] : '',
            'task_titles' => isset($arr['task_titles']) ? $arr['task_titles'] : '',
            'website'     => isset($arr['website']) ? $arr['website'] : '',
        ];
        $message = MessageTemplateModel::sendMessage('Automatic_choose',$messageVariableArr,$type);
        return $message;
    }

    /**
     * 稿件结算
     * @param $arr
     * @return mixed
     */
    static public function manuscriptSettlement($arr,$type=1)
    {
        $messageVariableArr = [
            'username'    => isset($arr['username']) ? $arr['username'] : '',
            'task_number' => isset($arr['task_number']) ? $arr['task_number'] : '',
            'task_link'   => isset($arr['task_link']) ? $arr['task_link'] : '',
            'website'     => isset($arr['website']) ? $arr['website'] : '',
        ];
        $message = MessageTemplateModel::sendMessage('manuscript_settlement',$messageVariableArr,$type);
        return $message;
    }

    /**
     * 任务失败
     * @param $arr
     * @return mixed
     */
    static public function taskfailed($arr,$type=1)
    {
        $title = isset($arr['title']) ? $arr['title'] : '';
        $resaon = isset($arr['resaon']) ? $arr['resaon'] : '超过选稿限制时间没有选择稿件中标';
        $messageVariableArr = [
            'task_title' => $title,
            'reason'     => $resaon,
        ];
        $message = MessageTemplateModel::sendMessage('task_failed',$messageVariableArr,$type);

        return $message;
    }

    /**
     * 任务完成
     * @param $arr
     * @return mixed
     */
    static public function taskFinish($arr,$type=1)
    {
        $messageVariableArr = [
            'task_title' => isset($arr['task_title']) ? $arr['task_title'] : '',
        ];
        $message = MessageTemplateModel::sendMessage('task_finish',$messageVariableArr,$type);
        return $message;
    }

    static public function shopRights($arr,$type=1)
    {
        $fromNewArr = array(
            'username'   => isset($arr['username']) ? $arr['username'] : '',
            'href'       => isset($arr['href']) ? $arr['href'] : '',
            'trade_name' => isset($arr['trade_name']) ? $arr['trade_name'] : '',
            'content'    => isset($arr['content']) ? $arr['content'] : '',
            'website'    => isset($arr['website']) ? $arr['website'] : '',

        );
        $fromMessageContent = MessageTemplateModel::sendMessage('shop_rights',$fromNewArr,$type);
        return $fromMessageContent;
    }

    /**
     * 问答采纳
     * @param $arr
     * @return mixed
     */
    static public function questionAccept($arr,$type=1)
    {
        $messageVariableArr = [
            'username'  => isset($arr['username']) ? $arr['username'] : '',
            'from_name' => isset($arr['from_name']) ? $arr['from_name'] : '',
            'queation'  => isset($arr['queation']) ? $arr['queation'] : '',
            'website'   => isset($arr['website']) ? $arr['website'] : '',
        ];
        $message = MessageTemplateModel::sendMessage('question_accept',$messageVariableArr,$type);
        return $message;
    }

    /**
     * 招标任务阶段审核稿件通过
     * @param $arr
     * @return mixed
     */
    static public function bidWorkCheckSuccess($arr,$type=1)
    {
        $messageVariableArr = [
            'username'  => isset($arr['username']) ? $arr['username'] : '',
            'task_name' => isset($arr['task_name']) ? $arr['task_name'] : '',
            'task_link' => isset($arr['task_link']) ? $arr['task_link'] : '',
            'website'   => isset($arr['website']) ? $arr['website'] : '',
        ];
        $message = MessageTemplateModel::sendMessage('bid_work_check_success',$messageVariableArr,$type);
        return $message;
    }


    /**
     * 招标任务阶段审核稿件失败
     * @param $arr
     * @return mixed
     */
    static public function bidWorkCheckFailure($arr,$type=1)
    {
        $messageVariableArr = [
            'username'  => isset($arr['username']) ? $arr['username'] : '',
            'task_name' => isset($arr['task_name']) ? $arr['task_name'] : '',
            'task_link' => isset($arr['task_link']) ? $arr['task_link'] : '',
            'website'   => isset($arr['website']) ? $arr['website'] : '',
        ];
        $message = MessageTemplateModel::sendMessage('bid_work_check_failure',$messageVariableArr,$type);
        return $message;
    }
}