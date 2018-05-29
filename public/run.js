'use strict';

const { spawn } = require('child_process');
const async = require('async');

const runProcess = (clientId, clientSecret, email, password, seller, pde) => {
    	return spawn('php', ['process.php', '-i', clientId, '-s', clientSecret, '-e', email, '-p', password, '-v', seller, '-q', 5]);
};



const list = [
	{clientId: '174', clientSecret: 'xYzVAdHpvfh6263xtmr8kKeuKICtryXq21IwyuTn', email: 'testing1@semexpert.com.ar', password: 'Testing-1', seller: 'TESTING1'},
	{clientId: '173', clientSecret: 'MlEEpJ0tvZyP9WUhz81mOp0FFUIZ2isvz10j8Hvp', email: 'testing2@semexpert.com.ar', password: 'Testing-2', seller: 'TESTING2'},
	{clientId: '175', clientSecret: 'Ez70QhMnwO9aclLox16lesbDUflze1ZetsSf1tva', email: 'testing3@semexpert.com.ar', password: 'Testing-3', seller: 'TESTING3'},
	{clientId: '176', clientSecret: 'lo8JhKpt6t55KXc2vLmRY7Fv60C6aGUAkLZR91ws', email: 'testing4@semexpert.com.ar', password: 'Testing-4', seller: 'TESTING4'},
	{clientId: '177', clientSecret: 'T5vzMhGiFb1kBgIw1q3ZlQ6GbFc1Pub7or0XCWf5', email: 'testing5@semexpert.com.ar', password: 'Testing-5', seller: 'TESTING5'}
];

async.parallel(list.map(credenciales => (() => runProcess(
	credenciales.clientId,
	credenciales.clientSecret,
	credenciales.email,
	credenciales.password,
	credenciales.seller
))));

