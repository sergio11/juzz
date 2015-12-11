var gulp = require('gulp')  
var browserify = require('browserify')  
var babelify = require('babelify')  
var source = require('vinyl-source-stream')  
var nib = require('nib')  
var minify = require('gulp-minify-css')


gulp.task('build', function() {  
  browserify({
    entries: './src/index.jsx',
    extensions: ['.jsx'],
    debug: true
  })
  .transform(babelify)
  .bundle()
  .pipe(source('bundle.js'))
  .pipe(gulp.dest('./build/js'))
})

gulp.task('watch', function() {  
  gulp.watch('./src/**/*.jsx', ['build'])
  gulp.watch(['./src/styles/**/*.styl', './src/components/**/*.styl'], ['stylus'])
})

gulp.task('default', ['watch'])