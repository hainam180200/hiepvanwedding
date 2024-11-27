var canvasWidth = 2560;
var canvasHeight = 1619;
function preloader() {
    if($('.preloader').length) {
        $('.preloader').delay(100).fadeOut(500);
    }
}

var renderCanvas2 = function(callback) {
    var canvas = document.getElementById('invitation-card-2');
    var ctx = canvas.getContext('2d');
    canvas.width = canvasWidth;
    canvas.height = canvasHeight;
    var background = new Image();
    background.src = 'http://127.0.0.1:8000/assets/frontend/image/wedding_page_main.jpg';
    background.onload = function(){
        canvas.width = this.width;
        canvas.height = this.height;
        ctx.drawImage(this, 0,0,this.width, this.height);

        ctx.textBaseline = 'middle';
        ctx.textAlign = 'center';
        ctx.fillStyle = '#647775';

        // canvas.style.letterSpacing = '10px';
        // ctx.font = "100 60px 'patrick_handregular', cursive";
        // ctx.fillText('Wedding Invitation', canvas.width/2, 270);
        // ctx.save();
        //
        // canvas.style.letterSpacing = '6px';
        // ctx = canvas.getContext('2d');
        // ctx.font = "35px 'Jura', cursive";
        // ctx.fillText('Save The Date', canvas.width/2, 340);
        // ctx.save();
        //
        // canvas.style.letterSpacing = '0';
        // ctx.fillStyle = '#BB9B83';
        // ctx = canvas.getContext('2d');
        // ctx.font = "95px 'dancing_scriptregular', cursive";
        // ctx.textBaseline = 'middle';
        // ctx.textAlign = 'center';
        // ctx.fillText(invitationInfo.groom_name_short + '  &  ' + invitationInfo.bride_name_short, canvas.width/2, 640);
        // ctx.save();
        //
        ctx.fillStyle = '#647775';
        canvas.style.letterSpacing = '2px';
        ctx.font = "120px ";
        ctx.fillText('Xin chào', canvas.width/2, 240);
        ctx.save();
        //
        // ctx.font = "bold 60px 'comfortaaregular', cursive";
        // ctx.fillText(invitationInfo.guest_name, canvas.width/2, 910);
        // ctx.save();
        //
        // const canvasTxt0 = window.canvasTxt.default;
        // canvasTxt0.font = "'Jura', cursive";
        // canvasTxt0.fontSize = 45;
        // canvasTxt0.fontWeight = '200';
        // canvasTxt0.vAlign = 'top';
        // canvasTxt0.align = 'center';
        // canvasTxt0.lineHeight = 55;
        // let canvasTxt0Width = canvas.width-400;
        // canvasTxt0.drawText(ctx, 'Äáº¿n dá»± buá»•i tiá»‡c chung vui cÃ¹ng gia Ä‘Ã¬nh chÃºng tÃ´i táº¡i', canvas.width/2 - canvasTxt0Width/2, 980, canvasTxt0Width, 200);
        // ctx.save();
        //
        // if(invitationInfo.venue_name.trim() !== '') {
        //     const canvasTxt = window.canvasTxt.default;
        //     canvasTxt.font = "'comfortaaregular', cursive";
        //     canvasTxt.fontSize = 40;
        //     canvasTxt.fontWeight = 'bold';
        //     canvasTxt.vAlign = 'top';
        //     canvasTxt.align = 'center';
        //     canvasTxt.lineHeight = 60;
        //     canvasTxt.drawText(ctx, invitationInfo.venue_name.trim(), canvas.width/2 - canvasTxt0Width/2, 1190, canvasTxt0Width, 200);
        //     ctx.save();
        //
        //     const canvasTxt01 = window.canvasTxt.default;
        //     canvasTxt01.font = "'Jura', cursive";
        //     canvasTxt01.fontSize = 45;
        //     canvasTxt01.fontWeight = '200';
        //     canvasTxt01.vAlign = 'top';
        //     canvasTxt01.align = 'center';
        //     canvasTxt01.lineHeight = 55;
        //     canvasTxt.drawText(ctx, invitationInfo.event_address, canvas.width/2 - canvasTxt0Width/2, 1240, canvasTxt0Width, 200);
        //     ctx.save();
        // }else{
        //     const canvasTxt = window.canvasTxt.default;
        //     canvasTxt.font = "'comfortaaregular', cursive";
        //     canvasTxt.fontSize = 40;
        //     canvasTxt.fontWeight = 'bold';
        //     canvasTxt.vAlign = 'top';
        //     canvasTxt.align = 'center';
        //     canvasTxt.lineHeight = 60;
        //     canvasTxt.drawText(ctx, invitationInfo.event_address, canvas.width/2 - canvasTxt0Width/2, 1190, canvasTxt0Width, 200);
        //     ctx.save();
        // }
        //
        // ctx.fillStyle = '#BB9B83';
        // ctx.font = "45px 'comfortaaregular', cursive";
        // ctx.fillText(('VÃ o lÃºc ' + invitationInfo.event_time).toUpperCase(), canvas.width/2, 1440);
        // ctx.save();
        //
        // ctx.font = "45px 'comfortaaregular', cursive";
        // ctx.fillText(invitationInfo.event_date.toUpperCase(), canvas.width/2, 1520);
        // ctx.save();
        //
        // ctx.fillStyle = '#647775';
        // const canvasTxt1 = window.canvasTxt.default;
        // canvasTxt1.font = "'dancing_scriptregular', cursive";
        // canvasTxt1.fontSize = 50;
        // canvasTxt1.fontWeight = '200';
        // canvasTxt1.vAlign = 'top';
        // canvasTxt1.align = 'center';
        // canvasTxt1.lineHeight = 60;
        // canvasTxt0Width = canvas.width-600;
        // canvasTxt1.drawText(ctx, 'Sá»± hiá»‡n diá»‡n cá»§a quÃ½ khÃ¡ch lÃ  niá»m vinh háº¡nh cho gia Ä‘Ã¬nh chÃºng tÃ´i!', canvas.width/2 - canvasTxt0Width/2, 1670, canvasTxt0Width, 200);
        ctx.save();
        if (callback) callback(canvas);
    };
    return canvas;
}
// Chuyển canvas thành URL ảnh và gắn vào style
// var applyCanvasToStyle = function() {
//
//     var canvas = renderCanvas2();
//     var imageUrl = canvas.toDataURL(); // Chuyển canvas thành URL ảnh
//
//     // Gắn URL vào style của phần tử hoặc thẻ <img>
//     // var targetElement = document.getElementById('target-element');
//     // targetElement.style.backgroundImage = `url(${imageUrl})`;
//     // targetElement.style.backgroundSize = 'cover';
//     //
//     // // Hoặc gắn vào thẻ <img>
//     var imgElement = document.getElementById('image-preview');
//     imgElement.src = imageUrl;
// };
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
window.addEventListener('load', function(){
    preloader();
    renderCanvas();
    let renderCount = 0;
    const intID = setInterval(function(){
        renderCanvas();
        if(renderCount >= 3) clearInterval(intID);
        renderCount++;
    },100);
});
