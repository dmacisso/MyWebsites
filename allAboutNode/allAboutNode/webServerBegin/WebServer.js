'use strict'
const http = require('http');
const url = require('url');
const fs = require('fs');
const path = require('path');


let mimes = {
	'.htm': 'text/html',
	'.css': "text/css", 
	'.js': "text/javascript",
	'gif': "image/gif", 
	'jpg': 'image/jpeg',
	'.png': "image/png", 
}

function webserver(req, res) {
	//if the route requested is '/', then load 'index.htm' or else 
	// load the requested file(s)

	let baseURI = url.parse(req.url);
	let filepath = __dirname + (baseURI.pathname === '/' ? '/index.htm' : baseURI.pathname);
	
	// Check if the requested file is accessible or not
	fs.access(filepath, fs.F_OK,  error => {
		if(!error) {
			// Read and Serve the file over response
			fs.readFile(filepath, (error, content) => {
				if(!error) {
					console.log('Serving: ', filepath);
					//Resove the MIME(content type) type 
					let contentType = mimes[path.extname(filepath)]; //mimes['.css'] === 'text/css'
					//Server file from buffer
					res.writeHead(200, {'Content-type': contentType});
					res.end(content, 'utf-8');
				} else {
					//Server 500 error
					res.writeHead(500);
					res.end('The server could not read the file requested');
				}
			});
		
		} else {

			res.writeHead(404);
			res.end('Content Not Found!')
		}

	}) ;



}

http.createServer(webserver).listen(3000, () => {
	console.log('Webserver running on port 3000');
});



