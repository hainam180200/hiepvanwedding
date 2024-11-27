<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Auth;
use App\Models\ActivityLog;

class ProfileController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
    protected $page_breadcrumbs;
    protected $module;
    protected $moduleCategory;
	public function __construct()
	{
        $this->page_breadcrumbs[] = [
            'page' => route('admin.profile'),
            'title' => __("Thông tin cá nhân")
        ];
	}


	public function profile(Request $request){
        $log = ActivityLog::with('user')->where('user_id',Auth::user()->id)->orderBy('id','desc')->limit(50)->select('user_id','prefix','description','ip','user_agent','created_at')->get();
        return view('admin.profile.index')->with('page_breadcrumbs',$this->page_breadcrumbs)->with('log',$log);
    }



    public function getChangeCurrentPassword(Request $request)
    {   
        ActivityLog::add($request, 'Vào form thay đổi mật khẩu');
        $this->page_breadcrumbs[0] = [
            'page' => '#',
            'title' => __("Thay đổi mật khẩu")
        ];
        return view('admin.profile.password')->with('page_breadcrumbs',$this->page_breadcrumbs);
    }

    public function postChangeCurrentPassword(Request $request){
        $user = User::findOrFail(Auth::user()->id);
        if(Hash::check($request->old_password,$user->password)){
            $user->password=Hash::make($request->password);
            $user->save();
            Auth::login($user);
            return redirect()->back()->with('tab',1)->with('success', trans( 'Đổi mật khẩu thành công'));
        }
        else{
            return redirect()->back()->withErrors(trans('Mật khẩu cũ không đúng'));
        }
    }


}
