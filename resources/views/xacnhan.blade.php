
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Biihappy">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>Đặng Trường & Hà Trang - Xác nhận tham dự</title>
	<meta name="description" content="Để có thể xác nhận tham dự, bạn phải là người nhận được thiệp mời từ cô dâu và chú rể. Vui lòng tìm kiếm thiệp mời theo form bên dưới!" />
	<meta name="keywords" content="Wedding, Wedding website, Website đám cưới, Tạo website đám cưới miễn phí" />
	<meta property="og:site_name" content="Đặng Trường &amp; Hà Trang Wedding site!">
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Đặng Trường & Hà Trang - Xác nhận tham dự" />
	<meta property="og:url" content="https://truongtrangwd.iwedding.info/rsvp" />
	<meta property="og:description" content="Để có thể xác nhận tham dự, bạn phải là người nhận được thiệp mời từ cô dâu và chú rể. Vui lòng tìm kiếm thiệp mời theo form bên dưới!" />
	<meta property="og:image" content="https://cdn.biihappy.com/ziiweb/website/65203311c4a03f7aa5055074/e62d3e33e3c8cbe31d0d6a5eb8e32799.jpeg" />
	<meta property="og:image:url" content="https://cdn.biihappy.com/ziiweb/website/65203311c4a03f7aa5055074/e62d3e33e3c8cbe31d0d6a5eb8e32799.jpeg" />
	<meta property="og:image:secure_url" content="https://cdn.biihappy.com/ziiweb/website/65203311c4a03f7aa5055074/e62d3e33e3c8cbe31d0d6a5eb8e32799.jpeg" />
	<link rel="shortcut icon" type="image/x-icon" href="https://truongtrangwd.iwedding.info/rsvp-template/favicon.ico">
	<link href="https://fonts.googleapis.com/css2?family=Coiny&family=Jura:wght@300&family=MonteCarlo&family=Tourney:wght@100&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
	<style>
		.container{max-width: 650px;}
		#search-form h1 {font-family: 'Jura', sans-serif;font-size: 30px;display: flex;align-items: center;justify-content: center;font-weight: bold;margin: 0;}
		#search-form h1 span {padding: 0 15px;}
		@media only screen and (max-width: 410px){
			#search-form h1 {font-size:30px!important;}
		}
		@media only screen and (max-width: 374px){
			#search-form h1 {font-size:22px!important;}
		}
	</style>
