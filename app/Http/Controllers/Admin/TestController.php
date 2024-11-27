<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Telegram\Bot\Laravel\Facades\Telegram;
use DateTime;
use App\Library\TECHCOMBANK;
use App\Library\Helpers;
use Carbon\Carbon;
use App\Models\Bank;
use App\Models\Provinces;
use App\Models\Collection;
use App\Models\CollectionProduct;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{



    public function __construct()
    {

    }

    public function index(){
        $data = null;
        $group_id = [];
        $sys_widget_flash_sale = setting('sys_widget_flash_sale');
        $sys_id_widget_1 = setting('sys_id_widget_1');
        $sys_id_widget_2 = setting('sys_id_widget_2');
        $sys_id_widget_3 = setting('sys_id_widget_3');
        if(isset($sys_widget_flash_sale) && is_int((int)$sys_widget_flash_sale)){
            $group_id[] = $sys_widget_flash_sale;
        }
        if(isset($sys_id_widget_1) && is_int((int)$sys_id_widget_1)){
            $group_id[] = $sys_id_widget_1;
        }
        if(isset($sys_id_widget_2) && is_int((int)$sys_id_widget_2)){
            $group_id[] = $sys_id_widget_2;
        }
        if(isset($sys_id_widget_3) && is_int((int)$sys_id_widget_3)){
            $group_id[] = $sys_id_widget_3;
        }
        $data = Collection::with('collection_product')->whereNotIn('id',$group_id)->where('status',1)->get();
        dd($data);
    }
}
