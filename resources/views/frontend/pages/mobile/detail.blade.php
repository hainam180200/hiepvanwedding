@extends('frontend.layouts.master')
@section('seo_head')
@include('frontend.widget.__seo_head')
@endsection
@section('content')
<section>
   <div class="container scroll">
      <ol class="breadcrumb scroll-x" itemscope itemtype="http://schema.org/BreadcrumbList">
         <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="/"><span itemprop="name" content="Trang chủ"><i class="fas fa-home"></i> Trang chủ</span></a>
            <meta itemprop="position" content="1" />
         </li>
         @if (isset($currentCategory))
         <li><i class="fas fa-chevron-right"></i></li>
         <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="{{isset($currentCategory->url) ? $currentCategory->url : $currentCategory->slug}}" ><span itemprop="name" content="{{$currentCategory->title}}">{{$currentCategory->title}}</span></a>
            <meta itemprop="position" content="2" />
         </li>
         @endif
         <li><i class="fas fa-chevron-right"></i></li>
         <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
            <a itemprop="item" href="{{isset($data->url) ? $data->url : $data->slug}}" title="{{$data->title}}"><span itemprop="name" content="{{$data->title}}">{{$data->title}}</span></a>
            <meta itemprop="position" content="3" />
         </li>
      </ol>
   </div>
