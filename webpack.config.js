// webpack.config.js
//const VueLoaderPlugin = require('vue-loader/lib/plugin')
const path = require( 'path' )

module.exports = {
    entry: {
        //main: path.join( __dirname, 'src/main.js' ),
        //cicVue: path.join( __dirname, 'src/cic-vue.js' ),
    },
    mode: 'production',
module: {
    rules: [
    // ... other rules
    {
        test: /\.css$/,
        exclude: /node_modules$/,
        use: ['css-loader' ]
    },
    ]
},
optimization: {
    runtimeChunk: 'single',
},
}