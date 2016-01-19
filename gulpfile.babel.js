'use strict';
import gulp from 'gulp';
import app from './gulp/app';
import watch from './gulp/watch';
import less from './gulp/less';
import fonts from './gulp/fonts';
import images from './gulp/images';

gulp.task('build', [
  'app',
  'vendor',
  'less',
  'fonts',
  'images'
]);

gulp.task('default', ['build'],() => {
	return gulp.start('watch');
});

/*npm install babel-preset-react
  npm install babel-preset-es2015 --save-dev*/
