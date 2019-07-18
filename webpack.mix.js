const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/vendor/js');
mix.copyDirectory('node_modules/iview/dist/styles/', 'public/vendor/css');
mix.copyDirectory('resources/images', 'public/vendor/images');
mix.extract(['vue', 'axios']);
mix.webpackConfig({
    output: {
        filename: '[name].js',
        chunkFilename: mix.inProduction() ? 'vendor/js/[name].chunk.js' : 'vendor/js/[name].chunk.js'
    }
});
mix.options({
    postCss: [
        require('autoprefixer'),
    ],
})
if (mix.inProduction()) {
    mix.version();
}
