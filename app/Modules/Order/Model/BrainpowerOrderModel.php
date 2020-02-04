<?php

namespace App\Modules\Order\Model;

use Illuminate\Database\Eloquent\Model;

use Log;

class BrainpowerOrderModel extends Model
{

    protected $table = 'brainpower_order';
    protected $fillable = ['code','uid','logo_id','status','type','cash','note','created_at', 'pay_time', 'updated_at'];

    static function randomCode($uid, $specific = '')
    {
        return $specific . time() . str_random(4) . $uid;
    }

    static function createOne($data, $uid)
    {
        $model = new BrainpowerOrderModel();
        $model->code = self::randomCode($uid, 'bp');
        $model->uid = $uid;
        $model->logo_id = $data['logo_id'];
        $model->status = isset($data['status']) ? $data['status'] : 0;
        $model->type = $data['type'];
        $model->cash = $data['cash'];
        $model->note = isset($data['note']) ? $data['note'] : '';
        $model->save();
        return  $model;
    }

    static function pay($payType, array $data)
    {
      $update = [
          'status'=> 1,
          'pay_type'=> $payType,
          'pay_time'=> date('Y-m-d H:i:s'),
          'pay_account'=> $data['pay_account'],
          'pay_code'=> $data['pay_code']
      ];
      $status = BrainpowerOrderModel::where('code', $data['code'])->update($update);
      
      return is_null($status) ? true : false;
    }
}
