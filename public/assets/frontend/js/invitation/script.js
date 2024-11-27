var pages = $('.pages').children();
var grabs = false; // Gonna work on this, one day

var canvasWidth = 2560;
var canvasHeight = 1619;
function preloader() {
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
        ctx.fillText(invitationInfo.guest_name + invitationInfo.lover, canvas.width/2 - 60, 240);
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
// music

if(invitationInfo.bgMusic) {
    var audioPlayer = document.createElement("AUDIO");
    audioPlayer.style.display = "none";

    setTimeout(function () {
        if (audioPlayer.canPlayType("audio/mpeg")) {
            audioPlayer.setAttribute("src", invitationInfo.bgMusic);
            document.getElementsByClassName("bii-player")[0].style.display = "block";
        }
        audioPlayer.volume = 0.3;
        audioPlayer.setAttribute("controls", "controls");
        if (invitationInfo.isAutoPlay) {
            audioPlayer.setAttribute("autoplay", "autoplay");
        }
        document.body.appendChild(audioPlayer);
    }, 1000);

    var myInterval = setInterval(function () {
        if (document.querySelector(".bii-player")) {
            setTimeout(function () {
                document.getElementsByClassName("bii-player")[0].classList.add("show-sec");
            }, 2000);
            setTimeout(function () {
                document.getElementsByClassName("bii-player")[0].classList.remove("show-sec");
            }, 7000);
            clearInterval(myInterval);
        }
    }, 200);

    function playPause() {
        document.getElementsByClassName("bii-player")[0].classList.remove("show-sec");
        if (audioPlayer.paused) {
            audioPlayer.play();
            document.getElementById("playerVolumeOff").style.display = "none";
            document.getElementById("playerVolumeOn").style.display = "block";
        } else {
            audioPlayer.pause();
            document.getElementById("playerVolumeOff").style.display = "block";
            document.getElementById("playerVolumeOn").style.display = "none";
        }
    }

    if (invitationInfo.isAutoPlay) {
        function handleClickAutoPlay() {
            let elements = document.querySelectorAll('.bii-player-secondary, .playerIcon');
            if (!Array.from(elements).some(element => element.contains(event.target))) {
                if (audioPlayer.paused) {
                    document.body.removeEventListener('click', handleClickAutoPlay, true);
                    playPause();
                }
            } else {
                document.body.removeEventListener('click', handleClickAutoPlay, true);
            }
        }

        document.body.addEventListener('click', handleClickAutoPlay, true);
    }
}
