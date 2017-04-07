"use strict";
const express = require('express');
const app = express();


app.set('port', process.env.PORT || 3000);

// middleware need to be poitioned before the route handlers.
// middleware is a plugin, 

let helloMiddleware = (req, res, next) => {
	req.hello = "Hello it's me. I was wondering ....you get the idea! ";
	next();   // control is passwd to the next middleware funciton..
};

app.use(helloMiddleware);  // plug it in here.


app.get('/', (req, res, next) => {        //create a route handler for the root route using the get method.
	res.send('<h1>Hello Express!</h1>');
});  

app.get('/dashboard',(req, res, next) => {
	res.send('<h1>This is the dashboard page!  Middleware says: ' + req.hello + '</h1>');
});        

app.listen(app.get('port'), () => {
	console.log("ChatCat running on port:", app.get('port'))

});


