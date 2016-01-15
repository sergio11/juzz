'use strict';
const gulp = require('gulp');
const plugins = require('gulp-load-plugins')({
    rename:{
    	'gulp-copy': 'copy',
    	'gulp-size': 'size'
    },
    scope: 'devDependencies'
});

gulp.task('fonts',() => {
    return gulp.src([
    		'./web/bower_components/bootstrap-sass/assets/fonts/bootstrap/*',
    		'./web/bower_components/flat-ui-sass/vendor/assets/fonts/flat-ui/*'
    	])
        .pipe(plugins.copy('./web/fonts', {prefix: 7}))
        .pipe(plugins.size({
        	title: "Fonts"
        }));
});