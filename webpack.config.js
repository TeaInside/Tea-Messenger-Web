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
    custom: './src/scss/custom.scss',
    app: './src/app.js'
  },
  resolve: {
    alias: {
      Modules: path.resolve(__dirname, 'src/modules'),
      Components: path.resolve(__dirname, 'src/components'),
      Services: path.resolve(__dirname, 'src/services')
    }
  },
  output: {
    filename: 'assets/js/[name].[contenthash].js',
    chunkFilename: 'assets/js/[name].[contenthash].js',
    sourceMapFilename: "assets/js/[name].[contenthash].map",
    path: path.join(__dirname, 'public'),
    publicPath: '/'
  },
  node: {
    __dirname: true
  },
  devtool: 'eval',
  devServer: {
    port: 3000,
    contentBase: path.join(__dirname, 'src/assets'),
    publicPath: '/',
    historyApiFallback: true,
    watchContentBase: true
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
      filename: "assets/css/[name].[contenthash].css",
      chunkFilename: "assets/css/[name].[contenthash].css"
    }),
    new CleanWebpackPlugin(),
    new CopyWebpackPlugin(
    [{ 
      from: './src/assets', 
      to: 'assets' 
    },
    { 
      from: './node_modules/@fortawesome/fontawesome-free/css', 
      to: 'assets/vendors/fontawesome/css'
    },
    { 
      from: './node_modules/@fortawesome/fontawesome-free/webfonts', 
      to: 'assets/vendors/fontawesome/webfonts'
    },
    { 
      from: './node_modules/animate.css/animate.min.css', 
      to: 'assets/vendors/animate.css/animate.min.css'
    },
    { 
      from: './node_modules/noty/lib', 
      to: 'assets/vendors/noty'
    }], 
    { 
      debug: false 
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
            loader: 'sass-loader',
            options: {
              implementation: require('sass')
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
      },
      {
        test: /\.txt$/,
        use: 'raw-loader'
      },
    ]
  }
};