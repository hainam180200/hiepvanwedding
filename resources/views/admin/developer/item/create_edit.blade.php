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
{{Form::open(array('route'=>array('admin.'.$module.'.update',$data->id),'method'=>'PUT','id'=>'formMain','enctype'=>"multipart/form-data" , 'files' => true))}}
@else
{{Form::open(array('route'=>array('admin.'.$module.'.store'),'method'=>'POST','id'=>'formMain','enctype'=>"multipart/form-data"))}}
@endif
<input type="hidden" name="submit-close" id="submit-close">
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
            {{-----title------}}
            <div class="form-group row">
               <div class="col-12 col-md-12">
                  <label>{{ __('Tiêu đề') }}</label>
                  <input type="text" id="title_gen_slug" name="title" value="{{ old('title', isset($data) ? $data->title : null) }}" autofocus="true"
                     placeholder="{{ __('Tiêu đề') }}" maxlength="120"
                     class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}">
                  @if ($errors->has('title'))
                  <span class="form-text text-danger">{{ $errors->first('title') }}</span>
                  @endif
               </div>
            </div>
            {{-----slug------}}
            <div class="form-group row">
               <div class="col-12 col-md-12">
                  <label>{{ __('Permalink') }}:</label>
                  <span class="">
                  <a  id="permalink" class="permalink" target="_blank" href="{{Request::getSchemeAndHttpHost()}}/{{ old('slug', isset($data) ? $data->slug : null) }}">
                  <span class="default-slug">{{Request::getSchemeAndHttpHost()}}/<span id="label-slug" data-override-edit="0">{{ old('slug', isset($data) ? $data->slug : null) }}</span></span>
                  </a>
                  <input type="text" value=""  class="form-control" id="input-slug-edit" style="width: auto !important;display: none"/>
                  <a  class="btn btn-light-primary font-weight-bolder mr-2" id="btn-slug-edit">Chỉnh sửa</a>
                  <a  class="btn btn-light-primary font-weight-bolder mr-2" id="btn-slug-renew">Tạo mới</a>
                  <a  class="btn btn-light-primary font-weight-bolder mr-2" id="btn-slug-ok" style="display: none">OK</a>
                  <a  class="btn btn-secondary  button-link mr-2" id="btn-slug-cancel" style="display: none">Cancel</a>
                  <input type="hidden" id="current-slug" name="slug" value="{{ old('slug', isset($data) ? $data->slug : null) }}">
                  <input type="hidden" id="is_slug_override" name="is_slug_override" value="{{ old('is_slug_override', isset($data) ? $data->is_slug_override : null) }}" >
                  </span>
               </div>
            </div>
            {{-----description------}}
            <div class="form-group row">
               <div class="col-12 col-md-12">
                  <label for="locale">{{ __('Mô tả') }}:</label>
                  <textarea id="description" name="description" class="form-control ckeditor-basic" data-height="150"  data-startup-mode="" >{{ old('description', isset($data) ? $data->description : null) }}</textarea>
                  @if ($errors->has('description'))
                  <span class="form-text text-danger">{{ $errors->first('description') }}</span>
                  @endif
               </div>
            </div>
            {{-----content------}}
            <div class="form-group row">
               <div class="col-12 col-md-12">
                  <label for="locale">{{ __('Nội dung') }}</label>
                  <textarea id="content" name="content" class="form-control ckeditor-source" data-height="400"   data-startup-mode="" >{{ old('content', isset($data) ? $data->content : null) }}</textarea>
                  @if ($errors->has('content'))
                  <span class="form-text text-danger">{{ $errors->first('content') }}</span>
                  @endif
               </div>
            </div>
            <div class="form-group row">
               {{-- target --}}
               <div class="col-12 col-md-4">
                  <label  class="form-control-label">{{ __('Kiểu mở link:') }}</label>
                  {{Form::select('target',[''=>'-- Không chọn --',1=>"Mở tab mới",2=>"Mở popup"],old('target', isset($data) ? $data->target : null),array('class'=>'form-control'))}}
                  @if($errors->has('target'))
                  <div class="form-control-feedback">{{ $errors->first('target') }}</div>
                  @endif
               </div>
               {{-- Url Link --}}
               <div class="col-12 col-md-4">
                  <label  class="form-control-label">{{ __('Url Link:') }}</label>
                  <input type="text"  name="url" value="{{ old('url', isset($data) ? $data->url : null) }}"
                     placeholder="{{ __('Url Link') }}"
                     class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}">
                  @if($errors->has('url'))
                  <div class="form-control-feedback">{{ $errors->first('url') }}</div>
                  @endif
               </div>
               {{-- position --}}
               @if(!empty(config('module.'.$module.'.position')))
               <div class="col-12 col-md-4">
                  <label  class="form-control-label">{{ __('Vị trí hiển thị') }}</label>
                  {{Form::select('position',[''=>'-- Không chọn --']+(config('module.'.$module.'.position')??[]),old('position', isset($data) ? $data->position : null),array('class'=>'form-control'))}}
                  @if($errors->has('position'))
                  <div class="form-control-feedback">{{ $errors->first('position') }}</div>
                  @endif
               </div>
               @endif
            </div>
            {{-----gallery block------}}
            <div class="form-group row">
               {{-----image------}}
               <div class="col-md-4">
                  <label for="locale">{{ __('Ảnh đại diện') }}:</label>
                  <div class="">
                     <div class="fileinput  {{ old('image', isset($data) ? $data->image : null)!=""?"fileinput-exists":"fileinput-new" }}  " data-provides="fileinput">
                     <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                        <img src="/assets/backend/images/empty-photo.jpg" data-src="/assets/backend/images/empty-photo.jpg" alt="">
                     </div>
                     <div class="fileinput-preview fileinput-exists thumbnail" style="width: 150px; height: 150px;">
                        @if(old('image', isset($data) ? $data->image : null)!="")
                        <img src="{{ old('image', isset($data) ? \App\Library\Files::media($data->image) : null) }}">
                        <input type="hidden" name="image_oldest" value="1">
                        @endif
                     </div>
                     <div>
                        <span class="btn btn-default btn-file">
                        <span class="fileinput-new">Chọn ảnh đại diện</span>
                        <span class="fileinput-exists">Đổi ảnh đại diện</span>
                        <input type="file" name="image">
                        </span>
                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Xóa</a>
                     </div>
                  </div>
                  @if ($errors->has('image'))
                  <span class="form-text text-danger">{{ $errors->first('image') }}</span>
                  @endif
               </div>
            </div>
            {{-----icon------}}
            <div class="col-md-4">
               <label for="locale">{{ __('Ảnh icon') }}:</label>
               <div class="">
                  <div class="fileinput  {{ old('image_icon', isset($data) ? $data->image_icon : null)!=""?"fileinput-exists":"fileinput-new" }}  " data-provides="fileinput">
                  <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                     <img src="/assets/backend/images/empty-photo.jpg" data-src="/assets/backend/images/empty-photo.jpg" alt="">
                  </div>
                  <div class="fileinput-preview fileinput-exists thumbnail" style="width: 150px; height: 150px;">
                     @if(old('image_icon', isset($data) ? $data->image_icon : null)!="")
                     <img src="{{ old('image_icon', isset($data) ? \App\Library\Files::media($data->image_icon) : null) }}">
                     <input type="hidden" name="image_icon_oldest" value="1">
                     @endif
                  </div>
                  <div>
                     <span class="btn btn-default btn-file">
                     <span class="fileinput-new">Chọn ảnh icon</span>
                     <span class="fileinput-exists">Đổi ảnh icon</span>
                     <input type="file" name="image_icon">
                     </span>
                     <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Xóa</a>
                  </div>
               </div>
               @if ($errors->has('image_icon'))
               <span class="form-text text-danger">{{ $errors->first('image_icon') }}</span>
               @endif
            </div>
         </div>
         {{-----banner------}}
         <div class="col-md-4">
            <label for="locale">{{ __('Ảnh Banner') }}:</label>
            <div class="">
               <div class="fileinput  {{ old('image_banner', isset($data) ? $data->image_banner : null)!=""?"fileinput-exists":"fileinput-new" }}  " data-provides="fileinput">
               <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                  <img src="/assets/backend/images/empty-photo.jpg" data-src="/assets/backend/images/empty-photo.jpg" alt="">
               </div>
               <div class="fileinput-preview fileinput-exists thumbnail" style="width: 150px; height: 150px;">
                  @if(old('image', isset($data) ? $data->image_banner : null)!="")
                  <img src="{{ old('image_banner', isset($data) ? \App\Library\Files::media($data->image_banner) : null) }}">
                  <input type="hidden" name="image_banner_oldest" value="1">
                  @endif
               </div>
               <div>
                  <span class="btn btn-default btn-file">
                  <span class="fileinput-new">Chọn ảnh banner</span>
                  <span class="fileinput-exists">Đổi ảnh banner</span>
                  <input type="file" name="image_banner">
                  </span>
                  <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Xóa</a>
               </div>
            </div>
            @if ($errors->has('image_banner'))
            <span class="form-text text-danger">{{ $errors->first('image_banner') }}</span>
            @endif
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
               {{Form::select('status',(config('module.'.$module.'.status')??[]) ,old('status', isset($data) ? $data->status : null),array('class'=>'form-control'))}}
               @if($errors->has('status'))
               <div class="form-control-feedback">{{ $errors->first('status') }}</div>
               @endif
            </div>
         </div>
         {{-- order --}}
         <div class="form-group row">
            <div class="col-12 col-md-12">
               <label for="order">{{ __('Thứ tự') }}</label>
               <input type="text" name="order" value="{{ old('order', isset($data) ? $data->order : null) }}"
                  placeholder="{{ __('Thứ tự') }}"
                  class="form-control {{ $errors->has('order') ? ' is-invalid' : '' }}">
               @if ($errors->has('order'))
               <span class="form-text text-danger">{{ $errors->first('order') }}</span>
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
<script src="/assets/backend/themes/plugins/custom/html-sortable/jquery.sortable.js"></script>
<script>
   "use strict";
   $(document).ready(function () {
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
       });
   
   
       $('.ckeditor-source').each(function () {
           var elem_id=$(this).prop('id');
           var height=$(this).data('height');
           height=height!=""?height:150;
           var startupMode= $(this).data('startup-mode');
           if(startupMode=="source"){
               startupMode="source";
           }
           else{
               startupMode="wysiwyg";
           }
   
           CKEDITOR.replace(elem_id, {
               filebrowserBrowseUrl     : "{{ route('admin.ckfinder_browser') }}?_token={{csrf_token()}}",
               filebrowserImageBrowseUrl: "{{ route('admin.ckfinder_browser') }}?type=Images&_token={{csrf_token()}}",
               filebrowserFlashBrowseUrl: "{{ route('admin.ckfinder_browser') }}?type=Flash&_token={{csrf_token()}}",
               filebrowserUploadUrl     : "{{ route('admin.ckfinder_connector') }}?command=QuickUpload&type=Files&_token={{csrf_token()}}",
               filebrowserImageUploadUrl: "{{ route('admin.ckfinder_connector') }}?command=QuickUpload&type=Images&_token={{csrf_token()}}",
               filebrowserFlashUploadUrl: "{{ route('admin.ckfinder_connector') }}?command=QuickUpload&type=Flash&_token={{csrf_token()}}",
               height:height,
               startupMode:startupMode,
           } );
       });
       $('.ckeditor-basic').each(function () {
           var elem_id=$(this).prop('id');
           var height=$(this).data('height');
           height=height!=""?height:150;
           CKEDITOR.replace(elem_id, {
               filebrowserBrowseUrl     : "{{ route('admin.ckfinder_browser') }}",
               filebrowserImageBrowseUrl: "{{ route('admin.ckfinder_browser') }}?type=Images&_token={{csrf_token()}}",
               filebrowserFlashBrowseUrl: "{{ route('admin.ckfinder_browser') }}?type=Flash&_token={{csrf_token()}}",
               filebrowserUploadUrl     : "{{ route('admin.ckfinder_connector') }}?command=QuickUpload&type=Files&_token={{csrf_token()}}",
               filebrowserImageUploadUrl: "{{ route('admin.ckfinder_connector') }}?command=QuickUpload&type=Images&_token={{csrf_token()}}",
               filebrowserFlashUploadUrl: "{{ route('admin.ckfinder_connector') }}?command=QuickUpload&type=Flash&_token={{csrf_token()}}",
               height:height,
               removeButtons: 'Source',
           } );
       });
   
       // Image choose item
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
                       elemThumb.attr("src", MEDIA_URL+url);
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
   
       // Image extenstion choose item
       $(".ck-popup-multiply").click(function (e) {
           e.preventDefault();
           var parent = $(this).closest('.ck-parent');
           var elemBoxSort = parent.find('.sortable');
           var elemInput = parent.find('.image_input_text');
           CKFinder.modal({
               connectorPath: '{{route('admin.ckfinder_connector')}}',
               resourceType: 'Images',
               chooseFiles: true,
               width: 900,
   
               height: 600,
               onInit: function (finder) {
                   finder.on('files:choose', function (evt) {
                       var allFiles = evt.data.files;
   
                       var chosenFiles = '';
                       var len = allFiles.length;
                       allFiles.forEach( function( file, i ) {
                           chosenFiles += file.get('url');
                           if (i != len - 1) {
                               chosenFiles += "|";
                           }
   
                           elemBoxSort.append(`<div class="image-preview-box">
                                       <img src="${MEDIA_URL+file.get('url')}" alt="" data-input="${file.get( 'url' )}">
                                       <a rel="8" class="btn btn-xs  btn-icon btn-danger btn_delete_image" data-toggle="modal" data-target="#deleteModal"><i class="la la-close"></i></a>
                                   </div>`);
                       });
                       var allImageChoose=parent.find(".image-preview-box img");
                       var allPath = "";
                       var len = allImageChoose.length;
                       allImageChoose.each(function (index, obj) {
                           allPath += $(this).attr('data-input');
   
                           if (index != len - 1) {
                               allPath += "|";
                           }
                       });
                       elemInput.val(allPath);
   
                       //set lại event cho các nút xóa đã được thêm
                       //remove image extension each item
                       $('.btn_delete_image').click(function (e) {
   
                           var parent = $(this).closest('.ck-parent');
                           var elemInput = parent.find('.image_input_text');
                           $(this).closest('.image-preview-box').remove();
                           var allImageChoose=parent.find(".image-preview-box img");
   
                           var allPath = "";
                           var len = allImageChoose.length;
                           allImageChoose.each(function (index, obj) {
                               allPath += $(this).attr('src');
   
                               if (index != len - 1) {
                                   allPath += "|";
                               }
                           });
                           elemInput.val(allPath);
                       });
                       //khoi tao lại sortable sau khi append phần tử mới
                       $('.sortable').sortable().bind('sortupdate', function (e, ui) {
   
                           var parent = $(this).closest('.ck-parent');
                           var allImageChoose=parent.find(".image-preview-box img");
                           var elemInput = parent.find('.image_input_text');
                           var allPath = "";
                           var len = allImageChoose.length;
                           allImageChoose.each(function (index, obj) {
                               allPath += $(this).attr('src');
   
                               if (index != len - 1) {
                                   allPath += "|";
                               }
                           });
                           elemInput.val(allPath);
                       });
   
                   });
               }
           });
       });
   
       //remove image extension each item
       $('.btn_delete_image').click(function (e) {
   
           var parent = $(this).closest('.ck-parent');
           var elemInput = parent.find('.image_input_text');
           $(this).closest('.image-preview-box').remove();
           var allImageChoose=parent.find(".image-preview-box img");
   
           var allPath = "";
           var len = allImageChoose.length;
           allImageChoose.each(function (index, obj) {
               allPath += $(this).attr('src');
   
               if (index != len - 1) {
                   allPath += "|";
               }
           });
           elemInput.val(allPath);
       });
   
   
       //khoi tao sortable
       $('.sortable').sortable().bind('sortupdate', function (e, ui) {
   
           var parent = $(this).closest('.ck-parent');
           var allImageChoose=parent.find(".image-preview-box img");
           var elemInput = parent.find('.image_input_text');
           var allPath = "";
           var len = allImageChoose.length;
           allImageChoose.each(function (index, obj) {
               allPath += $(this).attr('src');
   
               if (index != len - 1) {
                   allPath += "|";
               }
           });
           elemInput.val(allPath);
       });
   
   
       //ckfinder for upload file
       $(".ck-popup-file").click(function (e) {
           e.preventDefault();
           var parent = $(this).closest('.ck-parent');
   
   
           var elemInput = parent.find('.ck-input');
           var elemBtnRemove = parent.find('.ck-btn-remove');
           CKFinder.modal({
               connectorPath: '{{route('admin.ckfinder_connector')}}',
               resourceType: 'Files',
               chooseFiles: true,
   
               width: 900,
               height: 600,
               onInit: function (finder) {
                   finder.on('files:choose', function (evt) {
                       var file = evt.data.files.first();
                       var url = file.getUrl();
                       elemInput.val(url);
   
                   });
               }
           });
       });
   });
</script>
@endsection