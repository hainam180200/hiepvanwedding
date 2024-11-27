@if (isset($data) && count($data) > 0)
    <section>
        <div class="box-product-home box-home">
            <div class="header">
                <h4><a href="#">{{setting('sys_name_widget_2')}}</a></h4>
            </div>
            <div class="lts-product col-product">
                @foreach ($data as $key => $item)
                    <div class="item">
                        <div class="img">
                            <a href="{{isset($item->product->url) ? $item->product->url : $item->product->slug}}" title="{{isset($item->product->title) ? $item->product->title : null}}">
                            <img src="{{ isset($item->product->image)?\App\Library\Files::media($item->product->image) : null }}" alt="{{isset($item->product->title) ? $item->product->title : null}}" class="img-fluid">
                            </a>
                        </div>
                        {{-- <div class="sticker sticker-left">
                            <span><img src="/assets/frontend/image/apple.png" title="Ch&#237;nh h&#227;ng Apple" /></span>
                        </div> --}}
                        @if (isset($item->product->percent_sale) && (int)$item->product->percent_sale > 0)
                            <span class="sales">
                                <i class="fas fa-bolt"></i> Giảm {{number_format($item->product->price - $item->product->price_old)}} ₫
                            </span>
                        @endif
                        <div class="info">
                            <a href="{{isset($item->product->url) ? $item->product->url : $item->product->slug}}" class="title" title="{{isset($item->product->title) ? $item->product->title : null}}">{{isset($item->product->title) ? $item->product->title : null}}</a>
                            <span class="price">
                                <strong>{{number_format($item->product->price)}} ₫</strong>
                                @if (isset($item->product->percent_sale) && (int)$item->product->percent_sale > 0)
                                    <strike>{{number_format($item->product->price_old)}} ₫</strike>
                                @endif
                            </span>
                        </div>
                        @if (isset($item->product->promotion) && $item->product->promotion != "")
                            @if(count(json_decode($item->product->promotion)) > 0 )
                                <div class="note">
                                    <span class="bag">KM</span> <label title="{{json_decode($item->product->promotion)[0]}}">{{\Str::limit(json_decode($item->product->promotion)[0],32)}}</label>
                                    @if(count(json_decode($item->product->promotion)) > 1)
                                        <strong class="text-orange">VÀ {{count(json_decode($item->product->promotion)) - 1}} KM KHÁC</strong>
                                    @endif
                                </div>
                            @endif
                        @endif
                        @if (isset($item->product->promotion) && $item->product->promotion != "")
                            @if(count(json_decode($item->product->promotion)) > 0 )
                            <div class="promote">
                                <a href="{{isset($item->product->url) ? $item->product->url : $item->product->slug}}">
                                    <ul>
                                        @foreach (json_decode($item->product->promotion) as $item)
                                        <li><span class="bag">KM</span> {{$item}}</li>
                                        @endforeach
                                    </ul>
                                </a>
                            </div>
                        @endif
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
