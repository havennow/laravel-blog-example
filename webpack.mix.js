let mix = require('laravel-mix');


mix.js('resources/assets/js/bootstrap.js', 'public/js')
    .js('resources/assets/js/components/posts/app.js', 'public/js/posts.js')
    .js('resources/assets/js/components/posts/create.js', 'public/js/posts-create.js')
    .js('resources/assets/js/components/posts/edit.js', 'public/js/posts-edit.js')
    .extract(['vue', 'moment'])
    .sass('resources/assets/sass/app.scss', 'public/css');
