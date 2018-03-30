var argv = require('yargs').argv;
var gulpif = require('gulp-if');
var rename = require('gulp-rename');
var gulp = require('gulp');
var gutil = require('gulp-util');
var plumber = require('gulp-plumber');
var postcss = require('postcss');
var sass = require('gulp-sass');
var coffee = require('gulp-coffee');
var autoprefixer = require('gulp-autoprefixer');
var replace = require('gulp-replace');

var paths = {
  sass: './source/sass/*.scss',
  coffee: './source/coffee/*.coffee',
}

var dest = {
  css: './',
  js: './assets/js/',
  images: './assets/images/'
}

gulp.task('compile-sass', function() {
  var sassOptions = {
    compress: argv.prod ? true : false
  };
  var apOptions = {
    browsers: ['> 0.5%', 'last 5 versions', 'Firefox ESR', 'not dead']
  };
  gulp.src(paths.sass)
    .pipe(plumber())
    .pipe(sass(sassOptions))
    .pipe(autoprefixer(apOptions))
    .pipe(gulpif(argv.prod, rename('*.min.css')))
    .pipe(replace('images/', dest.images))
    .pipe(gulp.dest(dest.css))
  .on('end', function() {
    log('Sass done');
    if (argv.prod) log('CSS minified');
  });
});

gulp.task('compile-coffee', function() {
  return gulp.src(paths.coffee)
    .pipe(coffee({bare: true}))
    .pipe(gulpif(argv.prod, rename('*.min.js')))
    .pipe(gulp.dest(dest.js))
  .on('end', function() {
    log('Coffee done');
    if (argv.prod) log('JS minified');
  });
});

gulp.task('watch', function() {
  // gulp.watch(paths.templates, ['compile-templates']);
  gulp.watch(paths.sass, ['compile-sass']);
  gulp.watch(paths.coffee, ['compile-coffee']);
});


gulp.task('default', [
  'compile-sass',
  'compile-coffee',
  'watch'
]);

gulp.task('dev', [
  'compile-sass',
  'compile-coffee',
  'watch'
]);

gulp.task('prod', [
  'compile-sass',
  'compile-coffee'
]);

function log(message) {
  gutil.log(gutil.colors.bold.green(message));
}