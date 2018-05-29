'use strict';

const { spawn } = require('child_process');
const async = require('async');

const runProcess = (clientId, clientSecret, email, password, seller) => {
    	return spawn('php', ['process.php', '-i', clientId, '-s', clientSecret, '-e', email, '-p', password, '-v', seller, '-q', 1]);
};



const list = [
	{clientId: '4', clientSecret: 'QK02jwHxhXYrJDyR4VE19lT9FPyxpz0SDWPtYKXb', email: 'testing1@semexpert.com.ar', password: 'Testing-1', seller: 'TESTING1'},
];

async.parallel(list.map(credenciales => (() => runProcess(
	credenciales.clientId,
	credenciales.clientSecret,
	credenciales.email,
	credenciales.password,
	credenciales.seller
))));

