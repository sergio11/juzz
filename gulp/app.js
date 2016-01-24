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

const PATTERN_PATH = "/Resources/components/**/views/**/*.jsx";
const BUNDLES_DEST = "./web/js";
const SOURCEMAPS_DEST = './maps';

//JavaScript Components
const APP_COMPONENTS = {
    commentWall: './src/juzz/CommentsBundle',
    notificationBox: './src/juzz/NotificationsBundle'
}

const pages = [
    {
        name: 'profile',
        components: ['notificationBox', 'commentWall']
    }
]

var getComponentsSources = (components) => {
    return Promise.all(components.map(component => {
        return new Promise((resolve,reject) => {
            glob(PATTERN_PATH, { root: APP_COMPONENTS[component] },(err,entries) => {
                !err ? resolve(entries) : reject(err);   
            });
        }); 
    }));
}


gulp.task('app', () => {

    pages.forEach((page) => {

        plugins.gutil.log("Create Bundle for page : " + page.name);
        plugins.gutil.log("Get Component Sources ");
        getComponentsSources(page.components).then(entries => {
            plugins.gutil.log("Init browserify ");
            var b = browserify({
                entries: entries,
                extensions: ['.jsx'],
                debug: true
            })
                .transform('babelify', { presets: ["es2015", "react"], plugins: ["transform-decorators-legacy"] })
                .transform('browserify-shim');

            // The following requirements are loaded from the vendor bundle
            plugins.gutil.log("Add External Libreries");
            libs.forEach((lib) => {
                b.external(lib);
            });
            //Browserify + Uglify2 with sourcemaps
            var task = b.bundle()
                .pipe(source(page.name + '-bundle.min.js'))
                .pipe(buffer())
                .pipe(plugins.sourcemaps.init({ loadMaps: true }))
                .pipe(plugins.uglify())
                .on('error', plugins.gutil.log)
                .pipe(plugins.sourcemaps.write(SOURCEMAPS_DEST))
                .pipe(gulp.dest(BUNDLES_DEST))
                .pipe(plugins.size({
                    title: page.name + " bundle size"
                }));

            merge.add(task);
        }).catch(err => {
            plugins.gutil.error("Error ");
            plugins.gutil.error(err);
        })

    });
    
    return merge;

});

