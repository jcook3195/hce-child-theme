const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const webpack = require('webpack');
const webpackStream = require('webpack-stream');
const webpackConfig = require( './webpack.config.js' );

sass.compiler = require('node-sass');
function buildScss() {
    return gulp.src( 'assets/scss/source.scss' )
    .pipe( sass({ 
        outputStyle: 'compressed'
    }).on('error', sass.logError))
    .pipe(gulp.dest('./css'))
}

/*function buildJS() {
    return gulp.src( 'src/main.js' )
        .pipe( webpackStream( webpackConfig ), webpack )
        .pipe( gulp.dest( './dist' ) )
}


gulp.task( buildJS )*/
gulp.task( buildScss )


gulp.task( 'sass:watch', function () {
    buildScss();
    // gulp.watch( 'src/**/*.js', gulp.parallel( buildJS ) )
    // gulp.watch( 'src/**/*.vue', gulp.parallel( buildJS ) )
    return gulp.watch('assets/scss/**/*.scss', gulp.parallel( buildScss ) );
});