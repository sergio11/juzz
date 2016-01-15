'use strict';
const gulp = require('gulp');
const plugins = require('gulp-load-plugins')({
  rename:{
    'gulp-uglify': 'uglify',
    'gulp-rename': 'rename',
    'gulp-size': 'size'
  },
  scope: 'devDependencies'
});

const libs = [
  'react',
  'react-dom',
  'react/lib/ReactCSSTransitionGroup'
];

gulp.task('vendor', () => {
	return gulp.src('./gulp/noop.js', {read: false})
    .pipe(plugins.browserify({
      insertGlobals : false,
      debug : false
    }))
    .on('prebundle', (bundle) => {
    	libs.forEach((lib) => {
    		console.log("Añadiendo Librería : " + lib);
        	bundle.require(lib);
      	});
    })
    .pipe(plugins.uglify())
    .pipe(plugins.rename('vendor.min.js'))
    .pipe(plugins.size({
    	title:'Vendor Bundle',
    	prettySize:true
    }))
    .pipe(gulp.dest('./web/js'))

});

exports.libs = libs;