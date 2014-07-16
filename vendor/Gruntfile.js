//
// == Installation ==
//
// Install the grunt command-line tool (-g puts it in /usr/local/bin):
// % sudo npm install -g grunt-cli
//
// Install all the packages required to build this:
// (Packages will be installed in ./node_modules - don't accidentally commit this)
// % cd wp-content/themes/theme-name
// % npm install
//
// == Building ==
//
// % grunt
//
// Watch for changes:
// % grunt watch
//
// Compress images (not done by the above tasks):
// % grunt img
//

module.exports = function (grunt) {

    'use strict';

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        //
        // grunt-environment
        //
        // Maintains .grunt/environment, which is used to switch between dev and prod
        // configurations in various tasks, below.
        //

        environment: {
            default: 'development',
            environments: [ 'development', 'production'],
        },


        //
        // grunt-contrib-less
        // Compiles LESS into CSS.
        // TODO: what's the difference between dev and prod?

        less: {
            production: {
                files: {
                    '../templates/assets/main.min.css': [
                        'bower_components/bootstrap/css/bootstrap.min.css',
                        '../assets/less/main.less',
                    ],
                },

                options: {
                    strictUnits: true,
                    compress: true
                },
            },
            development: {
                files: {
                    '../templates/assets/main.min.css': [
                        'bower_components/bootstrap/css/bootstrap.min.css',
                        '../assets/less/main.less',
                    ],
                },

                options: {
                    strictUnits: true,
                    sourceMap: true,
                    dumpLineNumbers: true
                },
            },
        },

        /*,

        uglify: {
            dist: {
                options: {
                    preserveComments: 'some',
                    compress: false,
                    sourceMap: 'build/main.min.js.map',
                    sourceMappingURL: 'main.min.js.map',
                    sourceMapRoot: '../',
                },
                files: {
                    'build/main.min.js': [
                        'bower_components/jquery-ui/ui/jquery.ui.core.js',
                        'bower_components/jquery-ui/ui/jquery.ui.datepicker.js',
                        'assets/js/plugins/*.js',
                        'assets/js/main.js',
                    ],
                },
            },
        },

        copy: {
            dist: {
                files: [
                    {
                        src: [
                            'bower_components/jquery/jquery.min.*',
                            'bower_components/bootstrap/js/dropdown.js',
                            'bower_components/bootstrap/js/carousel.js',
                            'bower_components/bootstrap/js/transition.js',
                            'bower_components/bootstrap/bootstrap/css/bootstrap.min.css',
                            'bower_components/respond/respond.min.js',
                            'bower_components/jquery-ui/themes/base/jquery-ui.css',
                            'bower_components/jquery-ui/themes/base/images/*',
                            'bower_components/date-polyfill/date-polyfill.min.js',
                            'bower_components/jquery-ui/themes/eggplant/jquery-ui.min.css',
                            'bower_components/jquery-ui/themes/eggplant/images/*',
                        ],
                        dest: 'build/',
                    },
                ],
            },
        },

        img: {
            dist: {
                src: 'assets/img',
            },
        },

        _watch: {
            css: {
                files: ['assets/css/** /*.less'],
                tasks: ['less'],
            },
            js: {
                files: ['assets/js/** /*.js'],
                tasks: ['uglify'],
            },
        },
        */
    });

    grunt.loadNpmTasks('grunt-environment');
    grunt.loadNpmTasks('grunt-contrib-less');
    /*grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-img');

    grunt.registerTask('bower-install', 'Installs bower deps', function () {
        var done = this.async(),
            bower = require('bower');

        bower.commands.install().on('end', function () {
            done();
        });
    });

    grunt.renameTask('watch', '_watch');
    grunt.registerTask('watch', [
        'default',
        '_watch',
    ]);
*/
    grunt.registerTask('default', [
        //'bower-install',
     // 'copy',
        'less:' + grunt.environment(),
     // 'uglify',
    ]);

};
