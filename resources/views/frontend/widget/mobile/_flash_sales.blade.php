@if (isset($data) && count($data) > 0)
    <!-- flash sales -->
    <section>
        <div class="container">
        <div class="flash-sales">
            <div class="header">
                <h3>F<i class="fas fa-bolt" style="padding: 0 4px;color: #f63"></i>ASH SALE ONLINE</h3>
            </div>
            <div class="content scroll">
                <div class="product-list scroll-x equaHeight" data-obj=".item a.title">
                    @foreach ($data as $key => $item)
                        <div class="item">
                            <div class="img">
                                <a href="{{isset($item->product->url) ? $item->product->url : $item->product->slug}}" title="{{isset($item->product->title) ? $item->product->title : null}}" target="{{isset($item->product->target) && $item->product->target == 1 ? '_blank' : null}}">
                                    <img src="{{ isset($item->product->image)?\App\Library\Files::media($item->product->image) : null }}" alt="{{isset($item->product->title) ? $item->product->title : null}}" class="img-fluid">
                                </a>
                            </div>
                            <div class="info">
                                <a class="title" href="{{isset($item->product->url) ? $item->product->url : $item->product->slug}}">{{isset($item->product->title) ? $item->product->title : null}}</a>
                                <span class="price">
                                <strong>{{number_format($item->product->price)}} ₫</strong>
                                @if (isset($item->product->percent_sale) && (int)$item->product->percent_sale > 0)
                                    <strike>{{number_format($item->product->price_old)}} ₫</strike>
                                @endif
                                </span>
                                @if (isset($item->product->is_point) && $item->product->is_point == 1)
                                    <div class="deal-status">
                                        <div class="p-order-status w-100">
                                            <span class="text">Còn lại:</span>
                                            <span class="bg-count-left" style="width: 100%;color: #fff;"><b style="padding-left: 15px">{{isset($item->product->number_point) ? $item->product->number_point : "100" }}</b></span>
                                            <span class="icon-order-status icon-order-status-deal" style="left: 100%"></span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
    </section>
@endif
