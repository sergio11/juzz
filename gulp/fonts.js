var gulp = require('gulp');
var copy = require('gulp-copy');
var size = require('gulp-size');

gulp.task('fonts', function () {
    return gulp.src([
    		'./web/bower_components/bootstrap-sass/assets/fonts/bootstrap/*',
    		'./web/bower_components/flat-ui-sass/vendor/assets/fonts/flat-ui/*'
    	])
        .pipe(copy('./web/fonts', {prefix: 7}))
        .pipe(size({
        	title: "Fonts"
        }));
});