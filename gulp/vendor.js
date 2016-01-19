'use strict';
import gulp from 'gulp';
import gulpPlugins from 'gulp-load-plugins';
const plugins = gulpPlugins({
  rename:{
    'gulp-uglify': 'uglify',
    'gulp-rename': 'rename',
    'gulp-size': 'size',
    'gulp-util': 'gutil'
  },
  scope: 'devDependencies'
});

export const libs = [
  'react',
  'react-dom',
  'react/lib/ReactCSSTransitionGroup',
  'flux'
];

gulp.task('vendor',() => {
	return gulp.src('./gulp/noop.js', {read: false})
    .pipe(plugins.browserify({
      insertGlobals : false,
      debug : false
    }))
    .on('prebundle', (bundle) => {
      libs.forEach((lib) => {
        plugins.gutil.log("Add Vendor Lib : " + lib);
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