</section>
<section>
   <div class="container">
      <div class="product-details">
         <div class="top-product">
            <h1 class="bk-product-name">
               {{$data->title}}
            </h1>
         </div>
         <img src="{{\App\Library\Files::media($data->image)}}" class="bk-product-image" alt="" hidden>
         <input type="hidden" value="1" class="bk-product-qty">
         <div class="product-details-container">
            <div class="product-image">
               <div class="love-this-button">
                  {{--                  <a title="Thêm vào sản phẩm yêu thích" href="javascript:wishProduct(1264, false)"><i class="fas fa-heart"></i></a>--}}
                  @if(auth()->guard('frontend')->check())
                  <button class="btn-favourite" data-id="{{$data->id}}">
                  @if ($favourite == 1)
                  {{--                           <i class="fas fa-heart"></i>--}}
                  <i class="fas fa-heart"></i>
                  @else
                  <i class="far fa-heart"></i>
                  @endif
                  </button>
                  @else
                  <button class='success btn-favourite-login'>
                  <i class="far fa-heart"></i>
                  </button>
                  @endif
               </div>
               <div id="imagePreview">
                  <!-- Loading Screen -->
                  <div data-u="loading" class="loading">
                     <div class="filter"></div>
                     <div class="load-bg"></div>
                  </div>
                  <div data-u="slides" class="viewer">
                     <div>
                        <a data-fancybox="gallery" rel="group" href="{{\App\Library\Files::media($data->image)}}"><img data-u="image" src="{{\App\Library\Files::media($data->image)}}" title="{{$data->title}}" alt="{{$data->title}}" /></a>
                        <div data-u="thumb">
                           <img class="i" src="{{\App\Library\Files::media($data->image)}}" />
                        </div>
                     </div>
                     @if (isset($data->image_extension))
                     @foreach (json_decode($data->image_extension) as $key => $item)
                     <div>
                        <a data-fancybox="gallery" rel="group" href="{{\App\Library\Files::media($item)}}"><img data-u="image" src="{{\App\Library\Files::media($item)}}" title="{{$data->title}}" alt="{{$data->title}}" /></a>
                        <div data-u="thumb">
                           <img class="i" src="{{\App\Library\Files::media($item)}}" />
                        </div>
                     </div>
                     @endforeach
                     @endif
                  </div>
                  <!-- Thumbnail Navigator -->
                  <div data-u="thumbnavigator" class="jssort11" data-autocenter="1" data-scale-bottom="0.75">
                     <!-- Thumbnail Item Skin Begin -->
                     <div class="bg-shadow" style="top: 0;left: -26px;width: 365px;height: 80px;position: absolute;box-shadow: 0px 4px 6px #00000029; border-radius: 8px;"></div>
                     <div data-u="slides" style="cursor:pointer;">
                        <div data-u="prototype" class="p">
                           <div data-u="thumbnailtemplate" class="tp"></div>
                        </div>
                     </div>
                     <span class="slider-t-l">
                     <i class="fas fa-chevron-right"></i>
                     </span>
                     <span class="slider-t-r">
                     <i class="fas fa-chevron-right"></i>
                     </span>
                     <!-- Thumbnail Item Skin End -->
                  </div>
                  <!-- Arrow Navigator -->
                  <span data-u="arrowleft" class="slider-l" data-autocenter="2">
                  <i class="fas fa-chevron-left"></i>
                  </span>
                  <span data-u="arrowright" class="slider-r" data-autocenter="2">
                  <i class="fas fa-chevron-right"></i>
                  </span>
               </div>
            </div>
            <div class="product-center">
               <p class="price current-product-price">
                  <strong class="bk-product-price">
                  {{number_format($data->price)}} ₫
                  </strong>
                  @if (isset($data->price_old) && (int)$data->price_old > 0)
                  <i><strike>{{number_format($data->price_old)}} ₫</strike></i>
                  @endif
                  <i> | Giá đã bao gồm 10% VAT</i>
               </p>
               <p class="freeship">
                  <img src="/assets/frontend/image/vans.svg" alt="" style="width: 20px;padding-right: 8px;filter: invert(88%) sepia(89%) saturate(6%) hue-rotate(184deg) brightness(111%) contrast(97%);"> <span>Miễn phí vận chuyển toàn quốc</span>
               </p>
               <form action=""  id="formDetails">
                  {{ csrf_field() }}
                  <input type="text" name="id" id="id_prd" value="{{$data->id}}" hidden>
                  <br />
                  @if (isset($data_variation) && count($data_variation) > 0)
                     @foreach ($data_variation as $item)
                        <div class="product-option color">
                              <strong class="label" style="font-size: 20px">{{$item[0]['title']??null}}:</strong>
                              <div class="options " id="">
                                 @if (isset($item) && count($item) > 0)
                                    @foreach ($item as $key => $item_sub)
                                       <div id="colorOptions" class="item-out" data-href="/{{$item_sub['slug']}}">
                                          <input type="radio" id="item_{{$item_sub['prd_id']}}" name="options[{{$item_sub['prd_id']}}]" value="{{$item_sub['prd_id']}}" {{$data->id == $item_sub['prd_id'] ? 'checked' : null}} hidden>
                                          <label for="item_{{$item_sub['prd_id']}}">
                                             <div class="item">
                                                <span>
                                                   <div ><i class="fas fa-check"></i></div>
                                                   <div><strong>{{ $item_sub['product_attribute_value_able'] }}</strong></div>
                                                </span>
                                                <strong>{{number_format($item_sub['price'])}} ₫</strong>
                                                <div class="colorGuide" style="background:#2071fc">
                                                   <div><strong>11</strong></div>
                                                </div>
                                             </div>
                                          </label>
                                       </div>
                                    @endforeach
                                 @endif
                              </div>
                        </div>
                     @endforeach
                  @endif
               </form>
               {{-- @if (isset($data->promotion))
               <div class="product-promotion">
                  <strong class="label">KHUYẾN MÃI</strong>
                  <ul>
                     @foreach (json_decode($data->promotion) as $key => $item)
                     <li>
                        <span class="bag">KM {{$key + 1}}</span>
                        <i class="text-dark"><strong>{{$item}}</strong></i>
                     </li>
                     @endforeach
                  </ul>
               </div>
               @endif --}}
               <div class="product-action">
                  {{-- <a title="Mua ngay" class="btn-red btnQuickOrder btnbuy buy_now_button"><strong>MUA NGAY</strong><span> Giao tận nhà (COD) hoặc Nhận tại cửa hàng</span></a>
                  <a title="Thêm vào giỏ hàng" data-sku="FLIP36D" href="javascript:;" id="add-cart" class="btn-orange btnbuy btn-icon"><i class="fas fa-cart-plus"></i></a> --}}
                  <div class='bk-btn'></div>
               </div>
            </div>
            @if (isset($data->insurance))
            <div class="warranty text-center">
               <h4>THÔNG TIN BẢO HÀNH</h4>
               {!! $data->insurance !!}
            </div>
            @endif
            <div class="product-shop">
               <div class="check-stock" id="marketFilter">
                  <div class="city">
                     <p>Chọn màu và xem địa chỉ còn hàng</p>
                  </div>
                  <div class="store">
                     <ul>
                        <li><span>{{setting('sys_address')}}<a title="{{setting('sys_address')}}" href="#">Bản đồ đường đi</a></span></li>
                     </ul>
                  </div>
               </div>
               <div class="out-date">
                  <p class="title"><strong><a style="color: #000;font-size:14px" href="{{isset($data->url) ? $data->url : $data->slug}}">{{$data->title}} - {{setting('sys_title')}}</a></strong></p>
                  <div class="note">
                     <p><i>Giá chỉ từ:</i> <strong class="text-red">{{number_format($data->price)}} ₫</strong></p>
                     @if (isset($data->price_old))
                     <p><i>Tiết kiệm:</i> <strong class="text-red">{{number_format($data->price_old - $data->price)}} ₫</strong></p>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section>
   <div class="product-layout">
      <div class="product-specs">
         <h3>Thông số kỹ thuật {{$data->title}}</h3>
         <div class="product-spect-img">
            <img src="{{\App\Library\Files::media($data->image)}}" title="{{$data->title}}" />
            <a data-padding="0px" data-width="600px" class="modal-toggle product-specs-button detail_config_button_cauhinh"><span class="icon-config"></span><i class="fas fa-tools"></i> <strong>Cấu hình chi tiết</strong></a>
         </div>
         <div class="modal detail_config_cauhinh ">
            <div class="modal-overlay detail_config_button_cauhinh"></div>
            <div class="modal-wrapper modal-transition">
               <div class="modal-header">
                  <button class="modal-close detail_config_button_cauhinh"><i class="fas fa-times"></i></button>
                  @if (isset($data_attribute) && count($data_attribute))
                     <table class="table table-border">
                        <tbody>
                              <tr>
                                 <th colspan="2">
                                    <span class="f-16">Thông số kĩ thuật</span>
                                 </th>
                              </tr>
                              @if (isset($data_attribute) && count($data_attribute) > 0)
                              @foreach ($data_attribute as $item)
                                 <tr>
                                    <td class="table-gray">
                                       <strong>{{$item['attribute']}}:</strong>
                                    </td>
                                    <td>
                                       <span>
                                          @if (isset($item['value']) && count($item['value']) > 0)
                                             @foreach ($item['value'] as $key => $item_sub)
                                                <span>{{$key === 0 ? null : ', ' }}{{$item_sub}}</span>
                                             @endforeach
                                          @endif
                                       </span>
                                 </td>
                                 </tr>
                              @endforeach
                              @endif
                        </tbody>
                     </table>
                     @endif
               </div>
            </div>
         </div>
         @if (isset($data_attribute) && count($data_attribute) > 0)
            <div class="specs-special">
               @php 
               $count_n = 0;
               @endphp
               @foreach ($data_attribute as $key_i => $item)
                  @if ($count_n < 8)
                     <ol>
                        <li>
                           <strong>{{$item['attribute']}}:</strong>
                           @if (isset($item['value']) && count($item['value']) > 0)
                              @foreach ($item['value'] as $key => $item_sub)
                                 <span>{{$key === 0 ? null : ', ' }}{{$item_sub}}</span>
                              @endforeach
                           @endif
                        </li>
                     </ol>
                  @endif
                  @php 
                  $count_n++;
                  @endphp
               @endforeach
            </div>
         @endif
      </div>
   </div>
