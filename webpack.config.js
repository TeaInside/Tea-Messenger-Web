const webpack = require('webpack');
const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
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
    new CleanWebpackPlugin('./public'),
    new HtmlWebpackPlugin({
      template: './src/index.html'
    }),
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