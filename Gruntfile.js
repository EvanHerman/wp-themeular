'use strict';
module.exports = function(grunt) {

    grunt.initConfig({
	
		concat: {
			options: {
			  separator: ';\n',
			  options: 'block',
			},
			scripts: {
			  src: ['lib/js/*.js'],
			  dest: 'lib/build/themeular.js',
			},
			styles: {
			  src: ['lib/css/*.css'],
			  dest: 'lib/build/themeular.css',
			},
		  },
	
        // js minification
        uglify: {
            dist: {
                files: {
					// admin scripts
                    'lib/build/min/themeular.min.js': [ // main theme scripts
                        'lib/build/themeular.js'
                    ],
                }
            }
        },

		// Autoprefixer for our CSS files
		postcss: {
			options: {
                map: true,
                processors: [
                    require('autoprefixer-core')({
                        browsers: ['last 2 versions']
                    })
                ]
            },
			dist: {
			  src: [ 'lib/css/*.css' ]
			}
		},
		
		// css minify all contents of our directory and add .min.css extension
		cssmin: {
			target: {
				files: [
					// admin css files
					{
						expand: true,
						cwd: 'lib/build',
						src: [
							'themeular.css',
						], // main style declaration file
						dest: 'lib/build/min',
						ext: '.min.css'
					}
				]
			}
		},

        // watch our project for changes
       watch: {
			admin_css: { // admin css
				files: 'lib/css/*.css',
				tasks: ['concat','postcss','cssmin'],
				options: {
					spawn:false,
					event:['all']
				},
			},
			admin_js: { // admin js
				files: 'lib/js/*.js',
				tasks: ['concat','uglify'],
				options: {
					spawn:false,
					event:['all']
				},
			},
		},
		
		// Borwser Sync
		browserSync: {
			bsFiles: {
				src : [ 'lib/build/*.min.css', 'lib/build/*.min.js' ],
			},
			options: {
				proxy: "localhost/wp-themeular/",
				watchTask : true
			}
		},
						
    });

    // load tasks
	grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-postcss'); // CSS autoprefixer plugin (cross-browser auto pre-fixes)
    grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-browser-sync'); // browser-sync auto refresh
	grunt.loadNpmTasks('grunt-contrib-watch');
	
    // register task
    grunt.registerTask('default', [
		'concat',
		'uglify',
		'postcss',
        'cssmin',
		'browserSync',
        'watch',
    ]);

};