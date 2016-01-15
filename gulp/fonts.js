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
    		'./web/bower_components/bootstrap/dist/fonts/*',
    		'./web/bower_components/flat-ui/dist/fonts/**/*'
    	])
        .pipe(plugins.copy('./web/fonts', {prefix: 7}))
        .pipe(plugins.size({
        	title: "Fonts"
        }));
});