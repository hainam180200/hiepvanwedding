<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">

    <style>
        @font-face {
            font-family: 'pacifico-regular'; /* Tên bạn đặt */
            src: url('/assets/frontend/font/pacifico-regular.woff2') format('woff2');
            font-weight: normal; /* Có thể điều chỉnh */
            font-style: normal;  /* Có thể điều chỉnh */
        }

        .book {
            transition: opacity 0.4s 0.2s;
        }
        /*.page {*/
        /*    width: 40vw;*/
        /*    height: 50.6vw;*/
        /*    background-colour: #fff;*/
        /*    float: left;*/
        /*    margin-bottom: 0.5em;*/
        /*}*/
        .page {
            width: 60vw;
            height: 37.95vw;
            background-color: #fff;
            float: left;
            margin-bottom: 0.5em;
        }
            .page:first-child {
                float: right;
            }
        .page:nth-child(even) {
            clear: both;
        }
        .bound {
            perspective: 250vw;
        }
        /*.bound .pages {*/
        /*    width: 40vw;*/
        /*    height: 25.3vw;*/
        /*    position: relative;*/
        /*    transform: rotateX(12deg);*/
        /*    transform-style: preserve-3d;*/
        /*    -webkit-backface-visibility: hidden;*/
        /*    backface-visibility: hidden;*/
        /*    border-radius: 4px;*/
        /*    box-shadow: 0 0 0 1px #e3dfd8;*/
        /*}*/
        .bound .pages {
            width: 60vw;
            height: 37.95vw;
            position: relative;
            transform: rotateX(12deg);
            transform-style: preserve-3d;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            border-radius: 4px;
            box-shadow: 0 0 0 1px #e3dfd8;
        }
        .bound .page {
            float: none;
            clear: none;
            margin: 0;
            position: absolute;
            top: 0;
            width: 30vw;
            height: 37.95vw;
            transform-origin: 0 0;
            transition: transform 1.4s;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            transform-style: preserve-3d;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .bound .page:before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0);
            transition: background 0.7s;
            z-index: 2;
        }
        .bound .page:nth-child(odd) {
            pointer-events: all;
            transform: rotateY(0deg);
            right: 0;
            border-radius: 0 4px 4px 0;
        }
        .bound .page:nth-child(odd):hover {
            transform: rotateY(-10deg);
        }
        .bound .page:nth-child(odd):hover:before {
            background: rgba(0, 0, 0, 0.03);
        }
        .bound .page:nth-child(odd):before {
            background: rgba(0, 0, 0, 0);
        }
        .bound .page:nth-child(even) {
            pointer-events: none;
            transform: rotateY(180deg);
            transform-origin: 100% 0;
            left: 0;
            border-radius: 4px 0 0 4px;
        }
        .bound .page:nth-child(even):before {
            background: rgba(0, 0, 0, 0.2);
        }
        .bound .page.grabbing {
            transition: none;
        }
        .bound .page.flipped:nth-child(odd) {
            pointer-events: none;
            transform: rotateY(-180deg);
        }
        .bound .page.flipped:nth-child(odd):before {
            background: rgba(0, 0, 0, 0.2);
        }
        .bound .page.flipped:nth-child(even) {
            pointer-events: all;
            transform: rotateY(0deg);
        }
        .bound .page.flipped:nth-child(even):hover {
            transform: rotateY(10deg);
        }
        .bound .page.flipped:nth-child(even):hover:before {
            background: rgba(0, 0, 0, 0.03);
        }
        .bound .page.flipped:nth-child(even):before {
            background: rgba(0, 0, 0, 0);
        }
        *,
        * :before,
        *:after {
            box-sizing: border-box;
        }
        html,
        body {
            background: #e3dfd8;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }
        html {
            height: 100%;
        }
        body {
            min-height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2em 0;
            line-height: 1.5em;
        }
        .page {
            color: transparent;
            background: left top no-repeat;
            background-size: cover;
        }

        .page:nth-child(3),
        .page:nth-child(5),
        .page:nth-child(7),
        .page:nth-child(9),
        .page:nth-child(11),
        .page:nth-child(13),
        .page:nth-child(15),
        .page:nth-child(17),
        .page:nth-child(19),
        .page:nth-child(21),
        .page:nth-child(23),
        .page:nth-child(25),
        .page:nth-child(27),
        .page:nth-child(29),
        .page:nth-child(31) {
            background-position: right top;
        }
        .page:first-child{
            background-image: url('/assets/frontend/image/wedding_page_first.png');
        }
        .page:nth-child(2),.page:nth-child(3) {
            background-image: url('/assets/frontend/image/wedding_page_custom_2.png');
        }
        .page:nth-child(4),.page:nth-child(5) {
            background-image: url('/assets/frontend/image/wedding_page_main.jpg');
        }
        .page:nth-child(6),.page:nth-child(7) {
            background-image: url('/assets/frontend/image/wedding_page_end.jpg');
        }



        .preloader {
            background: #e3dfd8;
            width: 100%;
            height: 100%;
            position: fixed;

            left: 0;
            top: 0;
            z-index: 99999;
        }
        .preloader .middle {
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
        .preloader .middle i:first-child {
            -webkit-animation: preloaderAnimation 0.2s infinite alternate;
            animation: preloaderAnimation 0.2s infinite alternate;
        }
        .preloader .middle .fi {
            float: left;
            margin-right: 8px;
            color: #de4747;
            font-size: 30px;
        }
        @-webkit-keyframes preloaderAnimation {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0.3;
            }
        }

        @keyframes preloaderAnimation {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0.3;
            }
        }
        .page:nth-child(1) div.page-text{
            opacity: 0;
        }
        .page:nth-child(1) div.page-text,.page:nth-child(3) div.page-text{
            position: absolute;
            color: #0a0e14;
            bottom: 20%;
            left: 50%;
            transform: translate(-50%,-20%);
            font-family: 'pacifico-regular', serif;
        }
        .page_loader {position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: #fff;z-index: 1005;}
        #loader {display: block;position: relative;left: calc(50% - 40px);top: 50%;width: 160px;height: 20px;margin: -38px 0 0 -38px;}
        @media (max-width: 1024px){
            .page {
                width: 90vw;
                height: 56.92vw;

            }
            .bound .pages {
                width: 90vw;
                height: 56.92vw;

            }
            .bound .page {

                width: 45vw;
                height: 56.92vw;

            }


        }
        @media (max-width: 468px){

            .page:nth-child(1) div.page-text,.page:nth-child(3) div.page-text{
                bottom: 17%;
                transform: translate(-50%,-17%);
                font-size: 8px;

            }
        }
        @media (max-width: 390px){

            .page:nth-child(1) div.page-text,.page:nth-child(3) div.page-text{
                bottom: 16%;
                transform: translate(-50%,-16%);
                font-size: 8px;

            }
        }

    </style>
</head>
<body>
{{--    <div class="preloader">--}}
{{--        <div class="inner">--}}
{{--            <div class="middle">--}}
{{--                <i class="fi fas fa-heartbeat"></i>--}}
{{--                <i class="fi fas fa-heartbeat"></i>--}}
{{--                <i class="fi fas fa-heartbeat"></i>--}}
{{--                <i class="fi fas fa-heartbeat"></i>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}
<div id="page_loader" class="page_loader">
    <div id="loader">
        <img height="20" src="https://truongtrangwd.iwedding.info/invitation/loading.svg">
    </div>
</div>
    <div class="book bound">
        <div class="pages">
            <div class="page " id="page1">
                <div class="page-text">Hải Nam</div>

            </div>
            <div class="page">
            </div>
            <div class="page">
                <div class="page-text">Hải Nam</div>

            </div>
            <div class="page">

            </div>
            <div class="page">

            </div>
            <div class="page">

            </div>


{{--            <div class="page">Đỗ Hải Nam</div>--}}
{{--            <div class="page"><!--title--></div>--}}
{{--            <div class="page"><!--01--></div>--}}
{{--            <div class="page he">Đỗ Hải Nam</div>--}}
{{--            <div class="page">His adventure<br>Was to be tough</div>--}}
{{--            <div class="page"><!--04--></div>--}}
{{--            <div class="page"><!--05--></div>--}}
{{--            <div class="page">He knew his Mother<br>Had left this land</div>--}}
{{--            <div class="page">He knew his Father<br>Like the back of his hand</div>--}}
{{--            <div class="page"><!--08--></div>--}}
{{--            <div class="page">There were monsters<br>He had to fight</div>--}}
{{--            <div class="page"><!--10--></div>--}}
{{--            <div class="page"><!--11--></div>--}}
{{--            <div class="page">He sometimes hid<br>He never cried</div>--}}
{{--            <div class="page">There was a boy<br>Who was afraid</div>--}}
{{--            <div class="page">Who wore armour<br>That he had made</div>--}}
{{--            <div class="page"><!--15--></div>--}}
{{--            <div class="page">There was a boy<br>Who met a girl</div>--}}
{{--            <div class="page"><!--17--></div>--}}
{{--            <div class="page">He met a girl<br>Who changed his world</div>--}}
{{--            <div class="page"><!--19--></div>--}}
{{--            <div class="page">Who saw the armour<br>And looked inside</div>--}}
{{--            <div class="page">And inside…</div>--}}
{{--            <div class="page"><!--22--></div>--}}
{{--            <div class="page">There was a boy.</div>--}}
{{--            <div class="page"><!--24--></div>--}}
{{--            <div class="page"><!--endpaper--></div>--}}
{{--            <div class="page"><!--endpaper--></div>--}}
{{--            <div class="page"><!--backcover--></div>--}}
        </div>
    </div>
    <canvas class="invitation-card" id="invitation-card-2" style="width: 100%"></canvas>


{{--    <div class="invitation-container">--}}
{{--        <div style="height: 100%;margin: 10px;">--}}
{{--            <canvas class="invitation-card" id="invitation-card"></canvas>--}}
{{--        </div>--}}
{{--        <div style="height: 100%;margin: 10px;">--}}
{{--            <canvas class="invitation-card" id="invitation-card-2"></canvas>--}}
{{--        </div>--}}
{{--    </div>--}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript">
        const invitationInfo = {
            'templateID': 'h4',
            'groom_name': 'Đặng Văn Trường',
            'bride_name': 'Phạm Thị Hà Trang',
            'groom_name_short': 'Đặng Trường',
            'bride_name_short': 'Hà Trang',
            'groom_name_one': 'T',
            'bride_name_one': 'T',
            'guest_name': '15',
            'event_name': 'ád',
            'event_time': 'ád',
            'event_date': 'ád',
            'event_date_dot': 'ads',
            'event_address': 'ádasd',
        };
        const biicore = {webroot : 'https://truongtrangwd.iwedding.info', coreSite: 'https://biihappy.com', webToken: '65203311c4a03f7aa5055074'};
    </script>

{{--    <script type="text/javascript" src="/assets/frontend/js/template_invitation.js?v={{ time() }}"></script>--}}

    <script type='text/javascript'>
        var pages = $('.pages').children();
        var grabs = false; // Gonna work on this, one day

        var canvasWidth = 2560;
        var canvasHeight = 1619;
        function preloader() {
            // if($('.preloader').length) {
            //     $('.preloader').delay(100).fadeOut(500);
            // }

            setTimeout(function(){
                document.getElementById('page_loader').style.display = 'none';
            },800);
        }

        var renderCanvas2 = function(callback) {
            const font = new FontFace('PacificoRegular', 'url(/assets/frontend/font/pacifico-regular.woff2)');
            font.load();
            document.fonts.add(font);
            var canvas = document.getElementById('invitation-card-2');
            var ctx = canvas.getContext('2d');
            canvas.width = canvasWidth;
            canvas.height = canvasHeight;
            var background = new Image();
            background.src = '/assets/frontend/image/wedding_page_main.jpg';
            background.onload = function(){
                canvas.width = this.width;
                canvas.height = this.height;
                ctx.drawImage(this, 0,0,this.width, this.height);

                ctx.textBaseline = 'middle';
                ctx.textAlign = 'center';

                canvas.style.letterSpacing = '2px';
                ctx.font = "60px 'PacificoRegular'";
                ctx.fillText('Hải Nam', canvas.width/2 - 60, 240);
                ctx.save();
                if (callback) callback(canvas);
            };
            return canvas;
        }
        var applyCanvasToStyle = function() {
            renderCanvas2(function(canvas) {
                var imageUrl = canvas.toDataURL(); // Chuyển canvas thành URL ảnh
                // Chọn các phần tử `.page:nth-child(2)` và `.page:nth-child(3)`
                var page2 = document.querySelector('.page:nth-child(4)');
                var page3 = document.querySelector('.page:nth-child(5)');

                if (page2) {
                    page2.style.backgroundImage = `url(${imageUrl})`;
                    page2.style.backgroundSize = 'cover';
                }

                if (page3) {
                    page3.style.backgroundImage = `url(${imageUrl})`;
                    page3.style.backgroundSize = 'cover';
                }
                canvas.style.display = 'none';
            });
        };

        var renderCanvas = function() {
            applyCanvasToStyle();
        }
        pages.each(function(i) {
            var page = $(this);
            if (i % 2 === 0) {
                page.css('z-index', (pages.length - i));
            }
        });

        $(window).load(function() {
            preloader();
            renderCanvas();
            let renderCount = 0;
            const intID = setInterval(function(){
                renderCanvas();
                if(renderCount >= 3) clearInterval(intID);
                renderCount++;
                $('#page1').first().trigger('click');  // Thay thế click() bằng trigger('click')

            },100);
            // Đảm bảo sự kiện click được gắn trước khi gọi click tự động
            $('.page').click(function() {
                var page = $(this);
                var page_num = pages.index(page) + 1;
                console.log(page_num)
                if (page_num == 2){
                    $(".page:nth-child(1) .page-text").css('opacity', 1);
                }else {
                    $(".page:nth-child(1) .page-text").css('opacity', 0);
                }
                if (page_num == 4 || page_num == 1){
                    $(".page:nth-child(3) .page-text").css('opacity', 1);
                }else {
                    $(".page:nth-child(3) .page-text").css('opacity', 0);
                }
                if (page_num % 2 === 0) {
                    page.removeClass('flipped');
                    page.prev().removeClass('flipped');
                } else {
                    page.addClass('flipped');
                    page.next().addClass('flipped');
                }
            });

            if (grabs) {
                $('.page').on('mousedown', function(e) {
                    var page = $(this);
                    var page_num = pages.index(page) + 1;
                    var page_w = page.outerWidth();
                    var page_l = page.offset().left;
                    var grabbed = '';
                    var mouseX = e.pageX;
                    if (page_num % 2 === 0) {
                        grabbed = 'verso';
                        var other_page = page.prev();
                        var centerX = (page_l + page_w);
                    } else {
                        grabbed = 'recto';
                        var other_page = page.next();
                        var centerX = page_l;
                    }

                    var leaf = page.add(other_page);

                    var from_spine = mouseX - centerX;

                    if (grabbed === 'recto') {
                        var deg = (90 * -(1 - (from_spine/page_w)));
                        page.css('transform', 'rotateY(' + deg + 'deg)');

                    } else {
                        var deg = (90 * (1 + (from_spine/page_w)));
                        page.css('transform', 'rotateY(' + deg + 'deg)');
                    }

                    leaf.addClass('grabbing');

                    $(window).on('mousemove', function(e) {
                        mouseX = e.pageX;
                        if (grabbed === 'recto') {
                            centerX = page_l;
                            from_spine = mouseX - centerX;
                            var deg = (90 * -(1 - (from_spine/page_w)));
                            page.css('transform', 'rotateY(' + deg + 'deg)');
                            other_page.css('transform', 'rotateY(' + (180 + deg) + 'deg)');
                        } else {
                            centerX = (page_l + page_w);
                            from_spine = mouseX - centerX;
                            var deg = (90 * (1 + (from_spine/page_w)));
                            page.css('transform', 'rotateY(' + deg + 'deg)');
                            other_page.css('transform', 'rotateY(' + (deg - 180) + 'deg)');
                        }

                        console.log(deg, (180 + deg) );
                    });


                    $(window).on('mouseup', function(e) {
                        leaf
                            .removeClass('grabbing')
                            .css('transform', '');

                        $(window).off('mousemove');
                    });
                });
            }

            $('.book').addClass('bound');
        });
    </script>
</body>

</html>
