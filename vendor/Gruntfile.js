module.exports = function (grunt) {
    'use strict';

    grunt.loadTasks('tasks');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-img');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-clean');
    //grunt.loadNpmTasks('grunt-phpmd');


    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        sass: {
          '': 'development',

          development: {
            options: {
              style: 'expanded',
              sourcemap: 'auto',
              trace: true,
              debugInfo: true,
              lineNumbers: true
            },
            files: {
              'main.css': 'main.scss'
            }
          },

          production: {
            options: {
              style: 'compressed',
              sourcemap: 'none',
            },
            files: {
              'main.css': '../assets/scss/main.scss'
            }
          }
        },

        uglify: {
           '': 'development',

           production: {
               options: {
                   preserveComments: 'none'
               },
               files: {
                   '../templates/assets/main.min.js': [
                       '../assets/js/plugins/*.js',
                       '../assets/js/main.js'
                   ],
                   '../templates/assets/lib/modernizr.min.js': [
                       'bower_components/modernizr/feature-detects/*.js',
                       'bower_components/modernizr/modernizr.js'
                   ],
                    '../templates/assets/lib/jquery.min.js': [
                       'bower_components/jquery/jquery.js'
                   ]
               }
           },
           development: {
               options: {
                   preserveComments: 'all',
                   compress: false,
                   beautify: true,
                   sourceMap: true
               },
               files: {
                   '../templates/assets/main.min.js': [
                       '../assets/js/plugins/*.js',
                       '../assets/js/main.js'
                   ],
                   '../templates/assets/lib/modernizr.min.js': [
                       'bower_components/modernizr/feature-detects/*.js',
                       'bower_components/modernizr/modernizr.js'
                   ],
                    '../templates/assets/lib/jquery.min.js': [
                       'bower_components/jquery/jquery.js'
                   ]
               }
           }
       },

        img: {
            dist: {
                src: '../assets/img',
                dest: '../templates/assets/img'
            }
        },

        _watch: {
            less: {
                files: ['../assets/scss/*.scss', '../assets/scss/*/*.scss'],
                tasks: ['sass']
            },
            js: {
                files: ['../assets/js/main.js', '../assets/js/plugins/*.js'],
                tasks: ['jshint', 'uglify']
            }
        },

        // TODO: because Grunt's working dir is vendor, clean refuses to do this unless you say --force
        // I am not specifying force option here, because dragons
        clean: ['../templates/assets/*'],

        /*phpmd: {
          '': 'development',

          options: {
            rulesets: 'codesize,unusedcode,naming',
            bin: '~/Projects/tools/phpmd/src/bin/phpmd',
            reportFormat: 'text'
          },

          development: {
            dir: "../"
          }
        },*/

        jshint: {
          '': 'development',

          options: {
            bitwise: true,
            curly: true,
            es3: true,
            latedef: true,
            noarg: true,
            nonbsp: true,
            nonew: true,
            undef: true,
            unused: true,

            browser: true,
            jquery: true,
            node: true
          },

          development: {
            files: {
              src: ['Gruntfile.js', '../assets/js/main.js', '../assets/js/plugins/*.js']
            },
            options: {
              devel: true
            }
          },

          production: {
            files: {
              src: ['Gruntfile.js', '../assets/js/main.js', '../assets/js/plugins/*.js']
            },
            options: {
              devel: false
            }
          }
        }
    });

    var env = grunt.option('env') || 'development';

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
        '_watch'
    ]);

    grunt.registerTask('default', [
        'bower-install',
        'sass:' + env,
        'uglify:'+ env
    ]);
};