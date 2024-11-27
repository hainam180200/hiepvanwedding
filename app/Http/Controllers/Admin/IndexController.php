<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Theme\Menu;
use App\Http\Controllers\Controller;

use App\Models\ActivityLog;
use App\Models\Charge;
use App\Models\Order;
use App\Models\Item;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewer;
use Carbon\Carbon;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DepositBankExport;
use App\Exports\ChargeExport;
use App\Exports\StoreCardExport;
use App\Exports\DonateExport;

class IndexController extends Controller
{
    public function __construct(Request $request)
    {
//        $this->middleware('role:admin');
        // $this->middleware('role:admin', ['only' => ['GrowthUser', 'ClassifyUser','GrowthTopupCard','GrowthStoreCard','GrowthTopupBank','GrowthDonate','ExportDepositBank','ExportCharge','ExportStoreCard','ExportDonate']]);
    }
    public function index(Request $request){
        $page_title = 'Dashboard';
        $page_breadcrumbs = [
            [   'page' => '1',
                'title' => 'Home',
            ],
        ];
        ActivityLog::add($request, 'Truy cập dashboard index');
        return view('admin.guest.index', compact('page_title', 'page_breadcrumbs'));
    }
}