</section>
<section>
   <div class="product-layout">
      <div class="product-text" id="productContent">
         {!! $data->content !!}
      </div>
      <div class="view-more-container">
         <a href="javascript:;" id="viewMoreContent">Xem thêm</a>
      </div>
   </div>
</section>
<!-- news -->
<section>
   <div class="container">
      <div class="news-home box-home">
         {{--
         <div class="header">
            --}}
            {{--
            <h4><a href="/tin-tuc">TIN TỨC LIÊN QUAN</a></h4>
            --}}
            {{--
         </div>
         --}}
         <div class="scroll">
            <div class="col-content scroll-x">
               @if(isset($items_blog) && count($items_blog) > 0)
               @foreach($items_blog as $groupitem)
               <div class="item">
                  <div class="img">
                     <a href="/blog/{{isset($groupitem->url) ? $groupitem->url : $groupitem->slug}}"><img src="{{ isset($groupitem->image)?\App\Library\Files::media($groupitem->image): null }}"></a>
                  </div>
                  <p>
                     <a href="/blog/{{isset($groupitem->url) ? $groupitem->url : $groupitem->slug}}">{{isset($groupitem->title) ? $groupitem->title : ''}}</a>
                     <br />
                     <i>{{isset($groupitem->created_at) ? $groupitem->created_at->format('Y.m.d')  : ''}}</i>
                  </p>
               </div>
               @endforeach
               @endif
            </div>
         </div>
      </div>
   </div>
