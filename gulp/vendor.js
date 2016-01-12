'use strict';
var gulp = require('gulp');
var browserify = require('gulp-browserify')  
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var size = require('gulp-size');

var libs = [
  'react',
  'react/lib/ReactCSSTransitionGroup'
];

gulp.task('vendor', function() {
	return gulp.src('./gulp/noop.js', {read: false})
    .pipe(browserify({
      insertGlobals : false,
      debug : false
    }))
    .on('prebundle', function(bundle) {
    	libs.forEach(function(lib) {
    		console.log("Añadiendo Librería : " + lib);
        	bundle.require(lib);
      	});
    })
    .pipe(uglify())
    .pipe(rename('vendor.min.js'))
    .pipe(size({
    	title:'Vendor Bundle',
    	prettySize:true
    }))
    .pipe(gulp.dest('./web/js'))

});

exports.libs = libs;