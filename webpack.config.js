const path = require('path');
const webpack = require('webpack');

module.exports = {
  // target: 'node',
  // mode: process.env.NODE_ENV === 'production' ? 'production' : 'development',
  // entry: [ './src/index.js' ],
  // output: {
  //   path: path.resolve(__dirname, 'build'),
  //   filename: 'index.js',
  //   library: 'index',
  //   libraryTarget: 'commonjs2'
  // },
  // plugins: [
  //   new webpack.IgnorePlugin(/^pg-native$/),
  //   new webpack.DefinePlugin({
  //     'process.env.BROWSER': false,
  //     __DEV__: process.env.NODE_ENV !== 'production',
  //   }),
  // ],
  module: {
    rules: [
      {
        {
          test: /\.jsx?$/,
          exclude: /node_modules/,
          loader: 'babel-loader',
          options: { babelrcRoots: ['.', '../'] }, // <-- this line fixed it!
        }
      }
    ],
  }
};
