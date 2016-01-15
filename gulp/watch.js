'use strict';
const gulp = require('gulp');
const plugins = require('gulp-load-plugins')({
  rename:{
    'gulp-util': 'gutil',
    'gulp-livereload': 'livereload'
  },
  scope: 'devDependencies'

});

gulp.task('watch', () => {
  var onChange = (event) => {
    plugins.gutil.log(gutil.colors.bgGreen('File '+event.path+' has been '+event.type));
    // Tell LiveReload to reload the window
    plugins.livereload.changed();
  };
  // Starts the server
  plugins.livereload.listen();
  gulp.watch('./src/juzz/*/Resources/components/**/*.jsx', ['app'])
  .on('change', onChange);

  plugins.gutil.log(plugins.gutil.colors.bgGreen('Watching for changes...'));
  
});