</head>
<body>
    <main class="container my-3 my-md-5">
    	<div class="text-center">
    		<img style="max-width:350px;" class="w-100 border border-danger p-1 mb-5 border-2 rounded-circle" src="https://cdn.biihappy.com/ziiweb/website/65203311c4a03f7aa5055074/e62d3e33e3c8cbe31d0d6a5eb8e32799.jpeg" />
    	</div>
        <div>
        	<form id="search-form" method="post">
	            <h2 class="text-center fs-1" style="font-family: 'Coiny', cursive;">Xác nhận tham dự</h2>
	            <p class="text-center" style="font-family: 'Jura', sans-serif;font-size: 22px;">Đám cưới của</p>
	            <div class="d-flex flex-wrap align-items-center justify-content-center">
		            <h1><span>Đặng Trường</span> <img height="50" src="https://truongtrangwd.iwedding.info/album/heart.gif"> <span>Hà Trang</span></h1>
		        </div>
	            <p class="lead text-center mt-4 mb-0" style="font-family: 'Jura', sans-serif;">Để có thể xác nhận tham dự, bạn phải là người nhận được thiệp mời từ cô dâu và chú rể. Vui lòng tìm kiếm thiệp mời theo form bên dưới!</p>
	            <div class="mt-4">
	            	<label class="p-2 text-center d-block bg-secondary text-white" for="name" style="font-family: 'Jura', sans-serif;font-size: 20px;">Nhập Tên hoặc Mã Khách Mời<small class="d-block fs-6">Type your Name or Code</small></label>
					<input type="text" id="name" name="name" class="form-control form-control-lg rounded-0 text-center" placeholder="---">
				</div>
				<div class="errors mt-1 text-danger text-center"></div>
				<input type="hidden" value="65203311c4a03f7aa5055074" name="website_id">
	            <button type="submit" class="btn btn-lg btn-danger text-center w-100 mt-4" style="font-family: 'Jura', sans-serif;">Tìm kiếm thiệp mời của bạn<small class="d-block fs-6">Find Your Invitation</small></button>
            </form>
        </div>
        <div class="mt-3 search-response-success d-none" style="font-family: 'Jura', sans-serif;">
        	<form id="confirmation-form" method="post">
		        <div class="list-guest-container"></div>
	        </form>
	    </div>
	    
	     <div class="mt-3 search-response-error" style="font-family: 'Jura', sans-serif;">
			<p id="content-fw" class="fw-bold text-center fs-6">Không tìm thấy bạn trong danh sách khách mời. Vui lòng chọn đúng tên của bạn để tiếp tục.</p>
        	<p class="fw-bold text-center fs-6 text-danger"></p>
	    </div>
        <div>
        	<div class="row gx-3 mt-3">
        		<a href="/" class="text-center">
        			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/></svg> 
        			Về website đám cưới
        		</a>
        		<!--<div class="col col-12 col-sm-6 mb-3"><a class="btn btn-lg btn-outline-dark w-100 border border-2 border-secondary" href="https://truongtrangwd.iwedding.info">Xem website</a></div>-->
        		<!--<div class="col col-12 col-sm-6 mb-3"><a class="btn btn-lg btn-outline-dark w-100 border border-2 border-secondary" href="https://truongtrangwd.iwedding.info/photo-album">Xem album cưới</a></div>-->
        	</div>
        </div>
    </main>
	<script src="https://truongtrangwd.iwedding.info/rsvp-template/script.js?v=20211102"></script>
	<script>
		var webroot = 'https://truongtrangwd.iwedding.info';
		if ($("#search-form").length) {
            $("#search-form").validate({
            	errorLabelContainer: $("#search-form div.errors"),
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: 'Vui lòng nhập tên hoặc mã khách mời của bạn!',
                    }
                },
                submitHandler: function (form) {
                	$("#search-form").find('button[type="submit"').attr('disabled','disabled');
                    $.ajax({
                        type: "GET",
                        url: "/search-guests",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: $(form).serialize(),
                        success: function (res) {
                            if(res.status == 1){
                                let data = res.data;
                                let html = '';
                                data.forEach((element) => {
                                	let guestSubInfo = '';
                                	let guestSubInfoArr = [];
                                	if(element.id) {
                                		guestSubInfoArr.push('Mã khách: '+element.id);
                                	}
                                	if(element.phone) {
                                		guestSubInfoArr.push(element.phone);
                                	}
                                	if(element.email) {
                                		guestSubInfoArr.push(element.email);
                                	}
									var list_type = '';
									if(element.type == 0){
										guestSubInfoArr.push('LỄ CƯỚI NHÀ TRAI');
									}
									else{
										guestSubInfoArr.push('LỄ CƯỚI NHÀ GÁI');
									}
                                	
                                	if(guestSubInfoArr.length > 0) {
                                		guestSubInfo = ' <small class="text-muted">( ' + guestSubInfoArr.join(' - ') + ' )</small>';
                                	}
								
                                	
                                    html += `<div class="p-3 border mb-2 rounded position-relative"><div class="form-check">
                                                <input class="form-check-input" type="radio" name="guestID" id="${element.link}" value="${element.link}">
                                                <label class="form-check-label fw-semibold" for="${element.link}">${element.name}${guestSubInfo}</label>
                                            </div><label class="position-absolute w-100 h-100 top-0 start-0" role="button" for="${element.link}"></label></div>`;
                                });
                                html += ` <button type="submit" class="mt-2 btn btn-dark search-id disabled w-100 btn-lg">Xem thiệp mời và xác nhận</button>`;
                                $('.list-guest-container').html(html);
								if(data.length > 0){
									$('.search-response-success').removeClass('d-none');
									$('.search-response-error').addClass('d-none');
									$('html, body').animate({
										scrollTop: $(".list-guest-container").offset().top
									}, 200);
								}
								else{
									$('.search-response-error p').html(res.message);
									$('.search-response-error').removeClass('d-none');
									$('.search-response-success').addClass('d-none');
								}
                            }else{
                            	$('.search-response-error p').html(res.message);
                                $('.search-response-error').removeClass('d-none');
                                $('.search-response-success').addClass('d-none');
                            }
                        },
                        complete: function() {
                        	$("#search-form").find('button[type="submit"').removeAttr('disabled');
                        }
                    });
                    return false;
                }
            });
        }
    
        $(document).on('click', '.form-check-input', function(event) {
            if($('.search-id').hasClass('disabled')){
                $('.search-id').removeClass('disabled');
            }
        });
        
        $(document).on('submit', '#confirmation-form', function(event){
        	event.preventDefault();
        	var guestID = $(this).find('input[name="guestID"]:checked').val();
        	window.location.href = '/invitation/' + guestID + '#confirm';
        	return false;
        });

        $(window).on('load', function(event){
            event.preventDefault();
        });
	</script>
</body>
</html>