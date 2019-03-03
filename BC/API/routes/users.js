var express = require('express');
var router = express.Router();

/* GET users listing. */
router.get('/', function(req, res, next) {
  res.send('Sanatkumar J Kondhol, Omakr Bhat, Jyoti Kumari, Leh');
});

module.exports = router;
