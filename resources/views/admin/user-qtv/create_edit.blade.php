{{-- Extends layout --}}
@extends('admin._layouts.master')
@section('action_area')
<ol class="d-flex justify-content-end pr-3">
   <div class="btn-group mt-3">
      <button type="button" class="btn btn-success font-weight-bolder btn-submit-custom" data-form="formMain" data-submit-close="1">
      @if(isset($data))
      {{__('Cập nhật')}}
      @else
      {{__('Thêm mới')}}
      @endif
      </button>
   </div>
</ol>
@endsection
{{-- Content --}}
@section('content')
@if(isset($data))
{{Form::open(array('route'=>array('admin.user-qtv.update',$data->id),'method'=>'PUT','id'=>'formMain','enctype'=>"multipart/form-data" , 'files' => true))}}
@else
{{Form::open(array('route'=>array('admin.user-qtv.store'),'method'=>'POST','id'=>'formMain','enctype'=>"multipart/form-data"))}}
@endif
<div class="row">
   <div class="col-lg-9">
      <div class="card card-custom gutter-b">
         <div class="card-header">
            <div class="card-title">
               <h3 class="card-label">
                  {{__($page_breadcrumbs[0]['title'])}} <i class="mr-2"></i>
               </h3>
            </div>
         </div>
         <div class="card-body">
            <input type="hidden" name="submit-close" id="submit-close">
            <div class="form-group row">
               <div class="col-12 col-md-6">
                  <label for="username">{{ __('Tên tài khoản')}} <span style="color: red">(*)</span></label>
                  <input type="text" name="username"
                  value="{{ old('username', isset($data) ? $data->username : null) }}"
                  placeholder="{{ __('Tên tài khoản') }}" {{isset($data)?"readonly":""}}  autocomplete="off"
                  class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}">
                  @if ($errors->has('username'))
                  <span class="form-text text-danger">{{ $errors->first('username') }}</span>
                  @endif
               </div>
               {{-----email------}}
               <div class="col-12 col-md-6">
                  <label for="title">{{ __('Email')}} <span style="color: red">(*)</span></label>
                  <input type="text" name="email" value="{{ old('email', isset($data) ? $data->email : null) }}"
                     placeholder="{{ __('Email') }}"
                     class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" autocomplete="off">
                  @if ($errors->has('email'))
                  <span class="form-text text-danger">{{ $errors->first('email') }}</span>
                  @endif
               </div>
            </div>
            <div class="form-group row">
               {{-----password------}}
               <div class="col-12 col-md-6">
                  <label for="title">{{ __('Mật khẩu cấp 1')}} <span style="color: red">(*)</span></label>
                  <input type="password" name="password" value=""
                     placeholder="{{ __('Mật khẩu cấp 1') }}"
                     class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}">
                  @if ($errors->has('password'))
                  <span class="form-text text-danger">{{ $errors->first('password') }}</span>
                  @endif
               </div>
               {{-----password2------}}
               <div class="col-12 col-md-6">
                  <label for="title">{{ __('Mật khẩu cấp 2')}} <span style="color: red">(*)</span></label>
                  <input type="password" name="password2" value=""
                     placeholder="{{ __('Mật khẩu cấp 2') }}"
                     class="form-control {{ $errors->has('password2') ? ' is-invalid' : '' }}">
                  @if ($errors->has('password2'))
                  <span class="form-text text-danger">{{ $errors->first('password2') }}</span>
                  @endif
               </div>
            </div>
            <div class="form-group row">
               {{-----phone------}}
               <div class="col-12 col-md-6">
                  <label for="title">{{ __('Số điện thoại')}}</label>
                  <input type="text" name="phone" value="{{ old('phone', isset($data) ? $data->phone : null) }}"
                     placeholder="{{ __('Số điện thoại') }}"
                     class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}">
                  @if ($errors->has('phone'))
                  <span class="form-text text-danger">{{ $errors->first('phone') }}</span>
                  @endif
               </div>
                {{-----role_id------}}
                <div class="col-12 col-md-6">
                    <label for="title">{{ __('Nhóm vai trò')}}</label>
                    <select name="role_ids[]" multiple="multiple" title="" class="form-control select2 col-md-5"  data-placeholder="{{__('Chọn vai trò')}}" id="kt_select2_2" style="width: 100%">
                    @if( !empty(old('role_id')) )
                    {!!\App\Library\Helpers::buildMenuDropdownList($roles,old('role_ids')) !!}
                    @else
                    @if(isset($data))
                    {!!\App\Library\Helpers::buildMenuDropdownList($roles,($data->roles->pluck('id')->toArray())??[]) !!}
                    @else
                    {!!\App\Library\Helpers::buildMenuDropdownList($roles,null) !!}
                    @endif
                    @endif
                    </select>
                    @if($errors->has('role_ids'))
                    <div class="form-control-feedback text-danger">{{ $errors->first('role_ids') }}</div>
                    @endif
                 </div>
            </div>
            {{-----gallery block------}}
            <div class="form-group  {{ $errors->has('locale') ? ' text-danger' : '' }} ">
               <div class="row">
                  {{-----image------}}
                  <div class="col-12 col-md-4">
                     <label for="locale">{{ __('Hình đại diện') }}:</label>
                     <div class="">
                        <div class="fileinput ck-parent" data-provides="fileinput">
                           <div class="fileinput-new thumbnail" style="width: 150px; height: 150px">
                              @if(old('image', isset($data) ? $data->image : null)!="")
                              <img class="ck-thumb" src="{{ old('image', isset($data) ? $data->image : null) }}">
                              @else
                              <img class="ck-thumb" src="/assets/backend/themes/images/empty-photo.jpg" alt="">
                              @endif
                              <input class="ck-input" type="hidden" name="image" value="{{ old('image', isset($data) ? $data->image : null) }}">
                           </div>
                           <div>
                              <a href="#" class="btn red fileinput-exists ck-popup "> {{__("Thay đổi")}} </a>
                              <a href="#" class="btn red fileinput-exists ck-btn-remove" > {{__("Xóa")}} </a>
                           </div>
                        </div>
                        @if ($errors->has('image'))
                        <span class="form-text text-danger">{{ $errors->first('image') }}</span>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-3">
      <div class="card card-custom gutter-b">
         <div class="card-header">
            <div class="card-title">
               <h3 class="card-label">
                  Trạng thái <i class="mr-2"></i>
               </h3>
            </div>
         </div>
         <div class="card-body">
            {{-- status --}}
            <div class="form-group row">
               <div class="col-12 col-md-12">
                  <label for="status" class="form-control-label">{{ __('Trạng thái') }}</label>
                  {{Form::select('status',config('module.user-qtv.status'),old('status', isset($data) ? $data->status : null),array('class'=>'form-control'))}}
                  @if($errors->has('status'))
                  <div class="form-control-feedback">{{ $errors->first('status') }}</div>
                  @endif
               </div>
            </div>
            {{-- created_at --}}
            <div class="form-group row">
               <div class="col-12 col-md-12">
                  <label>{{ __('Ngày tạo') }}</label>
                  <div class="input-group">
                     <input type="text" class="form-control  datetimepicker-input datetimepicker-default"
                        name="created_at"
                        value="{{ old('created_at', isset($data) ? $data->created_at->format('d/m/Y H:i:s') : date('d/m/Y H:i:s')) }}"
                        placeholder="{{ __('Ngày tạo') }}" autocomplete="off"
                        data-toggle="datetimepicker">
                     <div class="input-group-append">
                        <span class="input-group-text"><i class="la la-calendar"></i></span>
                     </div>
                  </div>
                  @if($errors->has('created_at'))
                  <div class="form-control-feedback">{{ $errors->first('created_at') }}</div>
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
{{ Form::close() }}
@endsection
{{-- Styles Section --}}
@section('styles')
@endsection
{{-- Scripts Section --}}
@section('scripts')
<script>
   "use strict";
   
   jQuery(document).ready(function () {
   
   });
   
   $(document).ready(function () {
   
       // Demo 6
       $('.datetimepicker-default').datetimepicker({
           useCurrent: true,
           autoclose: true,
           format: "DD/MM/YYYY HH:mm:ss"
       });
   
       //btn submit form
       $('.btn-submit-custom').click(function (e) {
           e.preventDefault();
           var btn = this;
           $(".btn-submit-custom").each(function (index, value) {
               KTUtil.btnWait(this, "spinner spinner-right spinner-white pr-15", '{{__('Chờ xử lý')}}', true);
           });
           $('.btn-submit-dropdown').prop('disabled', true);
           //gắn thêm hành động close khi submit
           $('#submit-close').val($(btn).data('submit-close'));
           var formSubmit = $('#' + $(btn).data('form'));
           formSubmit.submit();
   
           // var url = formSubmit.attr('action');
           {{--$.ajax({--}}
           {{--    type: "POST",--}}
           {{--    url: url,--}}
           {{--    data: formSubmit.serialize(), // serializes the form's elements.--}}
           {{--    beforeSend: function (xhr) {--}}
   
           {{--    },--}}
           {{--    success: function (data) {--}}
           {{--        if (data.success) {--}}
           {{--            if (data.redirect + "" != "") {--}}
           {{--                location.href = data.redirect;--}}
           {{--            }--}}
           {{--            toast('{{__('Cập nhật thành công')}}');--}}
           {{--        } else {--}}
           {{--            toast('{{__('Cập nhật thất bại.Vui lòng thử lại')}}', 'error');--}}
           {{--        }--}}
           {{--    },--}}
           {{--    error: function (data) {--}}
           {{--        toast('{{__('Cập nhật thất bại.Vui lòng thử lại')}}', 'error');--}}
           {{--    },--}}
           {{--    complete: function (data) {--}}
           {{--        KTUtil.btnRelease(btn);--}}
           {{--    }--}}
           {{--});--}}
   
       });
   
   });
   
</script>
<script>
   $(".ck-popup").click(function (e) {
       e.preventDefault();
       var parent = $(this).closest('.ck-parent');
   
       var elemThumb = parent.find('.ck-thumb');
       var elemInput = parent.find('.ck-input');
       var elemBtnRemove = parent.find('.ck-btn-remove');
       CKFinder.modal({
           connectorPath: '{{route('admin.ckfinder_connector')}}',
           resourceType: 'Images',
           chooseFiles: true,
           width: 900,
           height: 600,
           onInit: function (finder) {
               finder.on('files:choose', function (evt) {
                   var file = evt.data.files.first();
                   var url = file.getUrl();
                   elemThumb.attr("src", url);
                   elemInput.val(url);
   
               });
           }
       });
   });
   $(".ck-btn-remove").click(function (e) {
       e.preventDefault();
   
       var parent = $(this).closest('.ck-parent');
   
       var elemThumb = parent.find('.ck-thumb');
       var elemInput = parent.find('.ck-input');
       elemThumb.attr("src", "/assets/backend/themes/images/empty-photo.jpg");
       elemInput.val("");
   
   });
   
</script>
@endsection