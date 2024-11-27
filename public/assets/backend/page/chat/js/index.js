$(document).ready(function () {
   const csrf_token = $('meta[name="csrf-token"]').attr('content');
   const AUTHOR_ID = $('meta[name="author_id"]').attr('content');
   const CHANNEL_SOCKET = $('meta[name="channel-socket"]').attr('content');
   const URL_LIST_CHAT = '/admin/chat/list-message';
   const ROOM_CHAT = window.location.pathname.split('/')[3];
   if(ROOM_CHAT !== undefined){
      loadRoomsMessage(ROOM_CHAT)
   }
   $('body').on('click','.btn-add-chat',function(){
      $('#modal-add-chat').modal('show');
   });
   $('.select2').select2({
      theme: 'bootstrap4'
   })
   $('.btn-submit-custom').click(function (e) {
      e.preventDefault();
      var btn = this;
      $(".btn-submit-custom").each(function (index, value) {
         KTUtil.btnWait(this, "spinner spinner-right spinner-white pr-15", 'Đang tạo..', true);
      });
      $('.btn-submit-dropdown').prop('disabled', true);
      //gắn thêm hành động close khi submit
      $('#submit-close').val($(btn).data('submit-close'));
      var formSubmit = $('#' + $(btn).data('form'));
      formSubmit.submit();
   });
   getListChat();
   function getListChat(){
      $.ajax({
         type: "GET",
         url: URL_LIST_CHAT,
         beforeSend: function (xhr) {
            
         },
         success: function (data) {
            if(data.status == 1){
               let $temp = '';
               if(data.data.length > 0){
                  $.each(data.data,function(key,value){
                     $temp += `<div class="d-flex align-items-center justify-content-between mb-5">`; 
                     $temp += `<div class="d-flex align-items-center">`; 
                     $temp += `<div class="symbol symbol-circle symbol-50 mr-3">`; 
                     $temp += `<img alt="Pic" src="/assets/backend/image/messager.png">`; 
                     $temp += `</div>`; 
                     $temp += `<div class="d-flex flex-column">`; 
                     $temp += `<a href="javascript:(0)" class="text-dark-75 text-hover-primary font-weight-bold font-size-lg mgs-box" data-id="${value.id}">${value.title}</a>`; 
                     if(value.lastest_messages == null){
                        if(value.author.id == AUTHOR_ID){
                           $temp += `<span class="text-muted font-weight-bold font-size-sm">Bạn đã tạo cuộc trò chuyện.</span>`;
                        }
                        else{
                           $temp += `<span class="text-muted font-weight-bold font-size-sm">${value.author.username} đã tạo cuộc trò chuyện.</span>`;
                        }
                     }
                     else{
                        $temp += `<span class="text-muted font-weight-bold font-size-sm">Nội dung cuộc trò chuyện.</span>`;
                     }
                     
                     $temp += `</div>`; 
                     $temp += `</div>`; 
                     //   $temp += `<div class="d-flex flex-column align-items-end">`; 
                     //   $temp += `<span class="text-muted font-weight-bold font-size-sm">3 hrs</span>`; 
                     //   $temp += `<span class="label label-sm label-danger">5</span>`; 
                     //   $temp += `</div>`; 
                     $temp += `</div>`;
                  })
               }
               else{
                     $temp += `<div class="d-flex align-items-center justify-content-center mb-5">`;
                     $temp += "Không có cuộc trò chuyện nào..";
                     $temp += `</div>`; 
               }
               $('#result-list-chat').html($temp);
            }
            else{
               alert('ERRORS');
            }
         },
         error: function (data) {
             alert('ERRORS');
         },
         complete: function (data) {

         }
     });
   }
   $('body').on('click','.mgs-box',function(){
      var room_id = $(this).data('id');
      if(window.location.pathname.split('/')[3] == room_id){
         return false;
      }
      const state = { };
      const title = null;
      if(window.location.pathname.split('/')[3] == null){
         window.history.pushState(state, title, 'chat/'+room_id);
      }
      else{
         window.history.pushState(state, title, room_id)
      }
      loadRoomsMessage(room_id);
   });
   function loadRoomsMessage(room_id){
      var url = '/admin/chat/load-room/'+room_id;
      $.ajax({
         type: "GET",
         url: url,
         beforeSend: function (xhr) {
            
         },
         success: function (data) {
            if(data.status == 1){
               $('#title-chat').html(data.data.title)
               $('#kt_chat_content').css('display','block');
            }
            else{
               alert('ERRORS');
            }
            loadMessage(room_id)
         },
         error: function (data) {
            alert('ERRORS');
         },
         complete: function (data) {
            
         }
     });
   }
   $('body').on('click','#send-message',function(e){
      e.preventDefault()
      sendMessage();
   })
   // $('body ').keypress('#message-content',function (e) {
   //    var key = e.which;
   //    if (key == 13) {
   //     sendMessage();
   //    }
   // });
   function sendMessage(){
      var room_id = window.location.pathname.split('/')[3];
      var content =  $('#message-content').val();
      // var image = $('#image-message')[0].files[0];
      var image = null;
      var check_content = content.replace(/ /g, '')
      if(check_content == null && image == null){
         return false;
      }
      var url = '/admin/chat/send-message';
      var formData = $('#formSendMessage');
      var btnSubmit = formData.find(':submit');
        btnSubmit.text('Đang xử lý...');
        btnSubmit.prop('disabled', true);
        dataPost = formData.serialize()+"&room_id="+room_id;
      $.ajax({
         type: "POST",
         url: url,
         data:dataPost,
         enctype: 'multipart/form-data',
         beforeSend: function (xhr) {
          
         },
         success: function (data) {
            formData.trigger('reset');
         },
         error: function (data) {
            formData.trigger('reset');
         },
         complete: function (data) {
            btnSubmit.text('Gửi');
            btnSubmit.prop('disabled', false);
         }
     });

   }
   function loadMessage(room_id){
      var url = '/admin/chat/load-message/'+room_id;
      $.ajax({
         type: "GET",
         url: url,
         beforeSend: function (xhr) {
            
         },
         success: function (data) {
            if(data.status == 1){
               if(data.data.length > 0){
                  let $temp = '';
                  $.each(data.data,function(key,value){
                     if(value.user_id == AUTHOR_ID){
                        $temp += `<div class="d-flex flex-column mb-5 align-items-end">`;
                        $temp += `<div class="d-flex align-items-center">`;
                        $temp += `<div>`;
                        // $temp += `<span class="text-muted font-size-sm">3 minutes</span>`;
                        $temp += `<a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">Bạn</a>`;
                        $temp += `</div>`;
                        $temp += `<div class="symbol symbol-circle symbol-35 ml-3">`;
                        $temp += `<img alt="Pic" src="/assets/backend/image/profie-default.jpg">`;
                        $temp += `</div>`;
                        $temp += `</div>`;
                        $temp += `<div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">`;
                        $temp += `${value.content}`;
                        $temp += `</div>`;
                        $temp += `</div>`;
                     }
                     else{
                        $temp += `<div class="d-flex flex-column mb-5 align-items-start">`;
                        $temp += `<div class="d-flex align-items-center">`;
                        $temp += `<div class="symbol symbol-circle symbol-35 mr-3">`;
                        $temp += `<img alt="Pic" src="/assets/backend/image/profie-default.jpg">`;
                        $temp += `</div>`;
                        $temp += `<div>`;
                        $temp += `<a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">${value.users.username}</a>`;
                        // $temp += `<span class="text-muted font-size-sm">2 Hours</span>`;
                        $temp += `</div>`;
                        $temp += `</div>`;
                        $temp += `<div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">`;
                        $temp += `${value.content}`;
                        $temp += `</div>`;
                        $temp += `</div>`;
                     }
                  })
                  $('#result-chat').append($temp);
                  $("#result-chat").stop().animate({scrollTop: $("#result-chat")[0].scrollHeight}, 200);
               }
            }
            else{
               alert('ERRORS');
            }
         },
         error: function (data) {
            alert('ERRORS');
         },
         complete: function (data) {
            
         }
     });
   }
})