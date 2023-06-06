require('dotenv').config({path: '../.env'});
const redisPrefix       = process.env.REDIS_PREFIX;
const app               = require('express')();
const http              = require('http').Server(app);
const io                = require('socket.io')(http);
var client              = io.sockets;
const port              = process.env.SOCKET_PORT;
const redis             = require('redis');
const redisClient       = redis.createClient({port: process.env.REDIS_PORT});
const publisher         = redis.createClient({port: process.env.REDIS_PORT});
const purchase_listener = redis.createClient({port: process.env.REDIS_PORT});

io.on('connection', (socket) => {

    socket.on('init-user-socket', function (user) {
        redisClient.set(redisPrefix + 'users_' + user.user_tpe + '_' + user.user_id, socket.id);
    });

    purchase_listener.subscribe([redisPrefix + 'order-monitoring-publish', redisPrefix + 'public']);
    purchase_listener.on("message", function (channel, message) {

        if (channel == redisPrefix + 'order-monitoring-publish') {
            message = JSON.parse(message);
            socket.emit('order-monitoring-publish', message);
            io.to(redisClient.get(redisPrefix + "users_customer_" + message.customer_id)).emit('order-monitoring', message);
            io.to(redisClient.get(redisPrefix + "users_delivery_" + message.delivery_id)).emit('order-monitoring', message);
        }

        if (channel == redisPrefix + "public") {
            socket.emit('public',message);
            console.log(message);
        }


    });
});


http.listen(port, () => {
    console.log(`Socket.IO server running at http://localhost:${port}/`);
});


