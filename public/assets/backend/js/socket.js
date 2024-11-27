$(document).ready(function () {
    const csrf_token = $('meta[name="csrf-token"]').attr('content');
    const AUTHOR_ID = $('meta[name="author_id"]').attr('content');
    const CHANNEL_SOCKET = $('meta[name="channel-socket"]').attr('content');
    const URL_LIST_CHAT = '/admin/chat/list-message';
    const ROOM_CHAT = window.location.pathname.split('/')[3];
    const TOKEN_SOCKET_CHAT = $('meta[name="socket-token').attr('content');
    const HOST_SOCKET_CHAT = $('meta[name="socket-chat').attr('content');
    const SOCKET_CHAT = io(HOST_SOCKET_CHAT,{
        query: {
            "token": TOKEN_SOCKET_CHAT
        },
        transports: ["websocket"]
    });
    SOCKET_CHAT.on('channel_chat:channel-'+CHANNEL_SOCKET, function(data) {
        console.log(data);
    })
});