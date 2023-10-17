const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */

    .addEntry('app', './assets/app.js')

    .addEntry('font-awesome', './assets/sb-admin-2/vendor/fontawesome-free/css/all.min.css')
    
    .addEntry('jquery-min-js', './assets/sb-admin-2/vendor/jquery/jquery.min.js')
    .addEntry('bootstrap-bundle-min-js', './assets/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js')
    
    .addEntry('jquery-easing-js', './assets/sb-admin-2/vendor/jquery-easing/jquery.easing.min.js')
    
    .addEntry('sb-admin-css', './assets/sb-admin-2/css/sb-admin-2.min.css')
    .addEntry('sb-admin-js', './assets/sb-admin-2/js/sb-admin-2.min.js')
    .addEntry('jquery-datatable-min-js', './assets/sb-admin-2/vendor/datatables/jquery.dataTables.min.js')
    .addEntry('datatable-bootstrap4-min-js', './assets/sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.js')
    
    .addEntry('datatable-bootstrap4-min-css', './assets/sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.css')
    
    // enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
    .enableStimulusBridge('./assets/controllers.json')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    //.configureBabel((config) => {
      //  config.plugins.push('@babel/plugin-proposal-class-properties');
    //})

    // enables @babel/preset-env polyfills
    //.configureBabelPresetEnv((config) => {
     //   config.useBuiltIns = 'usage';
     //   config.corejs = 3;
    //})

    // enables Sass/SCSS support
    .enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you use React
    //.enableReactPreset()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