</section>
<section>
   <div class="container">
      <div class="full-width-content">
         <div class="product-quick-compare">
            <div class="header">
               <h3>So sánh sản phẩm tương tự</h3>
            </div>
            <div class="scroll">
               <div class="lts-product lts-product-compare scroll-x equaHeight" data-obj="a.title">
                  @if(isset($items_prd) && count($items_prd) > 0)
                     @foreach($items_prd as $key => $item)
                        <div class="item">
                           <div class="img">
                              <a href="{{isset($item->url) ? $item->url : $item->slug}}" title="{{isset($item->url) ? $item->url : $item->slug}}">
                              <img src="{{ isset($item->image)?\App\Library\Files::media($item->image): null }}" alt="{{isset($item->url) ? $item->url : $item->slug}}" title="{{isset($item->title) ? $item->title :null}}">
                              </a>
                           </div>
                           @if (isset($item->percent_sale) && (int)$item->percent_sale > 0)
                           <span class="sales">
                           <i class="fas fa-bolt"></i> Giảm {{number_format($item->price)}} ₫
                           </span>
                           @endif
                           <div class="info">
                              <a href="/{{isset($item->url) ?$item->url : $item->slug}}" class="title" title="{{$item->title}}">{{$item->title}}</a>
                              <span class="price">
                              <strong>{{number_format($item->price)}} ₫</strong>
                              @if (isset($item->percent_sale) && (int)$item->percent_sale > 0)
                              <strike>{{$item->price_old}} ₫</strike>
                              @endif
                              </span>
                           </div>
                           <div class="info-compare">
                              <a href="/so-sanh/{{$data->slug}}-voi-{{$item->slug}}" title="{{$item->title}}"><i class="fas fa-sort-amount-up-alt"></i> <span>So sánh</span></a>
                           </div>
                        </div>
                     @endforeach
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
{{--comment--}}
<!-- BK MODAL -->
<div id='bk-modal'></div>
<!-- END BK MODAL -->
<script>
   $('body').on('click','.item-out',function(){
      var link = $(this).data('href');
      location.href = link;
   })
</script>
@include('frontend.pages.mobile.comment')
{!! widget('frontend.widget.mobile._section_widget_banner_nature') !!}
@endsection
