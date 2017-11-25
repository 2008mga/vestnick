'use strict';
const path = require('path');
const env = require('dotenv').config({ path: path.resolve(__dirname + '../../../.env.front') });
const merge = require('webpack-merge');

console.log(env);

module.exports = merge({
  NODE_ENV: '"production"',
  API_URL: '"/api"',
}, env.parsed);