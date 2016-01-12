'use strict';
var gulp = require('gulp');
var gutil = require('gulp-util');
var livereload = require('gulp-livereload');

gulp.task('watch', function () {
  var onChange = function (event) {
    gutil.log(gutil.colors.bgGreen('File '+event.path+' has been '+event.type));
    // Tell LiveReload to reload the window
    livereload.changed();
  };
  // Starts the server
  livereload.listen();
  gulp.watch('./src/juzz/*/Resources/components/**/*.jsx', ['app'])
  .on('change', onChange);

  gutil.log(gutil.colors.bgGreen('Watching for changes...'));
  
});
