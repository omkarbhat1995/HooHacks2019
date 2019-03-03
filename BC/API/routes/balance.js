var express = require('express');
const contract = require('../web3_modules/coin_abi');
var router = express.Router();
var cors = require('cors');
var router = express.Router();
var decToHex = require("dec-to-hex");
var bigInt = require("big-integer");
var BigNumber = require('bignumber.js');

router.post('/', cors(), function(req, res) {
	var coin = contract.getCoinInstance();
	coin.methods.balanceOf(req.body.address).call().then(function(result){res.status(200).json({status:1,message:"OK",result:result})});
	// var result = coin.balanceOf(req.body.address);
    // res.status(200).json({status:1,message:"OK",result:result});
}); 

module.exports = router;
