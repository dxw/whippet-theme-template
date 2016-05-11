module.exports = function (grunt) {
  'use strict'

  grunt.loadNpmTasks('grunt-contrib-watch')
  grunt.loadNpmTasks('grunt-contrib-sass')
  grunt.loadNpmTasks('grunt-contrib-uglify')
  grunt.loadNpmTasks('grunt-contrib-copy')
  grunt.loadNpmTasks('grunt-img')
  grunt.loadNpmTasks('grunt-contrib-clean')
  grunt.loadNpmTasks('grunt-standard')

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      production: {
        options: {
          style: 'compressed',
          sourcemap: 'auto'
        },
        files: {
          'build/main.min.css': 'assets/scss/main.scss'
        }
      }
    },

    uglify: {
      production: {
        options: {
          sourceMap: true,
          preserveComments: 'none'
        },
        files: {
          'build/main.min.js': [
            'assets/js/plugins/*.js',
            'assets/js/main.js'
          ],
          'build/lib/modernizr.min.js': [
            'bower_components/modernizr/feature-detects/*.js',
            'bower_components/modernizr/modernizr.js'
          ],
          'build/lib/jquery.min.js': [
            'bower_components/jquery/dist/jquery.js'
          ]
        }
      }
    },

    img: {
      dist: {
        src: 'assets/img',
        dest: 'build/img'
      }
    },

    _watch: {
      less: {
        files: ['assets/scss/*.scss', 'assets/scss/*/*.scss'],
        tasks: ['sass']
      },
      js: {
        files: ['assets/js/main.js', 'assets/js/plugins/*.js'],
        tasks: ['standard', 'uglify']
      }
    },

    clean: ['build/*'],

    standard: {
      production: {
        src: [
          'Gruntfile.js',
          'assets/js/main.js'
        ]
      }
    }
  })

  grunt.registerTask('bower-install', 'Installs bower deps', function () {
    var done = this.async()
    var bower = require('bower')

    bower.commands.install().on('end', function () {
      done()
    })
  })

  grunt.renameTask('watch', '_watch')

  grunt.registerTask('watch', [
    'default',
    '_watch'
  ])

  grunt.registerTask('default', [
    'bower-install',
    'sass',
    'standard',
    'uglify'
  ])
}
