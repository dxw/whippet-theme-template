module.exports = function (grunt) {
  'use strict'

  grunt.loadTasks('lib/tasks')
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
          'templates/assets/main.min.css': 'assets/scss/main.scss'
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
          'templates/assets/main.min.js': [
            'assets/js/plugins/*.js',
            'assets/js/main.js'
          ],
          'templates/assets/lib/modernizr.min.js': [
            'bower_components/modernizr/feature-detects/*.js',
            'bower_components/modernizr/modernizr.js'
          ],
          'templates/assets/lib/jquery.min.js': [
            'bower_components/jquery/dist/jquery.js'
          ]
        }
      }
    },

    img: {
      dist: {
        src: 'assets/img',
        dest: 'templates/assets/img'
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

    clean: ['templates/assets/*'],

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
