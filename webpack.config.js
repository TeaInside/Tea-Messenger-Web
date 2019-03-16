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
    filename: 'assets/js/[name].[hash].js',
    chunkFilename: 'assets/js/[name].[hash].js',
    sourceMapFilename: "assets/js/[name].[hash].map",
    path: path.resolve(__dirname, 'public')
  },
  devtool: 'eval',
  devServer: {
    port: 3000,
    contentBase: path.resolve(__dirname, 'src/assets'),
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
    })
  ],
  module: {
    rules: [
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          {
            loader: 'style-loader'
          },
          {
            loader: 'css-loader',
            options: {
              sourceMap: false
            }
          },
          {
            loader: 'sass-loader'
          },
          {
            loader: 'postcss-loader',
            options: {
              ident: 'postcss',
              plugins: [
                require('autoprefixer')
              ]
            }
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