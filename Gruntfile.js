module.exports = function (grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        concat: {
            options: {
                process: function(src, filepath) {
                    return '\n/* -------- ' + filepath + ' -------- */ \n\n' + src;
                },
            },
            js: {
                src: [
                    'js/*.js',
                    'js/**/*.js',
                    '!js/vendor/*.js',
                    '!js/app.js',
                ],
                dest: 'js/app.js'
            }
        },

        sass: {
            development: {
                files: {
                    'style.css': 'sass/style.scss',
                }
            },
            build: {
                options: {
                    style: 'compressed'
                },
                files: {
                    'style.css': 'sass/style.scss',
                }
            }
        },

        watch: {
            js: {
                files: ['js/*.js', 'js/**/*.js'],
                tasks: ['concat']
            },
            sass: {
                files: ['sass/*', 'sass/**/*'],
                tasks: ['sass:development']
            }
        },

        copy: {
          main: {
            files: [
              { expand: true,
              src: [
              '**',
              '!**/sass/**',
              '!**/node_modules/**',
              ],
              dest: 'build/defisomedia' },
            ],
          },
        },

        uglify: {
            build: {
                files: {
                    'build/defisomedia/js/app.js': ['js/app.js']
                }
            }
        },

        postcss: {
          options: {
            map: true, // inline sourcemaps

            processors: [
              require('autoprefixer')({browsers: '> 1%, last 2 versions'}), // add vendor prefixes
            ]
          },
          dist: {
            src: '*.css'
          }
        }


    });


    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-postcss');

    grunt.registerTask('default', ['watch']);
    grunt.registerTask('build', ['sass:build','concat','copy','uglify:build','postcss']);
};
