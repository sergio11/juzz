'use strict';
const gulp = require('gulp');
const imageminJpegtran = require('imagemin-jpegtran');
const imageminPngquant = require('imagemin-pngquant');
const plugins = require('gulp-load-plugins')({
	rename:{
		'gulp-imagemin': 'imagemin',
		'gulp-size': 'size'
	}
});

gulp.task('images', () => {
	return gulp.src('./app/Resources/public/img/**/*')
		.pipe(plugins.imagemin({
			progressive: true,
      		interlaced: true,
			svgoPlugins: [{removeViewBox: false}],
			use: [imageminJpegtran({progressive: true}),imageminPngquant()]
		}))
		.pipe(gulp.dest('./web/img'))
		.pipe(plugins.size({
			title:"Images"
		}));
});