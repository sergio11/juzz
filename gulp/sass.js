'use strict';
const gulp = require('gulp');
const plugins = require('gulp-load-plugins')({
  rename:{
    'gulp-sass': 'sass',
    'gulp-util': 'gutil',
    'gulp-autoprefixer': 'autoprefixer',
    'gulp-cssmin': 'cssmin',
    'gulp-size': 'size'
  },
  scope: 'devDependencies'
});

const bower_path = "./web/bower_components";

const paths = {
  'bootstrap'  : bower_path + "/bootstrap-sass/assets",
  'flatui'	   : bower_path + "/flat-ui-sass/vendor/assets",
  'bootstrapsocial' : bower_path + "/bootstrap-social",
  'flexbox' : bower_path + "/sass-flex-mixin"
};

gulp.task('sass',() =>  {
    gulp.src('./app/Resources/public/sass/master.scss')
    .pipe(plugins.sass({
      includePaths: [
      	paths.bootstrap + '/stylesheets',
      	paths.flatui + '/stylesheets',
      	paths.bootstrapsocial,
        paths.flexbox
      ]
    }).on('error', plugins.gutil.log))
    .pipe(plugins.autoprefixer('last 10 version'))
    .pipe(plugins.cssmin({
      keepSpecialComments: 0
    }))
    .pipe(gulp.dest('./web/css'))
    .pipe(plugins.size({
			title: 'Stylesheets'
		}))
});