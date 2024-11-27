<?php

use App\Http\Controllers\Frontend\BlogController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Guest;
use App\Library\Helpers;


//Route::get('/', function () {
//    return view('index');
//});

//Route::get('/test', function () {
//
//    return view('test');
//});
//Route::get('/photo-album', function () {
//    return view('slider');
//});
//Route::get('/invitation/{id}',function(Request $request,$id){
//    $data = array();
//    $user = Guest::where('link',$id)
//                ->orWhere('url_display', $id)
//                ->firstOrFail();
//    $data['guest_name'] = $user->name;
//    if($user->type == 0){
//        $data['event_name'] = 'LỄ CƯỚI NHÀ NAM';
//        $data['event_time'] = '16:00 AM';
//        $data['event_date'] = 'Chủ nhật, NGÀY 22/10/2023';
//        $data['event_date_dot'] = '22.10.2023';
//        $data['event_address'] = 'Thôn Duyên Ứng, Xã Lam Điền, Huyện Chương Mỹ, TP Hà Nội';
//    }
//    else{
//        $data['event_name'] = 'LỄ CƯỚI NHÀ NỮ';
//        $data['event_time'] = '18:00 AM';
//        $data['event_date'] = 'Thứ 7, NGÀY 21/10/2023';
//        $data['event_date_dot'] = '21.10.2023';
//        $data['event_address'] = 'Thôn Già Thượng, Xã Việt Tiến, Huyện Bảo Yên, Tỉnh Lào Cai';
//    }
//    return view('thiepmoi',compact('data'));
//});
Route::get('/invitation/{id}',function(Request $request,$id){
    $data = array();
    $user = Guest::where('link',$id)
                ->orWhere('url_display', $id)
                ->firstOrFail();
    $data['guest_name'] = $user->name;
    if($user->type == 1){
        $data['lover'] = ' + Người thương';
    }
    else{
        $data['lover'] = '';
    }
    return view('invitation',compact('data'));
});
//Route::get('/rsvp',function(){
//    return view('xacnhan');
//});
//Route::get('/search-guests',function(Request $request){
//     $name = $request->name;
//     $data = Guest::where('name', 'LIKE', "%$name%")->get();
//     return response()->json([
//        'status' => 1,
//        'data' => $data
//    ], 200);
//});
//Route::post('/wish',function(Request $request){
//    dd($request->all());
//});
