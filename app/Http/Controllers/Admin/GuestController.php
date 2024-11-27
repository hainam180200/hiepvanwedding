<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Guest;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use App\Library\Helpers;
use Maatwebsite\Excel\Facades\Excel;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $page_breadcrumbs;
    //Quản trị viên (Nội bộ)
    protected $account_type=1;

    public function __construct()
    {
        $this->page_breadcrumbs[] = [
            'page' => route('admin.guest.index'),
            'title' => __("Danh sách khách mời")
        ];
    }
    public function index(Request $request)
    {
        $host = $request->getSchemeAndHttpHost();
        if($request->ajax) {
            $datatable= Guest::orderBy('id','asc');
            if ($request->filled('id'))  {
                $datatable->where('id', 'LIKE', '%' . $request->get('id') . '%');
            }
            if ($request->filled('name'))  {
                $datatable->where('name', 'LIKE', '%' . $request->get('name') . '%');
            }
            if ($request->filled('type'))  {
                $datatable->where('type',$request->get('type'));
            }
            return \datatables()->eloquent($datatable)->whitelist(['id'])
                ->only([
                    'id',
                    'name',
                    'type',
                    'action',
                    'link',
                    'created_at',
                ])
                ->editColumn('created_at', function($row) {
                    return date('d/m/Y H:i:s', strtotime($row->created_at));
                })
                ->editColumn('type', function($row) {
                    if($row->type == 1){
                        return "Có người thương";
                    }
                    return "Không người thương";
                })
                ->addColumn('link', function($row) use($host) {
                    return $host.'/invitation/'.$row->link;
                })
                ->addColumn('action', function($row) use($host) {
                    $temp= "<a href=\"".route('admin.guest.edit',$row->id)."\"  rel=\"$row->id\" class=\"btn btn-outline-warning btn-sm mr-1 \"><span>Sửa</span></a>";
                    $temp.= "<a  rel=\"$row->id\" class='btn btn-outline-danger btn-sm mr-1 delete_toggle' data-toggle=\"modal\" data-target=\"#deleteModal\" class=\"delete_toggle\"><i class=\"fa fa-trash-o\"></i> <span>Xóa</span></a>";
//                    $temp.= "<a  rel=\"$row->id\" class='btn btn-sm  btn-icon btn-hover-text-white btn-hover-text-white btn-hover-bg-danger delete_toggle' data-toggle=\"modal\" data-target=\"#deleteModal\" class=\"delete_toggle\" title=\"Xóa\"><i class=\"la la-trash\"></i></a>";
                    if ($row->url_display != ''){
                        $temp.= "<a href='javascript:void(0)'  rel=\"$host/invitation/$row->url_display\" class='btn btn-outline-success btn-sm  btn-icon btn-hover-text-white btn-hover-text-white btn-hover-bg-danger copy_link'   title=\"Copy\">Copy</a>";
                    }else{
                        $temp.= "<a href='javascript:void(0)'  rel=\"$host/invitation/$row->link\" class='btn btn-outline-success btn-sm  btn-icon btn-hover-text-white btn-hover-text-white btn-hover-bg-danger copy_link'   title=\"Copy\">Copy</a>";
                    }
                    return $temp;
                })
                ->toJson();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->page_breadcrumbs[] =[
            'page' => '#',
            'title' => __("Thêm mới")
        ];
        return view('admin.guest.create_edit')
            ->with('page_breadcrumbs', $this->page_breadcrumbs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if($request->filled('excel') && $request->get('excel') == '1'){
            $this->validate($request, [
                'type' => 'required',
            ], [
                'type.required' => 'Vui lòng nhập loại khách mời',
            ]);
            $fileName = "acc-".uniqid()."-".$request->file('file')->getClientOriginalName();
            $request->file('file')->move('temp', $fileName);
            $data_import = \Excel::toArray(new \App\Imports\ExcelArray(),  public_path("temp/{$fileName}"))[0];
            @unlink("temp/{$fileName}");
            foreach($data_import as $key => $value){
                if($key > 0 && $value != ''){
                    $user = Guest::create([
                        'name' => $value[0],
                        'type' => $input['type'],
                    ]);
                    $user->link = md5($user->id);
                    $user->url_display = GuestController::slugify($user->name);

                    $user->save();
                }
            }
            return redirect()->back()->with('success', __('Thêm mới thành công !'));
        }
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
        ], [
            'name.required' => 'Vui lòng nhập tên khách mời',
            'type.required' => 'Vui lòng nhập loại khách mời',
        ]);
        $data = Guest::create($input);
        $data->link = md5($data->id);
        $data->url_display = $this->slugify($data->name);
        $data->save();
        return redirect()->back()->with('success', __('Thêm mới thành công !'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $this->page_breadcrumbs[] =[
            'page' => '#',
            'title' => __("Cập nhật")
        ];
        $data = Guest::findOrFail($id);
        return view('admin.guest.create_edit')
            ->with('data', $data)
            ->with('page_breadcrumbs', $this->page_breadcrumbs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
        ], [
            'name.required' => 'Vui lòng nhập tên khách mời',
            'type.required' => 'Vui lòng nhập loại khách mời',
        ]);
        $data = Guest::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        return redirect()->back()->with('success', __('Chỉnh sửa thành công !'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user_id = $request->id;
        $data = Guest::findOrFail($user_id);
        $data->delete();
        return redirect()->back()->with('success', __('Xóa thành công !'));
    }

    public function slugify($string)
    {
        // Loại bỏ dấu tiếng Việt
//        $transliterated = iconv('UTF-8', 'ASCII//TRANSLIT', $string);

        // Loại bỏ các ký tự không phải chữ và số, chuyển thành chữ thường, thay khoảng trắng bằng dấu gạch ngang
        $slug = Str::slug($string);

        return $slug;
    }
}
