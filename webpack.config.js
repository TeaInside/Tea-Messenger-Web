const webpack = require('webpack');
const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const devMode = process.env.NODE_ENV !== 'production';

module.exports = {
  entry: {
    styles: './src/scss/styles.scss',
    app: './src/app.js'
  },
  output: {
    filename: 'assets/js/[name].[contenthash].js',
    chunkFilename: 'assets/js/[name].[contenthash].js',
    sourceMapFilename: "assets/js/[name].[contenthash].map",
    path: path.join(__dirname, 'public'),
    publicPath: '/'
  },
  devtool: 'eval',
  devServer: {
    port: 3000,
    contentBase: path.join(__dirname, 'src/assets'),
    publicPath: '/',
    historyApiFallback: true,
    watchContentBase: true,
    compress: true
  },
  plugins: [
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery'
    }),
    new HtmlWebpackPlugin({
      template: './src/index.html'
    }),
    new MiniCssExtractPlugin({
      filename: "assets/css/styles.[contenthash].css",
      chunkFilename: "assets/css/[name].[contenthash].css"
    })
  ],
  module: {
    rules: [
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          devMode ? 'style-loader' : MiniCssExtractPlugin.loader ,
          {
            loader: 'css-loader',
            options: {
              sourceMap: false
            }
          },
          {
            loader: 'postcss-loader',
            options: {
              ident: 'postcss',
              plugins: [
                require('autoprefixer')
              ]
            }
          },
          {
            loader: 'sass-loader'
          }
        ]
      },
      {
        test: /\.html$/,
        loader: 'html-loader'
      },
      { 
        test: /\.js$/, 
        exclude: /node_modules/, 
        use: [
          'babel-loader',
          'eslint-loader'
        ]
      },
      {
        test: /\.(woff(2)?|ttf|eot|svg)$/,
        loader: 'file-loader',
        options: {
          name: '[name].[ext]',
          outputPath: 'assets/webfonts/'
        }
      },
      {
        test: /\.(png|jp(e)?g|gif)$/,
        loader: 'file-loader',
        options: {
          outputPath: 'assets/images/[name].[ext]'
        }
      }
    ]
  },
  optimization: {
    runtimeChunk: false,
    splitChunks: {
      cacheGroups: {
        default: false,
        commons: {
          test: /[\\/]node_modules[\\/]/,
          name: 'vendor',
          chunks: 'all',
          minChunks: 2
        }
      }
    }
  }
};