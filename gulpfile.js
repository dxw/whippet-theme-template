'use strict'

var gulp = require('gulp')
var runSequence = require('run-sequence')
var sass = require('gulp-sass')
var del = require('del')
var bower = require('gulp-bower')
var browserify = require('browserify')
var sourcemaps = require('gulp-sourcemaps')
var uglify = require('gulp-uglify')
var source = require('vinyl-source-stream')
var rename = require('gulp-rename')
var image = require('gulp-image')
var modernizr = require('gulp-modernizr')
var standard = require('gulp-standard')
var exorcist = require('exorcist')
var transform = require('vinyl-transform')
var streamify = require('gulp-streamify')
var gutil = require('gulp-util')

gulp.task('clean', function () {
  return del([
    'static/**'
  ])
})

gulp.task('bower', function () {
  return bower()
})

gulp.task('images', function () {
  return gulp.src('assets/img/**')
    .pipe(image())
    .on('error', gutil.log)
    .pipe(gulp.dest('static/img/'))
})

gulp.task('styles', function () {
  return gulp.src('assets/scss/main.scss')
    .pipe(sourcemaps.init({loadMaps: true}))
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.write())
    .pipe(transform(function () {
      return exorcist('static/main.min.css.map')
    }))
    .pipe(rename('main.min.css'))
    .pipe(gulp.dest('static/'))
})

gulp.task('scripts', function (callback) {
  runSequence(
    [
      'standard',
      'jquery',
      'modernizr',
      'browserify'
    ],
    callback
  )
})

gulp.task('standard', function () {
  return gulp.src(['gulpfile.js', 'assets/js/*.js'])
    .pipe(standard())
    .pipe(standard.reporter('default', {
      breakOnError: true
    }))
})

gulp.task('jquery', function () {
  return gulp.src('bower_components/jquery/dist/jquery.min.js')
    .pipe(gulp.dest('static/lib/'))
})

gulp.task('modernizr', function () {
  return gulp.src('static/main.min.css')
    .pipe(modernizr({
      'customTests': [],
      'tests': [
        'flexbox',
        'svgasimg'
      ],
      'options': [
        'html5printshiv',
        'html5shiv',
        'setClasses'
      ]
    }))
    .pipe(uglify())
    .pipe(rename('modernizr.min.js'))
    .pipe(gulp.dest('static/lib/'))
})

gulp.task('browserify', function (callback) {
  return browserify('assets/js/main.js', {debug: true})
    .bundle()
    .pipe(source('main.min.js'))
    .pipe(transform(function () {
      return exorcist('static/main.min.js.map')
    }))
    .pipe(streamify(uglify()))
    .pipe(gulp.dest('static/'))
})

gulp.task('watch', function () {
  gulp.watch('assets/img/**', ['images'])
  gulp.watch('assets/scss/**', ['styles'])
  gulp.watch('assets/js/**', ['scripts'])
})

gulp.task('default', function (callback) {
  runSequence(
    'clean',
    'bower',
    'images',
    'styles',
    'scripts',
    callback
  )
})
