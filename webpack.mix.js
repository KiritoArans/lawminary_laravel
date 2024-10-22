let mix = require('laravel-mix');

mix.js('resources/js/commentBroadcast.js', 'public/js')
    .js('resources/js/replyBroadcast.js', 'public/js') // Include replyBroadcast.js
    .sass('resources/sass/app.scss', 'public/css')
    .vue()
    .options({
        processCssUrls: false
    })
    .sourceMaps()
    .version()
    .extract(['vue', 'axios'])
    .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery'],
    });

mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
});
