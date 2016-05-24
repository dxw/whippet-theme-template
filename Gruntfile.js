module.exports = function (grunt) {
  'use strict'

  grunt.loadNpmTasks('grunt-contrib-watch')
  grunt.loadNpmTasks('grunt-contrib-sass')
  grunt.loadNpmTasks('grunt-img')
  grunt.loadNpmTasks('grunt-standard')
  grunt.loadNpmTasks('grunt-modernizr')
  grunt.loadNpmTasks('grunt-browserify')
  grunt.loadNpmTasks('grunt-exorcise')
  grunt.loadNpmTasks('grunt-contrib-copy')
  grunt.loadNpmTasks('grunt-contrib-clean')

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    clean: {
      production: {
        src: [
          'build/'
        ]
      }
    },

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

    modernizr: {
      production: {
        'crawl': false,
        'customTests': [],
        'dest': 'build/lib/modernizr.min.js',
        'tests': [
          'flexbox',
          'svgasimg'
        ],
        'options': [
          'html5printshiv',
          'html5shiv',
          'setClasses'
        ],
        'uglify': true
      }
    },

    browserify: {
      options: {
        browserifyOptions: {
          debug: true
        }
      },
      production: {
        files: {
          'build/main.min.js': 'assets/js/main.js'
        }
      }
    },

    exorcise: {
      production: {
        files: {
          'build/main.min.js.map': 'build/main.min.js'
        }
      }
    },

    copy: {
      production: {
        files: {
          'build/lib/jquery.min.js': 'bower_components/jquery/dist/jquery.min.js'
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
        files: ['assets/js/*.js', 'assets/js/*/*.js'],
        tasks: ['standard', 'browserify', 'exorcise']
      }
    },

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

  // Hack to make `img` task work
  grunt.registerTask('img-mkdir', 'mkdir build/img', function () {
    var fs = require('fs')

    fs.mkdirSync('build')
    fs.mkdirSync('build/img')
  })

  grunt.renameTask('watch', '_watch')

  grunt.registerTask('watch', [
    'default',
    '_watch'
  ])

  grunt.registerTask('default', [
    'clean',
    'bower-install',
    'img-mkdir',
    'img',
    'sass',
    'standard',
    'copy',
    'browserify',
    'exorcise',
    'modernizr'
  ])
}
