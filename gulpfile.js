var gulp = require('gulp'),
   sass = require('gulp-sass'),
   cmq = require('gulp-combine-media-queries');
   browserSync = require('browser-sync').create();

var paths = {
    sass: ['sass/**/*.scss']
}

gulp.task('serve', ['sass'], function() {

    browserSync.init({
        proxy: 'mcm.craft.dev'
    });

    gulp.watch("sass/**/*.scss", ['sass']);
    gulp.watch("app/*.html").on('change', browserSync.reload);
});

gulp.task('sass', function () {
   return gulp.src(paths.sass)
       .pipe(sass({errLogToConsole: true}))
       .pipe(gulp.dest('htdocs/assets/css'))
       .pipe(browserSync.stream())

});

gulp.task('default', ['serve']);
