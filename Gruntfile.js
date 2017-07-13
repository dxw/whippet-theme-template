module.exports = function (grunt) {
  'use strict'

  grunt.loadNpmTasks('grunt-contrib-watch')
  grunt.loadNpmTasks('grunt-sass')
  grunt.loadNpmTasks('grunt-img')
  grunt.loadNpmTasks('grunt-standard')
  grunt.loadNpmTasks('grunt-modernizr')
  grunt.loadNpmTasks('grunt-browserify')
  grunt.loadNpmTasks('grunt-exorcise')
  grunt.loadNpmTasks('grunt-contrib-copy')
  grunt.loadNpmTasks('grunt-contrib-clean')
  grunt.loadNpmTasks('grunt-svgmin')

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    clean: {
      production: {
        src: [
          'static/'
        ]
      }
    },

    sass: {
      options: {
        outputStyle: 'compressed',
        sourceMap: true,
        includePaths: [
          require('bourbon').includePaths,
          require('bourbon-neat').includePaths,
          require('node-normalize-scss').includePaths
        ]
      },
      production: {
        files: {
          'static/main.min.css': 'assets/scss/main.scss',
          'static/admin.min.css': 'assets/scss/admin.scss'
        }
      }
    },

    modernizr: {
      production: {
        'crawl': false,
        'customTests': [],
        'dest': 'static/lib/modernizr.min.js',
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
          'static/main.min.js': 'assets/js/main.js',
          'static/admin.min.js': 'assets/js/admin.js'
        }
      }
    },

    exorcise: {
      production: {
        files: {
          'static/main.min.js.map': 'static/main.min.js',
          'static/admin.min.js.map': 'static/admin.min.js'
        }
      }
    },

    copy: {
      production: {
        files: {
          'static/lib/jquery.min.js': 'bower_components/jquery/dist/jquery.min.js'
        }
      }
    },

    img: {
      dist: {
        src: 'assets/img',
        dest: 'static/img'
      }
    },

    svgmin: {
      options: {},
      dist: {
        files: [
          {
            expand: true,
            cwd: 'assets/img/',
            src: ['*.svg'],
            dest: 'static/img/'
          }
        ]
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
  grunt.registerTask('img-mkdir', 'mkdir static/img', function () {
    var fs = require('fs')

    fs.mkdirSync('static')
    fs.mkdirSync('static/img')
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
    'svgmin',
    'sass',
    'standard',
    'copy',
    'browserify',
    'exorcise',
    'modernizr'
  ])
}
