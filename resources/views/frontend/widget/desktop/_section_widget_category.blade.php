@if (isset($data) && count($data) > 0)
    @foreach ($data as $item)
    <section>
        <div class="container">
           <div class="flash-sales box-home">
              <div class="header">
                 <h4><a href="#">{{isset($item->title) ? $item->title : null}}</a></h4>
              </div>
              <div class="content">
                 <div class="owl-carousel lr-slider equaHeight" data-obj=".info a.title">
                     @if (isset($item->collection_product) && count($item->collection_product) > 0)
                        @foreach ($item->collection_product as $item_prd)
                            <div class="item">
                                <div class="img">
                                    <a href="{{isset($item_prd->url) ? $item_prd->url : $item_prd->slug}}" title="{{isset($item_prd->title) ? $item_prd->title : null}}">
                                    <img src="{{ isset($item_prd->image)?\App\Library\Files::media($item_prd->image) : null }}" alt="{{isset($item_prd->title) ? $item_prd->title : null}}" class="img-fluid img-thumbnail">
                                    </a>
                                </div>
                                <div class="info">
                                    <a href="{{isset($item_prd->url) ? $item_prd->url : $item_prd->slug}}" class="title">{{isset($item_prd->title) ? $item_prd->title : null}}</a>
                                        <span class="price">
                                            <strong>{{number_format($item_prd->price)}} ₫</strong>
                                            @if (isset($item_prd->percent_sale) && (int)$item_prd->percent_sale > 0)
                                                <strike>{{number_format($item_prd->price_old)}} ₫</strike>
                                            @endif
                                        </span>
                                </div>
                                @if (isset($item_prd->promotion) && $item_prd->promotion != "")
                                    @if(count(json_decode($item_prd->promotion)) > 0 )
                                        <div class="note">
                                            <span class="bag">KM</span> <label title="{{json_decode($item_prd->promotion)[0]}}">{{\Str::limit(json_decode($item_prd->promotion)[0],32)}}</label>
                                            @if(count(json_decode($item_prd->promotion)) > 1)
                                                <strong class="text-orange">VÀ {{count(json_decode($item_prd->promotion)) - 1}} KM KHÁC</strong>
                                            @endif
                                        </div>
                                    @endif
                                @endif
                                @if (isset($item_prd->promotion) && $item_prd->promotion != "")
                                    @if(count(json_decode($item_prd->promotion)) > 0 )
                                    <div class="promote">
                                        <a href="{{isset($item_prd->url) ? $item_prd->url : $item_prd->slug}}">
                                            <ul>
                                                @foreach (json_decode($item_prd->promotion) as $item_title)
                                                    <li><span class="bag">KM</span> {{$item_title}}</li>
                                                @endforeach
                                            </ul>
                                        </a>
                                    </div>
                                @endif
                                @endif
                            </div>
                        @endforeach
                     @endif
                 </div>
              </div>
           </div>
        </div>
    </section>
    @endforeach
@endif
