var gulp = require('gulp');
var sass = require('gulp-sass');
var size = require('gulp-size');
var gutil = require('gulp-util');
var autoprefixer = require('gulp-autoprefixer');
var cssmin = require('gulp-cssmin');

var bower_path = "./web/bower_components";

var paths = {
  'bootstrap'  : bower_path + "/bootstrap-sass/assets",
  'flatui'	   : bower_path + "/flat-ui-sass/vendor/assets",
  'bootstrapsocial' : bower_path + "/bootstrap-social",
  'flexbox' : bower_path + "/sass-flex-mixin"
};

gulp.task('sass', function () {
    gulp.src('./app/Resources/public/sass/master.scss')
        .pipe(sass({
        	includePaths: [
    			paths.bootstrap + '/stylesheets',
    			paths.flatui + '/stylesheets',
    			paths.bootstrapsocial,
          paths.flexbox
    		]
        }).on('error', gutil.log))
        .pipe(autoprefixer('last 10 version'))
        .pipe(cssmin({
          keepSpecialComments: 0
        }))
        .pipe(gulp.dest('./web/css'))
        .pipe(size({
			title: 'Stylesheets'
		}))
});