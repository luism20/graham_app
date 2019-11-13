module.exports = function (io) {
    var express = require('express');
    var router = express.Router();
    var redis = require('redis');

    /* GET home page. */
    router.get('/', function (req, res, next) {
        res.render('index', {
            title: 'Express'
        });
    });

    io.on('connection', function (socket) {        
        var redisClient = redis.createClient();        
        redisClient.psubscribe('*', function(err, count) {});

        redisClient.on('pmessage', function (subscribed, channel, message) {
            socket.emit(channel, message);
        });
    });

    return router;
}





