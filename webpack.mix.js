const mix = require('laravel-mix');
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

/*
 |--------------------------------------------------------------------------
 | Core
 |--------------------------------------------------------------------------
 |
 */

mix.scripts([
    'node_modules/jquery/dist/jquery.js',
    'node_modules/pace-progress/pace.js',

], 'public/assets/app/js/app.js').version();

mix.styles([
    'node_modules/font-awesome/css/font-awesome.css',
    'node_modules/pace-progress/themes/blue/pace-theme-minimal.css',
], 'public/assets/app/css/app.css').version();

mix.copy([
    'node_modules/font-awesome/fonts/',
], 'public/assets/app/fonts');

/*
 |--------------------------------------------------------------------------
 | Auth
 |--------------------------------------------------------------------------
 |
 */

mix.styles('resources/assets/auth/css/login.css', 'public/assets/auth/css/login.css').version();
mix.styles('resources/assets/auth/css/register.css', 'public/assets/auth/css/register.css').version();
mix.styles('resources/assets/auth/css/passwords.css', 'public/assets/auth/css/passwords.css').version();

mix.styles([
    'node_modules/bootstrap/dist/css/bootstrap.css',
    'node_modules/gentelella/vendors/animate.css/animate.css',
    'node_modules/gentelella/build/css/custom.css',
], 'public/assets/auth/css/auth.css').version();

/*
 |--------------------------------------------------------------------------
 | Admin
 |--------------------------------------------------------------------------
 |
 */

mix.scripts([
    'node_modules/bootstrap/dist/js/bootstrap.js',
    'node_modules/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js',
    'node_modules/gentelella/vendors/pnotify/dist/pnotify.js',
    'node_modules/gentelella/src/js/helpers/smartresize.js',
    'node_modules/select2/dist/js/select2.full.min.js',
    'node_modules/gentelella/src/js/custom.js',
], 'public/assets/admin/js/admin.js').version();

mix.styles([
    'node_modules/bootstrap/dist/css/bootstrap.css',
    'node_modules/gentelella/vendors/animate.css/animate.css',
    'node_modules/gentelella/vendors/pnotify/dist/pnotify.css',
    'node_modules/select2/dist/css/select2.css',
    'node_modules/gentelella/build/css/custom.css',
], 'public/assets/admin/css/admin.css').version();


mix.copy([
    'node_modules/gentelella/vendors/bootstrap/dist/fonts',
], 'public/assets/admin/fonts');

mix.scripts([
    'node_modules/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js',
    'resources/assets/admin/js/dataTables.checkboxes.min.js',
    'node_modules/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js',
], 'public/assets/admin/js/datatables.js').version();

mix.styles([
    'node_modules/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
    'resources/assets/admin/css/datatable.checkbox.css'
], 'public/assets/admin/css/datatables.css').version();

mix.scripts([
    'resources/assets/admin/js/tickets/index.js',
], 'public/assets/admin/js/tickets/index.js').version();

mix.scripts([
    'node_modules/gentelella/vendors/google-code-prettify/src/prettify.js',
    'node_modules/gentelella/vendors/google-code-prettify/src/run_prettify.js',
    'node_modules/gentelella/vendors/bootstrap-wysiwyg/src/bootstrap-wysiwyg.js',
    'node_modules/gentelella/vendors/switchery/dist/switchery.min.js',
    'resources/assets/admin/js/tickets/create-or-update.js',
], 'public/assets/admin/js/tickets/create-or-update.js').version();

mix.styles([
    'node_modules/gentelella/vendors/switchery/dist/switchery.min.css'
], 'public/assets/admin/css/tickets/create-or-update.css').version();

mix.scripts([
    'resources/assets/admin/js/users/edit.js',
], 'public/assets/admin/js/users/edit.js').version();

mix.styles([
], 'public/assets/admin/css/users/edit.css').version();

mix.scripts([
    'node_modules/gentelella/vendors/Flot/jquery.flot.js',
    'node_modules/gentelella/vendors/Flot/jquery.flot.time.js',
    'node_modules/gentelella/vendors/Flot/jquery.flot.pie.js',
    'node_modules/gentelella/vendors/Flot/jquery.flot.stack.js',
    'node_modules/gentelella/vendors/Flot/jquery.flot.resize.js',

    'node_modules/gentelella/vendors/flot.orderbars/js/jquery.flot.orderBars.js',
    'node_modules/gentelella/vendors/DateJS/build/date.js',
    'node_modules/gentelella/vendors/flot.curvedlines/curvedLines.js',
    'node_modules/gentelella/vendors/flot-spline/js/jquery.flot.spline.min.js',

    'node_modules/gentelella/production/js/moment/moment.min.js',
    'node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.js',


    'node_modules/gentelella/vendors/Chart.js/dist/Chart.js',
    'node_modules/jcarousel/dist/jquery.jcarousel.min.js',

    'resources/assets/admin/js/dashboard.js',
], 'public/assets/admin/js/dashboard.js').version();

mix.styles([
    'node_modules/gentelella/vendors/bootstrap-daterangepicker/daterangepicker.css',
    'resources/assets/admin/css/dashboard.css',
], 'public/assets/admin/css/dashboard.css').version();
