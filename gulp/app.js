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
        'gulp-uglify': 'uglify',
        'gulp-size': 'size',
        'gulp-es6-module-jstransform': 'transform',
        'gulp-sourcemaps': 'sourcemaps',
        'gulp-util': 'gutil'
    },
    scope: 'devDependencies'
});
const merge = require('merge-stream')();
const libs = require('./vendor').libs;

const bundles = [
    './src/juzz/CommentsBundle',
    './src/juzz/NotificationsBundle'
];


gulp.task('app', () => {

    bundles.map((bundle) => {
        glob("/Resources/components/**/views/**/*.jsx", { root: bundle }, (er, entries) => {

            var b = browserify({
                entries: entries,
                extensions: ['.jsx'],
                debug: true
            })
                .transform('babelify', { presets: ["es2015", "react"], plugins: ["transform-decorators-legacy"] })
                .transform('browserify-shim');

            // The following requirements are loaded from the vendor bundle
            libs.forEach((lib) => {
                console.log("Add external library : " + lib);
                b.external(lib);
            });
            //Browserify + Uglify2 with sourcemaps
            var task = b.bundle()
                .pipe(source('bundle.min.js'))
                .pipe(buffer())
                .pipe(plugins.sourcemaps.init({ loadMaps: true }))
                .pipe(plugins.uglify())
                .on('error', plugins.gutil.log)
                .pipe(plugins.sourcemaps.write('/.'))
                .pipe(gulp.dest(bundle + '/Resources/public/js'))
                .pipe(plugins.size({
                    title: bundle + " size"
                }));

            merge.add(task);

        });
    });

    // create a merged stream
    return merge;

});