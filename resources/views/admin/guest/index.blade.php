{{-- Extends layout --}}
@extends('admin._layouts.master')
@section('action_area')
    <ol class="d-flex justify-content-end pr-3">
        <div class="btn-group mt-3">
            <a href="{{route('admin.guest.create')}}" type="button" class="btn btn-success font-weight-bolder mr-3">
                <i class="fas fa-plus-circle icon-md"></i>
                {{__('Thêm mới')}}
            </a>
            <button type="button" class="btn btn-info font-weight-bolder" id="btn-add">
                Thêm nhanh
              </button>
        </div>

    </ol>
@endsection
{{-- Content --}}
@section('content')
    <div class="card card-custom" id="kt_page_sticky_card">
        <div class="card-header">
            <div class="card-title">
                <h3 class="card-label">
                    {{__($page_breadcrumbs[0]['title'])}} <i class="mr-2"></i>
                </h3>
            </div>
            <div class="card-toolbar"></div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->
            <form class="mb-10">
                <div class="row">
                    {{--ID--}}
                    <div class="form-group col-12 col-sm-6 col-lg-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i
                                        class="la la-calendar-check-o glyphicon-th"></i></span>
                            </div>
                            <input type="text" class="form-control datatable-input" id="id" placeholder="{{__('ID')}}">
                        </div>
                    </div>
                    {{--name--}}
                    <div class="form-group col-12 col-sm-6 col-lg-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i
                                        class="fa fa-calendar-check-o"></i></span>
                            </div>
                            <input type="text" class="form-control datatable-input" id="name"
                                   placeholder="{{__('Tên khách mời')}}">
                        </div>
                    </div>
                       {{--type--}}
                       <div class="form-group col-12 col-sm-6 col-lg-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i
                                        class="la la-calendar-check-o glyphicon-th"></i></span>
                            </div>
                            {{Form::select('type',[''=>'-- Tất cả loại --']+config('module.guest.type'),old('type', isset($data) ? $data->type : null),array('id'=>'type','class'=>'form-control datatable-input',))}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-primary btn-primary--icon" id="kt_search">
                            <span>
                                <i class="fa fa-search"></i>
                                <span>Tìm kiếm</span>
                            </span>
                        </button>&#160;&#160;
                        <button class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                            <span>
                                <i class="la la-close"></i>
                                <span>Reset</span>
                            </span>
                        </button>
                    </div>
                </div>
            </form>
            <!--begin: Search Form-->
            <br />
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover dataTable dtr-inline" id="kt_datatable">
            </table>

            <!--end: Datatable-->
        </div>
    </div>


    {{---------------all modal controll-------}}

    <!-- delete item Modal -->
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                {{Form::open(array('route'=>array('admin.guest.destroy',0),'class'=>'form-horizontal','id'=>'form-delete','method'=>'DELETE'))}}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{__('Xác nhận thao tác')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{__('Bạn thực sự muốn xóa?')}}
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" class="id" value=""/>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Hủy')}}</button>
                    <button type="submit" class="btn btn-danger m-btn m-btn--custom btn-submit-custom"
                            data-form="form-delete">{{__('Xóa')}}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="modal fade" id="addModel">
        <div class="modal-dialog">
            <div class="modal-content">
                {{Form::open(array('route'=>array('admin.guest.store'),'class'=>'form-horizontal','id'=>'form-add','method'=>'POST','enctype'=>"multipart/form-data" , 'files' => true))}}
                <input type="text" name="excel" value="1" hidden>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{__('Thêm khách mời nhanh')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-12 col-md-12">
                            <label for="name">{{ __('Tên khách mời')}} <span style="color: red">(*)</span></label>
                            <input type="file" name="file"
                            value=""
                            placeholder="{{ __('Tên khách mời') }}"  autocomplete="off"
                            class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}">
                         </div>
                         <div class="col-12 col-md-12">
                            <label for="status" class="form-control-label">{{ __('Loại khách') }}</label>
                            {{Form::select('type',config('module.guest.type'),old('type', isset($data) ? $data->type : null),array('class'=>'form-control'))}}
                         </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Hủy')}}</button>
                    <button type="submit" class="btn btn-danger m-btn m-btn--custom btn-submit-custom"
                            data-form="form-add">{{__('Xác nhận')}}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

{{-- Styles Section --}}
@section('styles')

@endsection
{{-- Scripts Section --}}
@section('scripts')

    <script>
        "use strict";
        var datatable;
        var KTDatatablesDataSourceAjaxServer = function () {
            var initTable1 = function () {


                // begin first table
                datatable = $('#kt_datatable').DataTable({
                    responsive: true,
                    dom: `<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7 dataTables_pager'Bp>>
                            <'row'<'col-sm-12'tr>>
                        <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
                    lengthMenu: [20, 50, 100, 200, 500, 1000],
                    pageLength: 20,
                    language: {
                        'lengthMenu': 'Display _MENU_',
                    },
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    "order": [[1, "desc"]],
                    ajax: {
                        url: '{{route("admin.guest.index")}}' + '?ajax=1',
                        type: 'GET',
                        data: function (d) {
                            d.id = $('#id').val();
                            d.name = $('#name').val();
                            d.type = $('#type').val();
                        }
                    },
                    buttons: [
                    ],
                    columns: [
                        {data: 'id', title: 'ID'},
                        {
                            data: 'name', title: '{{__('Tên khách mời')}}',
                            render: function (data, type, row) {
                                return row.name
                            }
                        },
                        {
                            data: 'type', title: '{{__('Loại khách mời')}}',
                            render: function (data, type, row) {
                                return row.type
                            }
                        },
                        {
                            data: 'link', title: '{{__('Thiệp online')}}',
                            render: function (data, type, row) {
                                return '<a href="'+row.link+'" target="_blank"><span class="ms-2">Xem thiệp cưới</span></a>';
                            }
                        },
                        {data: 'created_at', title: '{{__('Thời gian')}}'},
                        {data: 'action', title: 'Thao tác', className:"textSmall", orderable: false, searchable: false}

                    ],
                    "drawCallback": function (settings) {
                    }

                });

                var filter = function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                    datatable.column($(this).data('col-index')).search(val ? val : '', false, false).draw();
                };
                $('#kt_search').on('click', function (e) {
                    e.preventDefault();
                    var params = {};
                    $('.datatable-input').each(function () {
                        var i = $(this).data('col-index');
                        if (params[i]) {
                            params[i] += '|' + $(this).val();
                        } else {
                            params[i] = $(this).val();
                        }
                    });

                    $.each(params, function (i, val) {
                        // apply search params to datatable
                        datatable.column(i).search(val ? val : '', false, false);
                    });
                    datatable.table().draw();
                });

                $('#kt_reset').on('click', function (e) {
                    e.preventDefault();
                    $(".datatable-input-select").val('default').selectpicker("refresh");
                    $('.datatable-input').each(function () {
                        $(this).val('');
                        datatable.column($(this).data('col-index')).search('', false, false);
                    });
                    datatable.table().draw();
                });

                datatable.on("click", "#btnCheckAll", function () {
                    $(".ckb_item input[type='checkbox']").prop('checked', this.checked).change();
                })

                datatable.on("change", ".ckb_item input[type='checkbox']", function () {
                    if (this.checked) {
                        var currTr = $(this).closest("tr");
                        // datatable.rows(currTr).select();
                    } else {
                        var currTr = $(this).closest("tr");
                        // datatable.rows(currTr).deselect();
                    }
                });

                //function update field
                datatable.on("change", ".update_field", function (e) {
                    e.preventDefault();
                    var action = $(this).data('action');
                    var field = $(this).data('field');
                    var id = $(this).data('id');
                    var value = $(this).data('value');
                    if (field == 'status') {

                        if (value == 1) {
                            value = 0;
                            $(this).data('value', 1);
                        } else {
                            value = 1;
                            $(this).data('value', 0);
                        }
                    }
                    $.ajax({
                        type: "POST",
                        url: action,
                        data: {
                            '_token': '{{csrf_token()}}',
                            'field': field,
                            'id': id,
                            'value': value
                        },
                        beforeSend: function (xhr) {

                        },
                        success: function (data) {

                            if (data.success) {
                                if (data.redirect + "" != "") {
                                    location.href = data.redirect;
                                }
                                toast('{{__('Cập nhật thành công')}}');
                            } else {

                                toast('{{__('Cập nhật thất bại.Vui lòng thử lại')}}', 'error');
                            }


                        },
                        error: function (data) {
                            toast('{{__('Cập nhật thất bại.Vui lòng thử lại')}}', 'error');
                        },
                        complete: function (data) {

                        }
                    });

                });

            };
            return {

                //main function to initiate the module
                init: function () {
                    initTable1();
                },

            };
        }();

        //Funtion web ready state
        jQuery(document).ready(function () {
            $('body').on('click','#btn-add',function(){
                $('#addModel').modal('show');
            })
            KTDatatablesDataSourceAjaxServer.init();

            $('.datetimepicker-default').datetimepicker({
                format: 'DD/MM/YYYY HH:mm:00',
                useCurrent: true,
                autoclose: true

            });

            $('#deleteModal').on('show.bs.modal', function (e) {
                //get data-id attribute of the clicked element
                var id = $(e.relatedTarget).attr('rel')
                $('#deleteModal .id').attr('value', id);
            });

            //LOCK button
            //triggered when modal is about to be shown
            $('#lockModal').on('show.bs.modal', function (e) {
                //get data-id attribute of the clicked element
                var id = $(e.relatedTarget).attr('rel')
                $('#lockModal .id').attr('value', id);
            });

            $('#unlockModal').on('show.bs.modal', function (e) {
                //get data-id attribute of the clicked element
                var id = $(e.relatedTarget).attr('rel')
                $('#unlockModal .id').attr('value', id);
            });

            // $('.copy_link').click(function (e) {
            // $(".copy_link").on( "click", function() {
            $(document).on('click', '.copy_link', function(e) {
                e.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ <a>
                console.log(4564)
                // Lấy giá trị từ thuộc tính rel
                const textToCopy = $(this).attr('rel');
                // Tạo một input tạm để sao chép nội dung
                const tempInput = $('<input>');
                $('body').append(tempInput);
                tempInput.val(textToCopy).select();
                document.execCommand('copy');
                tempInput.remove();
                // Hiển thị thông báo
                toast('{{__('Đã Copy!')}}', 'success');
            });
            $('.btn-submit-custom').click(function (e) {
                e.preventDefault();
                $(".btn-submit-custom").each(function (index, value) {
                    KTUtil.btnWait(this, "spinner spinner-right spinner-white pr-15", '{{__('Chờ xử lý')}}', true);
                });
                var btn = this;
                //gắn thêm hành động close khi submit
                $('#submit-close').val($(btn).data('submit-close'));
                var formSubmit = $('#' + $(btn).data('form'));
                formSubmit.submit();
            });


        });


    </script>



@endsection
