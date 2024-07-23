// Imports
const {
  src,
  dest,
  watch,
  series,
  parallel
} = require('gulp');
const touch = require('gulp-touch-fd');
const sass = require('gulp-sass');
const sassGlob = require('gulp-sass-glob');
const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const gulpif = require('gulp-if');
const sourcemaps = require('gulp-sourcemaps');
const include = require("gulp-include");
const uglify = require('gulp-uglify-es').default;
const eslint = require('gulp-eslint');
const cache = require('gulp-cache');
const imagemin = require('gulp-imagemin');
const browserSync = require('browser-sync').create();
const fs = require('fs');
const htmlInjector = require("bs-html-injector");
const tailwindcss = require('tailwindcss');
const prefixWrap = require("postcss-prefixwrap");
const postcssColorMod = require('postcss-color-mod-function');
const webpack = require('webpack-stream');

// Setup enviroment variables
var envType = process.env.NODE_ENV;
try {
  var options = require('./options.js');
  // Local enviroment setup override
  var isStatic = options.isStatic;
  var isWP = options.isWP;
  var templateNameWP = options.templateNameWP;
} catch (err) {
  // Default enviroment setup (in most cases for deployment)
  var isStatic = false; // Static website
  var isWP = true; // WordPress Project
  var templateNameWP = 'starter_theme';
}

// Local server
function server(done) {
  // Run server
  if (isStatic) {
    browserSync.use(htmlInjector, {
      files: "./static/*.html"
    });
    browserSync.init({
      server: {
        baseDir: "./static"
      }
    });
  } else {
    browserSync.use(htmlInjector, {
      files: "wordpress/**/*.php"
    });
    browserSync.init({
      proxy: options.serverLink
    });
  }
  done(); // Signal completion
}

// Reload the browser when files change
function reloadBrowser(done) {
  console.log("\n\t Reloading Browser Preview.\n");
  browserSync.reload();
  done();
}

// Compile HTML
function html() {
  return src('src-static/*.html')
    .pipe(include()).on('error', console.log)
    .pipe(gulpif(isStatic, dest('./static')))
}

// Compile styles
function styles() {
  return src(['src-assets/sass-global/main.sass'])
    .pipe(gulpif(envType == 'development', sourcemaps.init({
      loadMaps: true
    })))
    .pipe(sassGlob())
    .pipe(sass())
    .on("error", sass.logError)
    .pipe(dest('src-assets/sass-global'))
    .pipe(gulpif(envType == 'development', sourcemaps.init({
      loadMaps: true
    })))
    .pipe(
      postcss([
        tailwindcss(),
        postcssColorMod(),
        require('postcss-viewport-height-correction'),
      ])
    )
    .pipe(gulpif(envType == 'production',
      postcss([
        autoprefixer(),
        cssnano()
      ]),
    ))
    .pipe(gulpif(envType == 'development', sourcemaps.write()))
    .pipe(gulpif(isStatic, dest('./static/assets/css')))
    .pipe(gulpif(isWP, dest('./wordpress/themes/' + templateNameWP + '/assets/css')))
    .pipe(touch())
    .pipe(browserSync.stream({
      match: '**/*.css'
    }));
}

function stylesAdminACFBlocks() {
  return src(['src-assets/sass-global/admin-acf-blocks.sass'])
    .pipe(gulpif(envType == 'development', sourcemaps.init({
      loadMaps: true
    })))
    .pipe(sassGlob())
    .pipe(sass())
    .on("error", sass.logError)
    .pipe(dest('src-assets/sass-global'))
    .pipe(
      postcss([
        tailwindcss(),
        postcssColorMod(),
        require('postcss-viewport-height-correction'),
        prefixWrap(".acf-block-preview"),
      ])
    )
    .pipe(gulpif(envType == 'production',
      postcss([
        autoprefixer(),
        cssnano()
      ]),
    ))
    .pipe(gulpif(envType == 'development', sourcemaps.write('.')))
    .pipe(gulpif(isWP, dest('./wordpress/themes/' + templateNameWP + '/assets/css')))
    .pipe(touch())
    .pipe(browserSync.stream({
      match: '**/*.css'
    }));
}

// Compile separate styles
function styles_separate() {
  return src(['src-assets/sass-separate-files/**/*.+(sass|scss)'])
    .pipe(gulpif(envType == 'development', sourcemaps.init({
      loadMaps: true
    })))
    .pipe(sassGlob())
    .pipe(sass())
    .on("error", sass.logError)
    .pipe(dest('src-assets/sass-separate-files'))
    .pipe(gulpif(envType == 'development', sourcemaps.init({
      loadMaps: true
    })))
    .pipe(
      postcss([
        tailwindcss(),
        postcssColorMod(),
        require('postcss-viewport-height-correction'),
      ])
    )
    .pipe(gulpif(envType == 'production',
      postcss([
        autoprefixer(),
        cssnano()
      ]),
    ))
    .pipe(gulpif(envType == 'development', sourcemaps.write()))
    .pipe(gulpif(isStatic, dest('./static/assets/css')))
    .pipe(gulpif(isWP, dest('./wordpress/themes/' + templateNameWP + '/assets/css')))
    .pipe(touch())
    .pipe(browserSync.stream({
      match: '**/*.css'
    }));
}

