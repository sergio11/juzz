'use strict';
var gulp = require('gulp');

require('./gulp/app');
require('./gulp/vendor');
require('./gulp/watch');
require('./gulp/sass');
require('./gulp/fonts');
require('./gulp/images');

gulp.task('build', [
  'app',
  'vendor',
  'sass',
  'fonts',
  'images'
]);

gulp.task('default', ['build'],function(){
	return gulp.start('watch');
});

/*npm install babel-preset-react
  npm install babel-preset-es2015 --save-dev*/
