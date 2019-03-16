const webpack = require('webpack');
const merge = require('webpack-merge');
const baseConfig = require('./webpack.config.js');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

module.exports = merge(baseConfig, {
  mode: 'production',
  devtool: 'cheap-module-source-map',
  plugins: [
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: JSON.stringify('production')
      },
    }),
    new CleanWebpackPlugin(),
    new CopyWebpackPlugin(
      [
        { from: './src/assets', to: 'assets' },
        { from: './node_modules/@fortawesome/fontawesome-free/css', to: 'assets/vendors/fontawesome/css'},
        { from: './node_modules/@fortawesome/fontawesome-free/webfonts', to: 'assets/vendors/fontawesome/webfonts'},
        { from: './node_modules/animate.css/animate.min.css', to: 'assets/vendors/animate.css/'},
        { from: './node_modules/noty/lib', to: 'assets/vendors/noty'}
      ],
      { debug: false}
    )
  ],
  optimization: {
    minimize: true,
    minimizer: [
      new OptimizeCSSAssetsPlugin(),
      new UglifyJsPlugin({
        sourceMap: true,
        uglifyOptions: {
          compress: {
            inline: false
          }
        }
      })
    ]
  },
  performance: {
    hints: false,
    maxAssetSize: 200000
  }
});