@extends('frontend.layouts.master')
@section('content')
    <section class="account">

        @include('frontend.pages.account.sidebar')
        <div class="body-content">

            @if(isset($detail))
            <div class="cart cart-checkout">
                <div class="header">
                    <div class="back">
                        <a href="/">
                            <i class="fas fa-chevron-left"></i>
                            <strong>Quay lại</strong>
                        </a>
                    </div>
                </div>
                <div class="just-center">
                    <div class="cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <label>THÔNG TIN ĐƠN HÀNG</label>
                    </div>
                </div>
                <div class="order-infomation">
                    <h3>1. Thông tin người đặt hàng</h3>
                    <table class="table talbe-order">
                        <tr>
                            <td class="label" style="width:110px;">{{config('order.detail.module.fullname.title')}}</td>
                            <td class="content">{{App\Library\HelperOrder::getValDetai($detail,config('order.detail.module.fullname.key'))}}</td>
                            <td class="label" style="width:95px;">{{config('order.detail.module.phone.title')}}</td>
                            <td class="content">{{App\Library\HelperOrder::getValDetai($detail,config('order.detail.module.phone.key'))}}</td>
                            <td class="label" style="width:75px;">{{config('order.detail.module.email.title')}}</td>
                            <td class="content">{{App\Library\HelperOrder::getValDetai($detail,config('order.detail.module.email.key'))}}</td>
                        </tr>
                        <tr>
                            <td class="label">Phương thức</td>
                            <td class="content">{{config('order.type.'.$data->type)}} </td>
                            {{-- <td>Nhận hàng tại</td>
                            <td>
                               <span> Chưa xác thực </span>
                            </td> --}}
                        </tr>
                        <tr>
                            <td class="label">{{config('order.detail.module.address.title')}}</td>
                            <td class="content" colspan="5">{{App\Library\HelperOrder::getValDetai($detail,config('order.detail.module.address.key'))}}</td>
                        </tr>
                        @if (isset($data->content))
                            <tr>
                                <td class="label">Ghi chú đặt hàng:</td>
                                <td colspan="5">{{$data->content}}</td>
                            </tr>
                        @endif
                    </table>
                </div>
                <div class="order-infomation">
                    <h3>2. Danh sách sản phẩm đặt hàng</h3>
                    <table class="table table-border talbe-order table-product">
                        <tbody>
                        <tr>
                            <th>#</th>
                            <th>Tên sản phẩm</th>
                            <th>SL</th>
                            <th>Thông tin chi tiết</th>
                            <th>Tình trạng</th>
                            <th>Giá tiền</th>
                            <th>Tổng (SLxG)</th>
                        </tr>
                        @foreach ($detail as $key => $item)
                            @if ($item->module === "product")
                                @php
                                    $quantity = $item->quantity
                                @endphp
                                <tr>
                                    <td align="center" valign="middle" rowspan="{{ isset($item->item->promotion) && count(json_decode($item->item->promotion)) > 1 ? count(json_decode($item->item->promotion)) + 1 : 1  }}">{{$key+1}}</td>
                                    <td><strong>{{$item->item->title}}</strong></td>
                                    <td align="center">{{$item->quantity}}</td>
                                    <td align="center">
                                        @php
                                            $val_order_detail = App\Library\HelperOrder::getAttribute($item->value);
                                        @endphp
                                        @if (isset($val_order_detail) && $val_order_detail != null)
                                            @foreach ($val_order_detail as $key_val_o => $item_val_o)
                                                - {{$item_val_o['key']}} : {{$item_val_o['value']}}
                                                <br />
                                            @endforeach
                                        @else
                                            Mặc định
                                        @endif
                                    </td>

                                    @if($item->status == 0)
                                        <td style="text-align: center;color: #f63">Đã hủy</td>
                                    @elseif($item->status == 1)
                                        <td style="text-align: center;color: #f63">Đã xử lý (Đang chờ giao hàng)</td>
                                    @elseif($item->status == 2)
                                        <td style="text-align: center;color: #f63">Đang chờ xử lý</td>
                                    @elseif($item->status == 3)
                                        <td style="text-align: center;color: #f63">Đang giao hàng</td>
                                    @elseif($item->status == 4)
                                        <td style="text-align: center;color: #f63">Đơn hàng đã thành công</td>
                                    @endif
                                    <td align="center">
                                        {{number_format($item->item->price)}} ₫
                                    </td>
                                    <td align="center">{{number_format($quantity * $item->item->price)}} ₫</td>
                                </tr>
                                @if (isset($item->item->promotion))
                                    @foreach (json_decode($item->item->promotion) as $key => $item)
                                        <tr class="text-darkgray">
                                            <td colspan="6"><label class="bag">KM</label> <i>{{$item}}</i></td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endif
                        @endforeach
                        <tr class="no-border">
                            <td colspan="5" align="right">Tổng tiền:</td>
                            <td>{{number_format($data->price)}} ₫</td>
                        </tr>
                        <tr class="no-border">
                            <td colspan="5" align="right">Giảm giá:</td>
                            <td>-{{number_format($data->price - $data->real_received_price)}} ₫</td>
                        </tr>
                        <tr class="no-border">
                            <td colspan="5" align="right">Tổng tiền thanh toán:</td>
                            <td><strong class="text-red">{{number_format($data->real_received_price)}} ₫</strong></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            @else

                <h3>Đơn hàng đã đặt</h3>
                <div class="box-bg-white">
                    <div style="padding:25px;">
                        <table class="table table-border table-lgpading">
                            <tr>
                                <th>#</th>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt</th>
                                <th>Sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Trạng thái</th>

                                <th>Tổng tiền</th>
                                <th>Giảm giá</th>

                            </tr>

                            @foreach($data as $order)

                                <tr>
                                    <td>#</td>
                                    <td><a href="/account/order/{{$order->id}}">{{$order->id}}</a></td>
                                    <td>{{$order->created_at}}</td>
                                    @php
                                      $order_detail = App\Models\OrderDetail::where('order_id',$order->id)->get();
                                    @endphp
                                    <td>
                                    @foreach($order_detail as $order_details)
                                        @php
                                            $item_pr = \App\Models\Item::where('module','product')->where('id',$order_details->item_id)->get();

                                        @endphp

                                        @foreach($item_pr as $item_prs)


                                                <li>{{$item_prs->title ? $item_prs->title:''}}</li>

                                            @endforeach
                                        @endforeach
                                    </td>

                                    <td style="list-style: none">
                                        @foreach($order_detail as $order_details)
                                            @php
                                                $item_pr = \App\Models\Item::where('module','product')->where('id',$order_details->item_id)->get();

                                            @endphp

                                            @foreach($item_pr as $item_prs)


                                                <li>
                                                    <img src="{{ isset($item_prs->image)?\App\Library\Files::media($item_prs->image) : null }}" alt="{{isset($item_prs->title) ? $item_prs->title : null}}" style="width: 60px" />

                                                </li>

                                            @endforeach
                                        @endforeach
                                    </td>

                                    @if($order->status == 0)
                                        <td style="text-align: center;color: #f63">Đã hủy</td>
                                    @elseif($order->status == 1)
                                        <td style="text-align: center;color: #f63">Đã xử lý (Đang chờ giao hàng)</td>
                                    @elseif($order->status == 2)
                                        <td style="text-align: center;color: #f63">Đang chờ xử lý</td>
                                    @elseif($order->status == 3)
                                        <td style="text-align: center;color: #f63">Đang giao hàng</td>
                                    @elseif($order->status == 4)
                                        <td style="text-align: center;color: #f63">Đơn hàng đã thành công</td>
                                    @endif

                                    <td>{{number_format($order->price)}} </td>
                                    <td>@if($order->ratio)- {{$order->ratio}}@else - 0 @endif</td>

                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <script>
        $(document).ready(function () {
            $('.activeorder').addClass('active')
        })
    </script>
@endsection
