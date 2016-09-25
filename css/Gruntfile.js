module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    /* Uglify task (minificar el js)  
    uglify: {
      build: {
        src: 'js/main.js',
        dest: 'js/main.min.js'
      }
    },*/

    // SASS to CSS (convertir el .scss en .css)
    sass: {                                 // Task
        dist: {                            // Target
          options: {                       // Target options
            style: 'expanded'
          },
          files: {                                  // Dictionary of files
            'css/main.css': 'scss/main.scss',       // 'destination': 'source'
          }
        }
    },
        
    // CSS minificado
    cssmin: {
      combine: {
        files: {
          'css/main.min.css': ['css/main.css']
        }
      }
    },
        
    // Watch task
    watch: {
        
      options: {
        livereload: true,
      },
        
      /*scripts: {
        files: ['js/*.js'],
        tasks: ['uglify'],
        options: {
          spawn: false,
        }
      },*/
        
      sass: {
        files: ['scss/**/*.scss', 'css/main.css'],
        tasks: ['sass', 'cssmin'],
        options: {
          spawn: false,
        }
      },
        
    }


    });

    // Load the plugins.
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Default task(s).
    grunt.registerTask('default', ['sass', 'cssmin', 'watch']);

};