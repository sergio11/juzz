const gulp = require('gulp');
const imagemin = require('gulp-imagemin');
const imageminJpegtran = require('imagemin-jpegtran');
const imageminPngquant = require('imagemin-pngquant');
const size = require('gulp-size');

gulp.task('images', () => {
	return gulp.src('./app/Resources/public/img/*')
		.pipe(imagemin({
			progressive: true,
      		interlaced: true,
			svgoPlugins: [{removeViewBox: false}],
			use: [imageminJpegtran({progressive: true}),imageminPngquant()]
		}))
		.pipe(gulp.dest('./web/img'))
		.pipe(size({
			title:"Images"
		}));
});