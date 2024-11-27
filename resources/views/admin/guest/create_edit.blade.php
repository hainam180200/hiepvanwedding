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
{{Form::open(array('route'=>array('admin.guest.update',$data->id),'method'=>'PUT','id'=>'formMain','enctype'=>"multipart/form-data" , 'files' => true))}}
@else
{{Form::open(array('route'=>array('admin.guest.store'),'method'=>'POST','id'=>'formMain','enctype'=>"multipart/form-data"))}}
@endif
<div class="row">
   <div class="col-lg-12">
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
                <div class="col-6 col-md-6">
                    <label for="name">{{ __('Tên khách mời')}} <span style="color: red">(*)</span></label>
                    <input type="text" name="name"
                    value="{{ old('name', isset($data) ? $data->name : null) }}"
                    placeholder="{{ __('Tên khách mời') }}"  autocomplete="off"
                    class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}">
                    @if ($errors->has('name'))
                    <span class="form-text text-danger">{{ $errors->first('name') }}</span>
                    @endif
                 </div>
                 <div class="col-6 col-md-6">
                    <label for="status" class="form-control-label">{{ __('Loại khách') }}</label>
                    {{Form::select('type',config('module.guest.type'),old('type', isset($data) ? $data->type : null),array('class'=>'form-control'))}}
                    @if($errors->has('type'))
                    <div class="form-control-feedback">{{ $errors->first('type') }}</div>
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
@endsection