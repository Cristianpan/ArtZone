const { src, dest, watch, parallel, task } = require("gulp");
const rename = require("gulp-rename");
const plumber = require("gulp-plumber");

//Css
const sass = require("gulp-sass")(require("sass"));
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const postcss = require("gulp-postcss");
const sourcemaps = require("gulp-sourcemaps");
const del = require("del");

// JS
const webpack = require("webpack-stream");
const named = require("vinyl-named");

//Browsersync
const browserSync = require("browser-sync").create();

//PATHS
const inputPaths = {
  sass: `./src/sass/**/*.scss`,
  js: `./src/js/**/*.js`,
};

const outputPaths = {
  css: `./public/assets/css`,
  js: `./public/assets/js`,
};

function serve() {
  browserSync.init({
    proxy: "http://localhost:8080",
    port: 3000,
    host: "192.168.1.5",
    notify: true,
    serveStaticOptions: {
      cacheControl: false,
    },
  });
  browserSync
    .watch([
      "public/**/css/*.css", 
      "public/**/js/*.js", 
      "app/Views/**/*.*",
    ])
    .on("change", browserSync.reload);
}

// CSS
async function compileSass(isProduction = false) {
  const { sass: inputPath } = inputPaths;
  const { css: outputPath } = outputPaths;
  if (isProduction) {
    await del(outputPath);
    return src(inputPath)
      .pipe(sass())
      .pipe(postcss([autoprefixer(), cssnano()]))
      .pipe(rename({ dirname: ".", suffix: ".min" }))
      .pipe(dest(outputPath));
  } else {
    return src(inputPath)
      .pipe(plumber())
      .pipe(sourcemaps.init())
      .pipe(sass())
      .pipe(postcss([autoprefixer(), cssnano()]))
      .pipe(rename({ dirname: ".", suffix: ".min" }))
      .pipe(sourcemaps.write("."))
      .pipe(dest(outputPath));
  }
}
// ------------------------------------------------------------------- //

// JS
// ------------------------------------------------------------------- //

async function compileJavascript(isProduction = false) {
  const webpackConfig = {
    mode: isProduction ? "production" : "development",
    output: { filename: "[name].min.js" },
  };
  const { js: inputPath } = inputPaths;
  const { js: outputPath } = outputPaths;
  if (isProduction) {
    await del(outputPath);
    return src(inputPath)
      .pipe(named())
      .pipe(webpack(webpackConfig))
      .pipe(rename({ dirname: "." }))
      .pipe(dest(outputPath));
  } else {
    webpackConfig["devtool"] = "source-map";
    return src(inputPath)
      .pipe(plumber())
      .pipe(named())
      .pipe(webpack(webpackConfig))
      .pipe(rename({ dirname: "." }))
      .pipe(dest(outputPath));
  }
}
// ------------------------------------------------------------------- //

// DELETE FILE
// ------------------------------------------------------------------- //
async function clean(filepath = "") {
  return await del(filepath);
}
// ------------------------------------------------------------------- //

// WATCHERS
// ------------------------------------------------------------------- //
function watchFiles() {
  // CSS
  const { sass: inputCss, js: inputJs } = inputPaths;
  const { css: outputCss, js: outputJs } = outputPaths;
  watch(inputCss, async function () {
    await compileSass();
  });
  watch(inputCss).on("unlink", async function (path, stats) {
    const deletedFiles = await clean(path, outputCss);
    deletedFiles.forEach((file) => console.log(`Deleted ${file}`));
  });

  // JS
  watch(inputJs, async function () {
    await compileJavascript();
  });
  watch(inputJs).on("unlink", async function (path, stats) {
    const deletedFiles = await clean(path, outputJs);
    deletedFiles.forEach((file) => console.log(`Deleted ${file}`));
  });
}

function compileAssets(isProduction = false) {
  return async function devTasks() {
    await compileSass(isProduction);
    await compileJavascript(isProduction);
    if (!isProduction) {
      watchFiles();
    }
  };
}

task("dev", parallel(compileAssets(), serve));
task("build", compileAssets(true));
