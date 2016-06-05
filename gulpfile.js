var gulp = require('gulp'),
    config = require('./config.json'),
    rename = require("gulp-rename"),
    concat = require('gulp-concat'),
    watch = require('gulp-watch'),
    sourcemaps = require('gulp-sourcemaps'),
    concatCss = require('gulp-concat-css'),
    cleanCSS = require('gulp-clean-css'),
    less = require('gulp-less'),
    uncss = require('gulp-uncss'),
    uglify = require('gulp-uglifyjs');

//copy all fonts from bower components
gulp.task('copy-font', function () {
    return gulp.src([
            'bower_components/**/*.eot',
            'bower_components/**/*.ttf',
            'bower_components/**/*.woff',
            'bower_components/**/*.woff2'
        ])
        .pipe(rename(function (path) {
            path.dirname = "fonts/";
        }))
        .pipe(gulp.dest('static/'));
});

//concatenate js files
gulp.task('ext-js', function () {
    return gulp.src(config.js)
        .pipe(concat('js.js'))
        .pipe(gulp.dest('static/build/'));
});


//concatenate css files,
//remove unused selector/rule,
//optimize and minify
gulp.task('ext-css', function () {
     return gulp.src(config.css)
        .pipe(concatCss("css.css", {rebaseUrls: false}))
        .pipe(gulp.dest('static/css/'))
        .pipe(uncss({
            html: ['http://localhost/modulo.io/site2/'],
            ignore : [
                '.open > .dropdown-menu', '.fa-spinner', '.fa-spin', '.collapsing', 
                '.navbar-collapse.in', '.collapse.in', '.navbar-nav .open .dropdown-menu',
                '.alert-danger .alert-success .alert-warning'
            ],
            media : ['(max-width: 767px)']
        }))
        .pipe(cleanCSS({advanced: true}))
        .pipe(gulp.dest('static/build/'));
});


//compile and minify main.less
gulp.task('less', function () {
    return gulp.src('static/less/main.less')
        .pipe(sourcemaps.init())
        .pipe(less())
        .pipe(cleanCSS({advanced: true}))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest('static/build/'));
});

//minify main.js
gulp.task('js', function () {
    return gulp.src('static/js/main.js')
        .pipe(uglify({outSourceMap : true}))
        .pipe(gulp.dest('static/build/'));
});


//build task, compile/minifie/concat js-less-css
gulp.task('build', ['less', 'js', 'ext-css', 'ext-js']);

//watch main.less and main.js change
gulp.task('default', function (cb) {
    gulp.watch('static/less/main.less', ['less']);
    gulp.watch('static/js/main.js', ['js']);
});

