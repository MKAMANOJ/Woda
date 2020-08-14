const {mix} = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.options({processCssUrls: false})
  .autoload({
    jquery: ['$', 'window.jQuery']
  })
  .sass('resources/assets/admin/sass/app.scss', 'public/admin/css')
  .sass('resources/assets/admin/sass/abs.scss', 'public/admin/css/abs.css')
  .sass('resources/assets/frontend/sass/custom.scss', 'public/frontend/css/custom.css')
  .js('resources/assets/frontend/js/profile.js', 'public/frontend/js/profile.js')
  .js('resources/assets/client/js/schedule_movement.js', 'public/frontend/js/schedule.js')
  .js('resources/finder/js/quote-warehouse.js', 'public/finder/js/warehouse.js')
  .js('resources/finder/js/create-quote.js', 'public/finder/js/create-quote.js')
  .js('resources/finder/js/edit-quote.js', 'public/finder/js/edit-quote.js')
  .js('resources/assets/client/js/quote.js', 'public/client/js/quote.js')
  .js('resources/assets/frontend/js/warehouse/search-warehouse.js', 'public/frontend/js/search-warehouse.js')
  .js('resources/assets/frontend/js/warehouse/list-warehouse.js', 'public/frontend/js/list-warehouse.js')
  .js('resources/finder/js/warehouse-list.js', 'public/frontend/js/warehouse-list.js');
