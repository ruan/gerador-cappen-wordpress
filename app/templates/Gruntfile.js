/*global module:false*/
module.exports = function (grunt) {

        require('load-grunt-tasks')(grunt, { config: 'package' });
        require('time-grunt')(grunt);

        var config = {
            app: 'app',
            theme: 'web/app/themes/<: slug :>'
        };

        grunt.initConfig({

            config: config,

            watch: {
                bower: {
                    files: ['bower.json'],
                    tasks: ['wiredep:app']
                },
                js: {
                    files: ['<%= config.app %>/scripts/{,**/}*.js'],
                    tasks: ['fileblocks:app'],
                },
                copy: {
                    files: ['<%= config.app %>/**', '!<%= config.app %>/scss/**'],
                    tasks: ['copy:app', 'fileblocks:app', 'wiredep:app'],
                    options: {
                        livereload: true
                    }
                },
                gruntfile: {
                    files: ['Gruntfile.js']
                },
                sourceSass: {
                    files: ['<%= config.app %>/scss/{,**/}*.{scss,sass}'],
                    tasks: ['sass_globbing', 'sass:app'],
                    options: {
                        livereload: true
                    }
                }
            },

            fileblocks: {
                app: {
                    src: '<%= config.theme %>/footer.php',
                    blocks: {
                        'app': { src: ['scripts/vendor/*.js', 'scripts/main.js'], cwd: '<%= config.app %>/', prefix: '<?php echo get_template_directory_uri();?>/', rebuild: true }
                    }
                },
                preBuild: {
                    src: '<%= config.theme %>/footer.php',
                    blocks: {
                        'app': { src: ['scripts/vendor/*.js', 'scripts/main.js'], cwd: '<%= config.theme %>/', prefix: '', rebuild: true }
                    }
                },
                build: {
                    src: ['<%= config.theme %>/footer.php','<%= config.theme %>/header.php'],
                    blocks: {
                        'css': { src: ['styles/*.css','!styles/main.css','styles/main.css'], cwd: '<%= config.theme %>/', prefix: '<?php echo get_template_directory_uri();?>/', rebuild: true },
                        'js': { src: ['scripts/vendor/*.js', 'scripts/*.js', '!scripts/main.js', 'scripts/main.js'], cwd: '<%= config.theme %>/', prefix: '<?php echo get_template_directory_uri();?>/', rebuild: true }
                    }
                }
            },

            processhtml: {
                options: {
                    commentMarker: 'process'
                },
                build: {
                    files: [{
                        expand: true,
                        cwd: '<%= config.theme %>/',
                        src: ['header.php', 'footer.php'],
                        dest: '<%= config.theme %>/',
                        ext: '.php'
                    }]
                }
            },

            // Empties folders to start fresh
            clean: {
                app: ['<%= config.theme %>/*', '.tmp/*'],
                js: ['<%= config.theme %>/scripts/vendor']
            },

            sass_globbing: {
              my_target: {
                files: {
                  '<%= config.app %>/scss/_mixins.scss': ['<%= config.app %>/scss/mixins/**/*.scss'],
                  '<%= config.app %>/scss/_components.scss': ['<%= config.app %>/scss/components/**/*.scss'],
                  '<%= config.app %>/scss/_layouts.scss': ['<%= config.app %>/scss/layouts/**/*.scss']
                }
              },
              options: {
                signature: false,
                useSingleQuotes: false
              }
            },

            sass: {
                app: {
                    files: {
                        '<%= config.theme %>/styles/main.css': '<%= config.app %>/scss/main.scss'
                    },
                    options: {
                        sourceMap: true,
                        outputStyle: 'expanded'
                    }
                },
                build: {
                    files: {
                        '<%= config.theme %>/styles/main.css': '<%= config.app %>/scss/main.scss'
                    },
                    options: {
                        sourceMap: false,
                        outputStyle: 'compressed'
                    }
                }
            },

            // Automatically inject Bower components into the HTML file
            wiredep: {
                app: {
                    src: [
                        '<%= config.theme %>/footer.php',
                        '<%= config.theme %>/header.php'
                    ],
                    ignorePath: '../../../../',
                    fileTypes: {
                        html: {
                            replace: {
                                js: '<script src="<?php echo get_template_directory_uri();?>/scripts/vendor/{{filePath}}"></script>',
                                css: '<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/scripts/vendor/{{filePath}}" />'
                            }
                        }
                    }
                },
                sass: {
                    src: [
                        '<%= config.app %>/scss/{,*/}*.scss'
                    ]
                },
                build: {
                    src: [
                        '<%= config.theme %>/footer.php',
                        '<%= config.theme %>/header.php'
                    ]
                }
            },

            // Reads HTML for usemin blocks to enable smart builds that automatically
            // concat, minify and revision files. Creates configurations in memory so
            // additional tasks can operate on them
            useminPrepare: {
                options: {
                    dest: '<%= config.theme %>'
                },
                html: ['<%= config.theme %>/header.php', '<%= config.theme %>/footer.php']
            },

            // Performs rewrites based on rev and the useminPrepare configuration
            usemin: {
                // options: {
                //     assetsDirs: ['<%= config.theme %>', '<%= config.theme %>/img']
                // },
                html: ['<%= config.theme %>/header.php', '<%= config.theme %>/footer.php']
                // css: ['<%= config.theme %>/styles/{,*/}*.css']
            },

            uglify: {
                options: {
                    mangle: false
                }
            },

            // Copies remaining files to places other tasks can use
            copy: {
                app: {
                    files: [
                        {
                            expand: true,
                            dot: true,
                            cwd: '<%= config.app %>',
                            dest: '<%= config.theme %>',
                            src: [
                                '**',
                                '!scss/**'
                            ]
                        },
                        {
                            expand: true,
                            flatten: true,
                            src: ['bower_components/font-awesome/fonts/*'],
                            dest: '<%= config.app %>/fonts'
                        },
                        {
                            expand: true,
                            dot: true,
                            src: ['bower_components/**'],
                            dest: '<%= config.theme %>/scripts/vendor'
                        }
                    ]
                }
            },

            // Generates a custom Modernizr build that includes only the tests you
            // reference in your app
            modernizr: {
                build: {
                    devFile: 'bower_components/modernizr/modernizr.js',
                    dest: '<%= config.theme %>/scripts/modernizr.js',
                    files: {
                        src: [
                            '<%= config.theme %>/scripts/{,**/}*.js',
                            '<%= config.theme %>/styles/{,*/}*.css',
                            '!<%= config.theme %>/scripts/vendor/*'
                        ]
                    },
                    uglify: true
                }
            },

            postcss: {
                options: {
                    map: false,
                    processors: [
                        require('autoprefixer')
                    ]
                },
                build: {
                    src: '<%= config.theme %>/styles/main.css'
                }
            },

            // Run some tasks in parallel to speed up build process
            concurrent: {
                app: [
                    'fileblocks:app',
                    'wiredep:app'
                ],
                build: [
                    'fileblocks:preBuild',
                    'wiredep:build'
                ]
            },

        });

        grunt.registerTask('app', function () {
            grunt.task.run([
                'clean:app',
                'wiredep:sass',
                'sass_globbing',
                'sass:app',
                'copy:app',
                'concurrent:app',
                'watch'
            ]);
        });

        grunt.registerTask('build', function () {
            grunt.task.run([
                'clean:app',
                'wiredep:sass',
                'sass_globbing',
                'sass:build',
                'postcss:build',
                'copy:app',
                'concurrent:build',
                'useminPrepare',
                'concat',
                'uglify',
                'cssmin',
                'usemin',
                'modernizr',
                'clean:js',
                'processhtml:build',
                'fileblocks:build'
            ]);
        });
    };
