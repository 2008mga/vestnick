const path = require('path');
const utils = require('./utils');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const WebpackNotifierPlugin = require('webpack-notifier');

const rules = [
  {
    test: /\.js$/,
    loader: 'babel-loader',
    include: path.join(__dirname , '..', 'resources/assets/js/admin/src'),
    exclude: /(node_modules|bower_components)/
  },
  {
    test: /\.(png|jpe?g|gif|svg)(\?.*)?$/,
    use: [
      {
        loader: 'url-loader',
        options: {
          limit: 10000,
          name: utils.assetsPath('img/[name].[hash:7].[ext]')
        }
      }
    ]
  },
  {
    test: /\.(mp4|webm|ogg|mp3|wav|flac|aac)(\?.*)?$/,
    use: [
      {
        loader: 'url-loader',
        options: {
          limit: 10000,
          name: utils.assetsPath('media/[name].[hash:7].[ext]')
        }
      }
    ]
  },
  {
    test: /\.(woff2|woff|eot|ttf|otf)$/,
    use: [
      {
        loader: 'url-loader',
        options: {
          limit: 10000,
          name: utils.assetsPath('fonts/[name].[hash:7].[ext]')
        }
      }
    ]
  }
];

const styleLoaders = utils.styleLoaders({
  sourceMap: null,
  extract: process.env.NODE_ENV === 'production'
});

styleLoaders.forEach((loader) => {
  rules.push(loader);
});


module.exports = {
  context: path.resolve(__dirname, '../resources/assets/js/admin'),
  entry: {
    admin: './src/admin.js'
  },
  output: {
    path: path.resolve(__dirname, '../public/static/admin'),
    filename: '[name].js',
    publicPath: '/static/admin/'
  },
  resolve: {
    extensions: ['.js', '.vue', '.json'],
    alias: {
      '@': path.resolve(__dirname, '../resources/assets/js/admin/src'),
      '~': path.resolve(__dirname, '../node_modules'),
      '%': path.resolve(__dirname, '../resources/assets/sass/admin')
    }
  },
  module: { rules },
  plugins: [
    new ExtractTextPlugin({
      filename: "[name].css"
    }),
    new WebpackNotifierPlugin({
      title: 'Build [' + process.env.NODE_ENV + ']',
      alwaysNotify: true,
      skipFirstNotification: true
    })
  ],
  watch: process.env.NODE_ENV === 'development'
};