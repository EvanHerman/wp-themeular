'use strict';
module.exports = function(grunt) {

    grunt.initConfig({
	
		concat: {
			options: {
			  separator: ';\n',
			  options: 'block',
			},
			public_scripts: {
			  src: ['lib/public/js/*.js'],
			  dest: 'lib/build/public/themeular.js',
			},
			public_styles: {
			  src: ['lib/public/css/*.css'],
			  dest: 'lib/build/public/themeular.css',
			},
			admin_scripts: {
				src: ['lib/admin/js/*.js'],
				dest: 'lib/build/admin/admin-themeular.js',
			},
			admin_styles: {
				src: ['lib/admin/css/*.css'],
				dest: 'lib/build/admin/admin-themeular.css',
			}
		  },
	
        // js minification
        uglify: {
            dist: {
                files: {
					// Public scripts
                    'lib/build/public/min/themeular.min.js': [ // main theme scripts
                        'lib/build/public/themeular.js'
                    ],
					// Admin scripts
                    'lib/build/admin/min/admin-themeular.min.js': [ // main theme scripts
                        'lib/build/admin/admin-themeular.js'
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
			  src: [ 'lib/public/css/*.css' ]
			}
		},
		
		// css minify all contents of our directory and add .min.css extension
		cssmin: {
			target: {
				files: [
					// Public css files
					{
						expand: true,
						cwd: 'lib/build/public',
						src: [
							'themeular.css',
						], // main style declaration file
						dest: 'lib/build/public/min',
						ext: '.min.css'
					},
					// Admin css files
					{
						expand: true,
						cwd: 'lib/build/admin',
						src: [
							'admin-themeular.css',
						], // main style declaration file
						dest: 'lib/build/admin/min',
						ext: '.min.css'
					}
				]
			}
		},

        // watch our project for changes
       watch: {
			public_css: { // admin css
				files: 'lib/public/css/*.css',
				tasks: ['concat','postcss','cssmin'],
				options: {
					spawn:false,
					event:['all']
				},
			},
			public_js: { // admin js
				files: 'lib/public/js/*.js',
				tasks: ['concat','uglify'],
				options: {
					spawn:false,
					event:['all']
				},
			},
			admin_css: { // admin css
				files: 'lib/admin/css/*.css',
				tasks: ['concat','postcss','cssmin'],
				options: {
					spawn:false,
					event:['all']
				},
			},
			admin_js: { // admin js
				files: 'lib/admin/js/*.js',
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
				src : [ 'lib/build/public/min/*.min.css', 'lib/build/public/min/*.min.js', 'lib/build/admin/min/*.min.css', 'lib/build/admin/min/*.min.js' ],
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