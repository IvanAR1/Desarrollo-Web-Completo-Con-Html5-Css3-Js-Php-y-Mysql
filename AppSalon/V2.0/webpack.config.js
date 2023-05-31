const path = require("path")
var webpack = require("webpack");

module.exports = {
  entry: {
    main: "./src/js/app.js",
  },
  output: {
    filename: "bundle.min.js",
    path: path.resolve(__dirname, "js"),
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: "babel-loader",
        options: {
          presets: ["@babel/preset-env"],
        },
      },
    ],
  },
  plugins: [
    new webpack.ProvidePlugin({
        $: "jquery",
        jQuery: "jquery",
        Swal:"sweetalert2/dist/sweetalert2.js",
        Validator:"validatorjs"
    })
  ],
  mode:"development"
}