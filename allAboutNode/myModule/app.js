'use strict';

const Enigma = require('./enigma');
const eng = new Enigma('magrathea');

let encodeString = eng.encode("Dont Panic!");
let decodeString = eng.decode(encodeString);

console.log("Encoded: " +  encodeString);
console.log("Decoded: " +  decodeString);

let qr = eng.qrgen("http://www.npmjs.com", 'OutImage.png');

qr ? console.log('QR Code created') : console.log("QR Code failed!");



// console.log(eng.hello("Dave"));

// console.log(eng.goodmorning("Dave"));