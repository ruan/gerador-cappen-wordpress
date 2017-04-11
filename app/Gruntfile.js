/*global module:false*/
module.exports = function(grunt) {

    require('load-grunt-tasks')(grunt , {config: 'package'});
    require('time-grunt')(grunt);

    var config = {
        app: 'app',
        theme: 'wordpress/wp-content/themes/site'
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
                files: ['<%= config.app %>/**','!<%= config.app %>/scss/**'],
                tasks: ['copy:app', 'fileblocks:app', 'wiredep:app'],
                options: {
                    livereload: true
                }
            },
            gruntfile: {
                files: ['Gruntfile.js']
            },
            sourceSass: {
                files: ['<%= config.app %>/scss/{,*/}*.{scss,sass}'],
                tasks: ['sass:app']
            }
        },

        fileblocks: {
            app: {
                src: '<%= config.theme %>/footer.php',
                blocks: {
                    'app': { src: ['scripts/vendor/*.js','scripts/main.js'], cwd: '<%= config.app %>/' , prefix: '<?php echo get_template_directory_uri();?>/' , rebuild:true}
                }
            },
            build: {
                src: '<%= config.app %>/footer.php',
                blocks: {
                    'app': { src: ['scripts/vendor/*.js','scripts/main.js'], cwd: '<%= config.app %>/' , prefix: '' , rebuild:true}
                }
            }
        },

        processhtml: {
            options:{
                commentMarker: 'process'
            },
            build:{
                files: [{
                    expand: true,
                    cwd: '<%= config.theme %>/',
                    src: ['header.php','footer.php'],
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
                    '<%= config.app %>/scss/_import-map.scss': ['<%= config.app %>/scss/components/**/*.scss', '<%= config.app %>/scss/layouts/**/*.scss']
                }
            },
            options: {
                useSingleQuotes: false,
                signature: '// components + layouts'
            }
        },

        sass: {
            app: {
                files: {
                    '<%= config.app %>/styles/main.css': '<%= config.app %>/scss/main.scss'
                },
                options: {
                    sourceMap: true,
                    outputStyle: 'expanded'
                }
            },
            build: {
                files: {
                    '<%= config.app %>/styles/main.css': '<%= config.app %>/scss/main.scss'
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
                    '<%= config.theme %>/header.php',
                    '<%= config.app %>/scss/{,*/}*.scss'
                ],
                fileTypes: {
                    html: {
                        replace: {
                            js: '<script src="<?php echo get_template_directory_uri();?>/{{filePath}}"></script>',
                            css: '<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/{{filePath}}" />'
                        }
                    }
                }
            },
            build: {
                src: [
                    '<%= config.theme %>/footer.php',
                    '<%= config.theme %>/header.php',
                    '<%= config.app %>/scss/{,*/}*.scss'
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
            html: ['<%= config.theme %>/header.php','<%= config.theme %>/footer.php']
        },

        // Performs rewrites based on rev and the useminPrepare configuration
        usemin: {
            options: {
                assetsDirs: ['<%= config.theme %>', '<%= config.theme %>/img']
            },
            html: ['<%= config.theme %>/header.php','<%= config.theme %>/footer.php'],
            css: ['<%= config.theme %>/styles/{,*/}*.css']
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
                    }
                ]
            }
        },

        // Generates a custom Modernizr build that includes only the tests you
        // reference in your app
        modernizr: {
            build: {
                devFile: 'bower_components/modernizr/modernizr.js',
                outputFile: '<%= config.theme %>/scripts/vendor/modernizr.js',
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
                src: '<%= config.app %>/styles/main.css'
            }
        },

        // Run some tasks in parallel to speed up build process
        concurrent: {
            app: [
                'fileblocks:app',
                'wiredep:app'
            ]
        },

    });

    grunt.registerTask('app', function () {
        grunt.task.run([
            'clean:app',
            'wiredep:app',
            'sass_globbing',
            'sass:app',
            'copy:app',
            'concurrent:app',
            'watch'
        ]);
    });

    grunt.registerTask('build', function(){
        grunt.task.run([
            'clean:app',
            'fileblocks:build',
            'sass:build',
            'postcss:build',
            'copy:app',
            'wiredep:build',
            'useminPrepare',
            'usemin',
            'concat',
            'cssmin',
            'uglify',
            'modernizr',
            'processhtml:build',
            'clean:js'
        ]);
    });

};
