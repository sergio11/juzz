'use strict';
var gulp = require('gulp');
var gutil = require('gulp-util');
var livereload = require('gulp-livereload');

gulp.task('watch', function() {
  var reloadServer = livereload();
  gulp.watch('./src/juzz/**/Resources/components/**/**/*.jsx').on('change', function(event) {
    gulp.start('app', function() {
      gutil.log(gutil.colors.bgGreen('Reloading...'));
      reloadServer.changed(event.path);
    });
  });

  gulp.watch('./node_modules/**/*.js').on('change', function(event) {
    gulp.start('vendor', function() {
      gutil.log(gutil.colors.bgGreen('Reloading...'));
      reloadServer.changed(event.path);
    });
  });

  gutil.log(gutil.colors.bgGreen('Watching for changes...'));
});