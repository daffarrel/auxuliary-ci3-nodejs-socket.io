var socket  = require( 'socket.io' );
var express = require('express');
var app     = express();
var server  = require('http').createServer(app);
var io      = socket.listen( server );
var port    = process.env.PORT || 3030;

server.listen(port, function () {
  console.log('Server listening at port %d', port);
});

io.on('connection', function (socket) {

	socket.on( 'auxStart', function( data ) {
		socket.broadcast.emit( 'auxStart', { 
			nip			: data.nip,
            fullname	: data.fullname,
            currReason	: data.currReason,
            currTime 	: data.currTime,
		});
	});

	socket.on( 'auxEnd', function( data ) {
		io.sockets.emit( 'auxEnd', { 
			nip			: data.nip,
			fullname	: data.fullname,
			sCODE		: data.sCODE,
			sDATESTART	: data.sDATESTART,
			hsSTART		: data.hsSTART,
			auxtypeName : data.auxtypeName,
			getTot		: data.getTot,
		});
	});

	socket.on( 'onLogin', function( data ) {
		socket.broadcast.emit( 'onLogin', { 
			nip			: data.nip,
			fullname	: data.fullname,
			sCODE		: data.sCODE,
			sDATESTART	: data.sDATESTART,
			hsSTART		: data.hsSTART,
			auxtypeName : data.auxtypeName,
			getTot		: data.getTot,
		});
	});

	socket.on( 'onLogout', function( data ) {
		socket.broadcast.emit( 'onLogout', { 
			nip: data.nip,
            fullname: data.fullname,
		});
	});

	socket.on( 'forceLog', function( data ) {
		io.sockets.emit( 'forceLog', { 
			
		});
	});

});