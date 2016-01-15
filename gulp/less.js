'use strict';
const gulp = require('gulp');
const plugins = require('gulp-load-plugins')({
  rename:{
    'gulp-less': 'less',
    'gulp-util': 'gutil',
    'gulp-autoprefixer': 'autoprefixer',
    'gulp-cssmin': 'cssmin',
    'gulp-size': 'size'
  },
  scope: 'devDependencies'
});

const bower_path = "./web/bower_components";

const paths = {
  'bootstrap'  : bower_path + "/bootstrap/less",
  'flatui'	   : bower_path + "/flat-ui/less",
  'bootstrapsocial' : bower_path + "/bootstrap-social"
};

gulp.task('less',() =>  {
    gulp.src('./app/Resources/public/less/master.less')
    .pipe(plugins.less({
      paths: [paths.bootstrap,paths.flatui,paths.bootstrapsocial]
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