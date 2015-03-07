'use strict';

var gulp = require('gulp');

var images = function( source ) {
    var imagemin = require('gulp-imagemin')({
        progressive: true,
        svgoPlugins: [{ removeViewBox: false }]
    });
    var changed = require('gulp-changed');

    return source
        .pipe( changed( 'public/images' ))
        .pipe( imagemin )
        .pipe( gulp.dest( 'public/images' ));
};

gulp.task('images', function() {
    return images( gulp.src( 'resources/assets/images/*'));
});

gulp.task('watch', function() {
    var watch = require('gulp-watch');
    var plumber = require( 'gulp-plumber');

    images( gulp.src( 'resources/assets/images/*' )
            .pipe( watch( 'resources/assets/images/*' ))
            .pipe( plumber() )
    );
});
