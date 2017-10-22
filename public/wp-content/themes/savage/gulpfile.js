var assign = require( 'lodash.assign' );
var	autoprefixer = require( 'autoprefixer' );
var	babel = require( 'babelify' );
var	browserify = require( 'browserify' );
var	buffer = require( 'vinyl-buffer' );
var cssnano = require( 'gulp-cssnano' );
var	gulp = require( 'gulp' );
var	gutil = require( 'gulp-util' );
var importCss = require( 'postcss-import' );
var	livereload = require( 'gulp-livereload' );
var	notify = require( 'gulp-notify' );
var	postcss = require( 'gulp-postcss' );
var	rename = require( 'gulp-rename' );
var	sass = require( 'gulp-sass' );
var	sassGlob = require( 'gulp-sass-glob' );
var	source = require( 'vinyl-source-stream' );
var	sourcemaps = require( 'gulp-sourcemaps' );
var uglify = require( 'gulp-uglify' );
var	watch = require( 'gulp-watch' );
var	watchify = require( 'watchify' );

// Custom browserify options

var config = {
		themePath: './',
		npmPath: '../../../node_modules'
	},
	customOpts = {
		entries: [ config.themePath + '/js/main.js' ],
		debug: true
	},
	opts = assign( {}, watchify.args, customOpts ),
	bundle = watchify( browserify( opts ).transform( babel, { presets: ['es2015'] } ), { poll: 100 } )
;

gulp.task( 'bundle', function () {

    return bundle.bundle()
        .on( 'error', notify.onError( function ( error ) {
            return 'Error ' + error.message;
        } ) )
        .pipe( source( 'site.js' ) )
        .pipe( buffer() )
        .pipe( sourcemaps.init( { loadMaps: true } ) )
        .pipe( uglify() )
        .pipe( sourcemaps.write( './' ) )
        .pipe( gulp.dest( config.themePath + '/assets/js' ) )
        .pipe( livereload() );

} );

gulp.task( 'sass', function () {
    return gulp.src( config.themePath + '/scss/main.scss' )
        .pipe( sourcemaps.init() )
        .pipe( sassGlob() )
        .pipe( sass( {
            includePaths: [
                config.npmPath,
                config.npmPath + '/bootstrap/scss/'
            ]
        } ) )
        .pipe( postcss( [
            importCss(),
            autoprefixer( {
                browsers: [
                    'iOS >= 8',
                    'Android >= 4',
                    'Safari >= 9',
                    'Firefox >= 41',
                    'Chrome >= 46',
                    'Explorer >= 9'
                ]
            } )
        ] ) )
        .on( 'error', notify.onError( function ( error ) {
            return 'Error ' + error.message;
        } ) )
        .pipe( sourcemaps.write() )
        .pipe( rename( 'site.css' ) )
        .pipe( gulp.dest( config.themePath + '/assets/css' ) )
        .pipe( cssnano( {
            discardComments: {
                removeAll: true
            }
        } ) )
        .pipe( rename( 'site.min.css' ) )
        .pipe( gulp.dest( config.themePath + '/assets/css' ) )
        .pipe( livereload() );

} );

gulp.task( 'watch', function () {
    livereload.listen( { quiet: true } );
    gulp.watch( [
        config.themePath + '/js/main.js',
        config.themePath + '/js/**/*.js'
    ], [
        'bundle'
    ] );

    gulp.watch( [
        config.themePath + '/scss/**/*.scss'
    ], [
        'sass'
    ] );
} );

gulp.task( 'default', [ 'bundle', 'sass', 'watch' ] );