function stylesAdminGlobal() {
  return src(['src-assets/sass-global/admin-global.sass', 'src-assets/sass-global/editor-styles.scss'])
    .pipe(sassGlob())
    .pipe(sass()).on("error", sass.logError)
    .pipe(postcss([
      postcssColorMod(),
      autoprefixer(),
      cssnano()
    ]))
    .pipe(gulpif(isWP, dest('./wordpress/themes/' + templateNameWP + '/assets/css')))
    .pipe(touch());
}

// Generating scripts
// function scripts() {
//   return src(['src-assets/js-global/main.js', 'src-assets/js-global/onload.js', 'src-assets/js-separate-files/**/*.js'])
//     .pipe(gulpif(envType == 'development', sourcemaps.init({ loadMaps: true })))
//     .pipe(include()).on('error', console.log)
//     .pipe(gulpif(envType == 'production', uglify() ))
//     .pipe(gulpif(envType == 'development', sourcemaps.write('.') ))
//     .pipe(gulpif(isStatic,dest('./static/assets/js')))
//     .pipe(gulpif(isWP,dest('./wordpress/themes/' + templateNameWP + '/assets/js')))
//     .pipe(touch());
// }

function scripts() {
  return src('src-assets/js-separate-files/scripts.js')
    .pipe(
      webpack({
        watch: false,
        mode: 'development',
      })
    )
    .pipe(gulpif(isStatic, dest('./static/assets/js')))
    .pipe(gulpif(isWP, dest('./wordpress/themes/' + templateNameWP + '/assets/js')))
};

function scriptsProd() {
  return src('src-assets/js-separate-files/scripts.js')
    .pipe(
      webpack({
        watch: false,
        mode: 'production',
        // optimization: {
        //     runtimeChunk: 'single',
        // },
      })
    )
    .pipe(gulpif(isStatic, dest('./static/assets/js')))
    .pipe(gulpif(isWP, dest('./wordpress/themes/' + templateNameWP + '/assets/js')))
};

// Copy fonts to appropriate folder
function fonts() {
  return src(['src-assets/fonts/**/*.*'])
    .pipe(gulpif(isStatic, dest('./static/assets/fonts')))
    .pipe(gulpif(isWP, dest('./wordpress/themes/' + templateNameWP + '/assets/fonts')));
}

// Copy fontawesome svg
function fontawesomesvg() {
  return src(['node_modules/@fortawesome/fontawesome-free/svgs/**/*.*'])
    .pipe(gulpif(isStatic, dest('./static/assets/fontawesome-svg')))
    .pipe(gulpif(isWP, dest('./wordpress/themes/' + templateNameWP + '/assets/fontawesome-svg')));
}

// Optimize all images
function images() {
  return src('src-assets/img/**/*')
    .pipe(cache(imagemin([
      // svg
      imagemin.svgo({
        plugins: [{
            removeViewBox: false
          },
          {
            cleanupIDs: true
          }
        ]
      }),
    ])))
    .pipe(gulpif(isStatic, dest('./static/assets/img')))
    .pipe(gulpif(isWP, dest('./wordpress/themes/' + templateNameWP + '/assets/img')));
}

// Watch for changes
function watchSource() {
  watch('src-assets/sass-global/**/*.+(sass|scss)', series(styles));
  watch(['src-assets/sass-separate-files/**/*.+(sass|scss)'], series(styles_separate));
  watch(['src-static/**/*.html'], series(html));
  watch(['wordpress/themes/starter_theme/**/*.php', 'src-static/**/*.html'], series(styles));
  watch('tailwind.config.js', series(styles));
  watch('src-assets/sass/admin-acf-blocks.sass', series(stylesAdminACFBlocks));
  watch(['src-assets/sass/admin-global.sass', 'src-assets/sass/editor-styles.scss'], series(stylesAdminGlobal));
  watch('src-static/**/*.html', series(htmlInjector));
  watch(['src-assets/js-separate-files/**/*.js', 'src-assets/js-global/main.js', 'src-assets/js-global/onload.js'], series(scripts, reloadBrowser));
  watch('src-assets/fonts/**/*.*', series(fonts, reloadBrowser));
  watch('src-assets/img/**/*.+(png|jpg|jpeg|gif|svg)', series(images));
  console.log("\n\t Watching for Changes..\n");
};

// Basic tasks
exports.basic = series(
  parallel(
    html,
    styles,
    styles_separate,
    stylesAdminACFBlocks,
    stylesAdminGlobal,
    scripts,
    fonts,
    // fontawesomesvg,
    images
  )
);

// Tasks for compiling project on CI/CD
exports.build = series(
  parallel(
    html,
    styles,
    styles_separate,
    stylesAdminACFBlocks,
    stylesAdminGlobal,
    scriptsProd,
    fonts,
    // fontawesomesvg,
    images
  )
);
// Alternative name for the deployment task group
exports.deploy = series(
  exports.build
);

// Basic + Browser Sync + Watch
// Development tasks
exports.default = series(
  exports.basic,
  server,
  watchSource
);
