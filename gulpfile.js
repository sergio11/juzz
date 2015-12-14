'use strict';

/*npm install babel-preset-react
  npm install babel-preset-es2015 --save-dev*/

var gulp = require('gulp')  
var browserify = require('browserify')  
var babelify = require('babelify')  
var source = require('vinyl-source-stream')  
var nib = require('nib')  
var minify = require('gulp-minify-css')
var glob = require("glob")
var es  = require('event-stream');
var buffer = require('vinyl-buffer')
var uglify = require('gulp-uglify')
var shell = require('gulp-shell')


gulp.task('build', function() {

  var tasks = [],bundles = [
    './src/juzz/CommentsBundle'
  ];

  bundles.map(function(bundle){
    glob("/Resources/components/**/*.jsx", {root:bundle}, function (er, entries) {
      tasks.push(browserify({entries:entries, extensions: ['.jsx'], debug: true})
        .transform('babelify',{presets: ["es2015", "react"]})
        .bundle()
        .pipe(source('bundle.min.js'))
        .pipe(buffer())
        .pipe(uglify())
        .pipe(gulp.dest(bundle+'/Resources/public/js'))
        .pipe(shell([
          'php app/console assets:install',
          'php app/console cache:clear'
        ])))
        
    });
  });

  // create a merged stream
  return es.merge.apply(null, tasks);

});


gulp.task('watch', function() {  
  gulp.watch('./src/**/*.jsx', ['build'])
  gulp.watch(['./src/styles/**/*.styl', './src/components/**/*.styl'], ['stylus'])
})

gulp.task('default', ['watch'])