const express = require('express'),
    server = express(),
    mongodb = require('mongodb').MongoClient,
    url = 'mongodb://localhost:27017'
    port = 3001;

server.use(express.json());

server.get('/chat', function(req, resp){
    resp.send('Hola Mundo');
});

server.get('/cliente/list', function(req, resp){
    mongodb.connect(url, function(err, client){
        if(err) resp.send(err);
        const db = client.db('facturacion');
        db.collection('cliente').find({}).toArray(function(err, data){
            if(err) resp.send(err);
            resp.send(data);
        });
    });
});

server.get('/cliente/nuevo', function(req, resp){
    resp.sendfile(__dirname + '/index.html');
});

server.listen(port, function(event){
    console.log('Server running on port 3001');
});