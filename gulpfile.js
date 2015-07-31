var elixir = require('laravel-elixir'),
    gulp = require('gulp'),
    htmlmin = require('gulp-htmlmin');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
elixir.config.sourcemaps = false;

elixir(function(mix) {
    mix.sass('app.scss')
        .scripts([
            'app.js'
        ]);
});

gulp.task('compress', function() {
    var opts = {
        collapseWhitespace: true,
        conservativeCollapse: true,
        removeComments: true,
        removeCommentsFromCDATA: true,
        collapseBooleanAttributes: true,
        useShortDoctype: true,
        removeEmptyAttributes: true,
        removeScriptTypeAttributes: true,
        removeStyleLinkTypeAttributes: true,
        minifyJS: true,
        minifyCSS: true
    };

    return gulp.src('./storage/framework/views/**/*')
        .pipe(htmlmin(opts))
        .pipe(gulp.dest('./storage/framework/views/'));
});