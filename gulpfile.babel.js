'use strict';

import gulp from 'gulp';
import less from 'gulp-less';

const PATHS = {
    less: 'less/',
    dest: 'build/'
};

gulp.task('less', () => {
    gulp.src(`${PATHS.less}**/*.less`)
      .pipe(less())
      .pipe(gulp.dest(`${PATHS.dest}css/`));
});

const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass('app.scss')
       .webpack('app.js');

    mix.version(['js/app.js','css/app.css']);
});
