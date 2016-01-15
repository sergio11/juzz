'use strict';
const gulp = require('gulp');
const glob = require('glob');
const browserify = require('browserify');
const source = require('vinyl-source-stream');
const buffer = require('vinyl-buffer');
const plugins = require('gulp-load-plugins')({
	rename: {
	    'vinyl-source-stream': 'source',
	    'vinyl-buffer': 'buffer',
	    'gulp-uglify' : 'uglify',
	    'gulp-size': 'size'
	},
	scope: 'devDependencies'
});
const merge = require('merge-stream')();
const libs = require('./vendor').libs;

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


const bundles = [
	'./src/juzz/CommentsBundle',
	'./src/juzz/NotificationsBundle'
];

const globalLibs = getNPMPackageBrowser();

gulp.task('app', () => {

  	bundles.map((bundle) => {
	    glob("/Resources/components/**/*.jsx", {root:bundle}, (er, entries) => {

	    	var b = browserify({
	      		entries:entries,
	      		extensions: ['.jsx'], 
	      		debug: true
	      	})
	      	.transform('babelify',{presets: ["es2015", "react"]})
	      	.transform('browserify-shim');

	      	// The following requirements are loaded from the vendor bundle
			libs.forEach((lib) => {
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
		   .pipe(plugins.uglify())
		   .pipe(gulp.dest(bundle+'/Resources/public/js'))
		   .pipe(plugins.size({
			 	title: bundle + " size"
			}));

		   merge.add(task);
  
	    });
  	});

  	// create a merged stream
  	return merge;

});