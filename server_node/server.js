const express = require("express")
var cors = require('cors');
var app = express();
const crypto = require('crypto');
const config = require('../config.json');
const key = config.key_encrypt_socket;
const PORT = config.port;
const KEY = key.substring(0,32)
const key_very_socket = config.key_very_socket
var decrypt = ((encrypted) => {
    try{
        var data = encrypted;
        var iv = new Buffer(data.substring(0,32), 'hex');
        var dec = crypto.createDecipheriv('aes-256-cbc',KEY,iv);
        var decrypted = Buffer.concat([dec.update(new Buffer(data.substring(32),'base64')), dec.final()]);
        return decrypted.toString();
    }catch{
        return false;
    }
});
app.use(cors());
var server = app.listen(PORT);
var io = require('socket.io')(server, {
    cors: {
      origin: '*',
      methods: ["GET", "POST"]
    }
});

var Redis = require('ioredis');
var redis = new Redis(6379);
redis.psubscribe("*",function(error,count){
})
const arrUserInfo=[];
console.log('ket noi cong '+PORT);
io.on('error',function(socket){
    console.log('error');
});
io.use(function(socket, next){
    try{
        var token = socket.handshake.query.token;
        if (token){
            original_phrase = decrypt(token);
            if(original_phrase == false || original_phrase == null || original_phrase == ""){
                next(new Error('Authentication error'));
            }
            else{
                var is_very = original_phrase.split(',')
                if(is_very[2] == key_very_socket){
                    next();
                }
                else{
                    next(new Error('Authentication error'));
                }
            }
        }
        else {
        next(new Error('Authentication error'));
        }
    }catch{
        next(new Error('Authentication error'));
    }   
})
.on('connection',function(socket){
    socket.on("disconnect", (reason) => {
        const index = arrUserInfo.findIndex(user=>user.socketId===socket.id);
        if(index!==-1){
            arrUserInfo.splice(index,1);
        }
    });
    var token = socket.handshake.query.token;
    original_phrase = decrypt(token);
    var is_very = original_phrase.split(',');
    var user_id = is_very[1];
    var socketId = socket.id;
    userConnected={id:user_id,socketId: socketId}
    arrUserInfo.push(userConnected);
    console.log(arrUserInfo);
});
redis.on('pmessage',function(partner,channel,message){
    message = JSON.parse(message);
    console.log(message);
    console.log(channel);
    let socketId;
    const index = arrUserInfo.findIndex(user=>Number(user.id)===message.data.message.user);
    socketId = multiIndexOf(arrUserInfo,message.data.message.user);
    if(socketId.length > 0){
        io.to(socketId).emit(channel +":"+message.event,message.data.message);
    }
});
function multiIndexOf(Obj,el){
    var list = [];
    Obj.forEach(function(item,key) {
        if(item.id == el){
            list.push(item.socketId);
        }
    });
    return list;
}