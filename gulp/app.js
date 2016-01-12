'use strict';
var gulp = require('gulp');
var browserify = require('browserify')  
var babelify = require('babelify')  
var source = require('vinyl-source-stream')  
var libs = require('./vendor').libs;
var uglify = require('gulp-uglify');
var merge = require('merge-stream')();
var buffer = require('vinyl-buffer');
var glob = require("glob");
var size = require('gulp-size');

// function to fetch the 'browserify-shim' json field from the package.json file
function getNPMPackageBrowser() {
  // read package.json and get dependencies' package ids
  var packageManifest = {};
  try {
    packageManifest = require('./package.json');
  } catch (e) {
    // does not have a package.json manifest
  }
  return packageManifest['browserify-shim'] || {};
}

var globalLibs = getNPMPackageBrowser();


gulp.task('app', function() {

	var bundles = [
	    './src/juzz/CommentsBundle',
	    './src/juzz/NotificationsBundle'
  	];

  	bundles.map(function(bundle){
	    glob("/Resources/components/**/*.jsx", {root:bundle}, function (er, entries) {

	    	var b = browserify({
	      		entries:entries,
	      		extensions: ['.jsx'], 
	      		debug: true
	      	})
	      	.transform('babelify',{presets: ["es2015", "react"]})
	      	.transform('browserify-shim');

	      	// The following requirements are loaded from the vendor bundle
			libs.forEach(function(lib) {
			    console.log("Add external library : " + lib);
			    b.external(lib);
			});
	      	

	      	for (globalLib in globalLibs) {
			    if (globalLibs.hasOwnProperty(globalLib)) {
			      b.require(globalLib);
			    }
			}

			
		   var task =  b.bundle()
		   .pipe(source('bundle.min.js'))
		   .pipe(buffer())
		   .pipe(uglify())
		   .pipe(gulp.dest(bundle+'/Resources/public/js'))
		   .pipe(size({
			 	title: bundle + " size"
			}));

		   merge.add(task);
  
	    });
  	});

  	// create a merged stream
  	return merge;

});