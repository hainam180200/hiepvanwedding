
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <meta name="author" content="VanHiep">
    <title>Kính gửi {{$data['guest_name']}}! - Thiệp mời đám cưới online</title>
    <meta name="description" content="Trân trọng kính mời {{$data['guest_name']}} đến tham dự buổi tiệc chung vui cùng gia đình chúng tôi!" />
    <meta name="keywords" content="Wedding" />
    <meta property="og:site_name" content="Công Hiệp &amp; Thu Vân Wedding site!">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Kính gửi {{$data['guest_name']}}! - Thiệp mời đám cưới online" />
    <meta property="og:description" content="Trân trọng kính mời {{$data['guest_name']}} đến tham dự buổi tiệc chung vui cùng gia đình chúng tôi!" />
    <meta property="og:image" content="/assets/frontend/image/wedding-header.jpg">
    <meta property="og:image:url" content="/assets/frontend/image/wedding-header.jpg">
    <meta property="og:image:secure_url" content="/assets/frontend/image/wedding-header.jpg">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/frontend/image/wedding-card.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link rel="stylesheet" href="/assets/frontend/css/invitation/style.css?v={{ time() }}">
</head>
<body>
<div class="book bound">
    <div class="pages">
        <div class="page" id="page1">
            <div class="page-text">{{$data['guest_name'] ?? ''}}{{$data['lover'] ?? ''}}</div>
        </div>
        <div class="page">
        </div>
        <div class="page">
            <div class="page-text">{{$data['guest_name'] ?? ''}}{{$data['lover'] ?? ''}}</div>
        </div>
        <div class="page">

        </div>
        <div class="page">

        </div>
        <div class="page">

        </div>
    </div>
</div>
<canvas class="invitation-card" id="invitation-card-2" style="width: 100%"></canvas>
<div id="page_loader" class="page_loader">
    <div id="loader">
        <img height="20" src="/assets/frontend/image/loading_love.svg">
    </div>
</div>
<div class="bii-player">
    <div onclick="playPause();" class="bii-player-secondary"><div class="bii-player-secondary-content">Click vào đây để phát nhạc!</div></div>
    <div onclick="playPause();" class="playerIcon">
        <span id="playerVolumeOff">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="27" fill="#fff" class="bi bi-volume-mute-fill" viewBox="0 0 16 16">
              <path d="M6.717 3.55A.5.5 0 0 1 7 4v8a.5.5 0 0 1-.812.39L3.825 10.5H1.5A.5.5 0 0 1 1 10V6a.5.5 0 0 1 .5-.5h2.325l2.363-1.89a.5.5 0 0 1 .529-.06zm7.137 2.096a.5.5 0 0 1 0 .708L12.207 8l1.647 1.646a.5.5 0 0 1-.708.708L11.5 8.707l-1.646 1.647a.5.5 0 0 1-.708-.708L10.793 8 9.146 6.354a.5.5 0 1 1 .708-.708L11.5 7.293l1.646-1.647a.5.5 0 0 1 .708 0z"/>
            </svg>
        </span>
        <span style="display:none;" id="playerVolumeOn">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="27" fill="#fff" class="bi bi-volume-up-fill" viewBox="0 0 16 16">
              <path d="M11.536 14.01A8.473 8.473 0 0 0 14.026 8a8.473 8.473 0 0 0-2.49-6.01l-.708.707A7.476 7.476 0 0 1 13.025 8c0 2.071-.84 3.946-2.197 5.303l.708.707z"/>
              <path d="M10.121 12.596A6.48 6.48 0 0 0 12.025 8a6.48 6.48 0 0 0-1.904-4.596l-.707.707A5.483 5.483 0 0 1 11.025 8a5.483 5.483 0 0 1-1.61 3.89l.706.706z"/>
              <path d="M8.707 11.182A4.486 4.486 0 0 0 10.025 8a4.486 4.486 0 0 0-1.318-3.182L8 5.525A3.489 3.489 0 0 1 9.025 8 3.49 3.49 0 0 1 8 10.475l.707.707zM6.717 3.55A.5.5 0 0 1 7 4v8a.5.5 0 0 1-.812.39L3.825 10.5H1.5A.5.5 0 0 1 1 10V6a.5.5 0 0 1 .5-.5h2.325l2.363-1.89a.5.5 0 0 1 .529-.06z"/>
            </svg>
        </span>
    </div>
</div>
<script type="text/javascript">
    const invitationInfo = {
        'guest_name': '{{$data['guest_name']}}',
        'lover': '{{$data['lover']}}',
        'bgMusic': '/assets/frontend/music/apt.mp3',
    };
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="/assets/frontend/js/invitation/script.js?v={{ time() }}"></script>
</body>
</html>
