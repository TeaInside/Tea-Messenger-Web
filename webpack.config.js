const webpack = require('webpack');
const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const devMode = process.env.NODE_ENV !== 'production';

module.exports = {
  mode: 'development',
  entry: {
    vendors: ['bootstrap'],
    styles: ['./src/scss/styles.scss'],
    app: ['./src/app.js']
  },
  output: {
    filename: '[name].bundle.js',
    chunkFilename: '[name].bundle.js',
    sourceMapFilename: "[name].bundle.map",
    path: path.resolve(__dirname, 'public')
  },
  devtool: 'eval',
  devServer: {
    contentBase: path.resolve(__dirname, 'src/assets'),
    publicPath: '/',
    historyApiFallback: true,
    watchContentBase: true
  },
  plugins: [
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery'
    }),
    new MiniCssExtractPlugin({
      filename: "[name].css",
      chunkFilename: '[id].css'
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
        { from: './node_modules/animate.css/animate.min.css', to: 'assets/vendors/animate.css/'}
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
            loader: devMode ? 'style-loader' : MiniCssExtractPlugin.loader
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
        loader: 'babel-loader',
        options: {
          presets: [
            ['@babel/preset-env', { modules: false } ]
          ]
        }
      },
      { 
        test: /\.js$/, 
        exclude: /node_modules/, 
        loader: 'eslint-loader',
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
  }
};