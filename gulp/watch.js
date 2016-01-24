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
  // Starts the server
  plugins.livereload.listen();
  plugins.gutil.log("Start Watch for ReactJS components");
  gulp.watch('./src/juzz/*/Resources/components/**/views/**/*.jsx', ['app']).on('change',(event) => {
      plugins.gutil.log(plugins.gutil.colors.bgGreen('File '+event.path+' has been '+event.type));
  })

  plugins.gutil.log(plugins.gutil.colors.bgGreen('Watching for changes...'));
  
});
