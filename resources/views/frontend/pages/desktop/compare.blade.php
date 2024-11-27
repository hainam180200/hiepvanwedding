@extends('frontend.layouts.master')
@section('seo_head')
@include('frontend.widget.__seo_head')
@endsection
@section('content')
<section>
   <div class="container">
      <div class="compare">
        <table class="table tab-content table-bordered table-striped table-compare">
            <tr class="specs-group">
                <th colspan=" 4">Thông tin chung</th>
             </tr>
             <tr class="specs equaHeight" data-obj="h3">
                <td class="text " style="width:17.5%;">Hình ảnh, giá</td>
                <td class="item image" style="width:27.5%">
                    <p style="text-align:right;"><a href="/{{ isset($data->url)?$data->url : $data->slug }}" class="remove" title="{{ isset($data->title)?$data->title : null }}"><i class="fas fa-minus"></i></a></p>
                    <div class="image">
                        <a href="/{{ isset($data->url)?$data->url : $data->slug }}">
                            <img style="width: 99%" src="{{ isset($data->image)?\App\Library\Files::media($data->image) : null }}" />
                        </a>
                     </div>
                     <h3><a href="/{{ isset($data->url)?$data->url : $data->slug }}">{{ isset($data->title)?$data->title : null }}</a></h3>
                     <div class="price-note">
                        <p class="price">
                           <strong>{{ isset($data->price)? number_format($data->price) : null }} ₫ </strong>
                           <i> | Giá đã bao gồm 10% VAT</i>
                        </p>
                        <p class="note"></p>
                     </div>
                </td>
                <td class="item image" style="width:27.5%">
                    <p style="text-align:right;"><a href="/{{ isset($data_compare->url)?$data_compare->url : $data_compare->slug }}" class="remove" title="{{ isset($data_compare->title)?$data_compare->title : null }}"><i class="fas fa-minus"></i></a></p>
                    <div class="image">
                        <a href="/{{ isset($data_compare->url)?$data_compare->url : $data_compare->slug }}">
                            <img style="width: 99%" class="img-fluid" src="{{ isset($data_compare->image)?\App\Library\Files::media($data_compare->image) : null }}" />
                        </a>
                     </div>
                     <h3><a href="/{{ isset($data_compare->url)?$data_compare->url : $data_compare->slug }}">{{ isset($data_compare->title)?$data_compare->title : null }}</a></h3>
                     <div class="price-note">
                        <p class="price">
                           <strong>{{ isset($data_compare->price)? number_format($data_compare->price) : null }} ₫ </strong>
                           <i> | Giá đã bao gồm 10% VAT</i>
                        </p>
                        <p class="note"></p>
                     </div>
                </td>
             </tr>
             <tr class="specs">
                <th class="text">Khuyến mại</th>
                <td class="data">
                    @if (isset($data->promotion))
                   <ul>
                      @foreach (json_decode($data->promotion) as $key => $items)
                      <li>{{$items}}</li>
                      @endforeach
                   </ul>
                   @endif
                </td>
                <td class="data">
                    @if (isset($data_compare->promotion))
                   <ul>
                      @foreach (json_decode($data_compare->promotion) as $key => $items)
                      <li>{{$items}}</li>
                      @endforeach
                   </ul>
                   @endif
                </td>
             </tr>
             @if (isset($attribute_compare) && count($attribute_compare) > 0)
                <tr class="specs-group">
                    <th class="text" colspan="4">Thông số kĩ thuật</th>
                </tr>
                @foreach ($data_attribute as $key => $item)
                    @foreach ($data_attribute_compare as $key_c => $item_c)
                    @if ($key === $key_c)
                        <tr class="specs">
                        <th class="text">{{$item['attribute']}}</th>
                        <td class="data">
                            <ul>
                                @foreach ($item['value'] as $item_value_i)
                                    <li>{{$item_value_i}}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="data">
                            <ul>
                                @foreach ($item_c['value'] as $item_value_i)
                                    <li>{{$item_value_i}}</li>
                                @endforeach
                            </ul>
                        </td>
                    @endif
                    @endforeach
                @endforeach
             @endif
        </table>
      </div>
   </div>
</section>
@endsection