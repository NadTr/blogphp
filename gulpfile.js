const gulp = require('gulp');
const sass = require('gulp-sass');

var phpServ;
var composeUp;

function dev(callback){
  gulp.watch(['src/scss/*.scss'], {ignoreInitial: false}, buildSass);
}

function buildSass() {
  return gulp.src('src/scss/*.scss')
    .pipe(sass())
    .pipe(gulp.dest('public/css'));
}

exports.default = dev;
exports.sass = buildSass;
