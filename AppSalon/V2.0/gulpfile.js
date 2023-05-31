const { src, dest, watch , series, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('autoprefixer');
const postcss    = require('gulp-postcss')
const sourcemaps = require('gulp-sourcemaps')
const cssnano = require('cssnano');
const concat = require('gulp-concat');
const terser = require('gulp-terser-js');
const rename = require('gulp-rename');
const imagemin = require('gulp-imagemin'); // Minificar imagenes 
const notify = require('gulp-notify');
const cache = require('gulp-cache');
const clean = require('gulp-clean');
const webp = require('gulp-webp');
const browserify = require('gulp-browserify');
const webpack = require("webpack-stream");
const browserSync = require('browser-sync').create();

const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    imagenes: 'src/img/**/*'
}

function reload()
{
    browserSync.init({
		open: false,
		injectChanges: true,
		// port: 8081, ... can change browser-sync port from default 3000 if needed
		proxy: "http://www.appsalon.com.mx",
        host:"www.appsalon.com.mx",
        open: 'external',
        logLevel: 'debug',
	});
}

// css es una función que se puede llamar automaticamente
function css() {
    return src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(sass(
            {
                includePaths: [
                    'node_modules'
                ]
            }
        ))
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(postcss([autoprefixer()]))
        .pipe(sourcemaps.write('.'))
        .pipe( dest('public/build/css') )
        .pipe(browserSync.stream());
}


function javascript() {
    return src(paths.js)
      .pipe(sourcemaps.init())
      .pipe(concat('bundle.js')) // final output file name
      .pipe(webpack(require("./webpack.config.js")))
      .pipe(terser())
      .pipe(sourcemaps.write('.'))
      .pipe(dest('public/build/js'))
      .pipe(browserSync.stream());
}

function imagenes() {
    return src(paths.imagenes)
        .pipe(cache(imagemin({ optimizationLevel: 3})))
        .pipe(dest('public/build/img'))
        .pipe(notify({ message: 'Imagen Completada'}))
}

function versionWebp() {
    return src(paths.imagenes)
        .pipe( webp() )
        .pipe(dest('public/build/img'))
        .pipe(notify({ message: 'Imagen Completada'}))
}

function watchArchivos() {
    watch( paths.scss, css ).on('change',browserSync.reload);
    watch( paths.js, javascript ).on('change',browserSync.reload);
    watch( paths.imagenes, imagenes );
    watch( paths.imagenes, versionWebp );
}
  
let view = parallel(watchArchivos,reload);
exports.css = parallel(css,view);
exports.javascript = parallel(javascript, view);
exports.watchArchivos = watchArchivos;
exports.default = parallel(css, javascript,  imagenes, versionWebp,  view); 