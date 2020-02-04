<?php

namespace App\Console\Commands;

use App\Modules\Vipshop\Models\StylistPackageOrderModel;
use App\Modules\Manage\Model\MessageTemplateModel;
use Illuminate\Console\Command;

class StylistPackageOrder extends Command
{
//命令名称
    protected $signature = 'stylistPackageOrder';

//命令描述，没什么用
    protected $description = '设计师认证过期改变状态';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {

        $now = date('Y-m-d H:i:s', time());

        StylistPackageOrderModel::where('end_time','<',$now)->update(['status' => 1]);
        MessageTemplateModel::where('code_name', 'Stylist_failure')->where('is_open', 1)->first();
    }
}
