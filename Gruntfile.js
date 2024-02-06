(function (){
	'use strict';

	module.exports = function(grunt){
		require('load-grunt-tasks')(grunt);

		grunt.initConfig({
			pkg: grunt.file.readJSON('package.json'),

			/*** Clean folders with build ***/
			clean: {
				all: ['assets/css/*.css', 'assets/js/*.js']
			},
			
			/*** JS Validation ***/
			jshint: {
				all: ['Gruntfile.js', 'assets/js/source/*.js', 'parts/block/*/src/*.js'],
				options: {
					"bitwise": true,
					"browser": true,
					"curly": true,
					"eqeqeq": true,
					"eqnull": true,
					"esnext": true,
					"immed": true,
					"jquery": true,
					"latedef": false,
					"newcap": false,
					"noarg": true,
					"node": true,
					"strict": false,
					"trailing": false,
					"undef": false,
					"devel": true,
					"globals": {
						"jQuery": true,
						"alert": true
					}
				}
			},
			
			/*** JS concatenation ***/
			concat: {
				dist: {
					options: {
						separator: ';\n',
					},
					files: {
						'assets/js/theme.js': ['assets/js/vendor/*.js', 'assets/js/vendor/*/*.js', 'assets/js/source/*.js'],
						'./script.js': ['parts/block/*/src/*.js', 'parts/block/*/src/*/*.js'],
					},
				}
			},
			
			/*** JS minification ***/
			uglify: {
				dist: {
					files: {
						'assets/js/theme.js': ['assets/js/theme.js'],
						'parts/block/*/script.js': ['parts/block/*/script.js']
					},
				}
			},

			/*** SASS compilation ***/
			sass: {
				dist: { 
					options: {
						noSourceMap: true,
						style: 'compressed'
					},
					files: {
						'assets/css/theme.css': 'assets/scss/theme.scss',
						'assets/css/admin.css': 'assets/scss/admin.scss',
						'assets/css/editor.css': 'assets/scss/editor.scss'
					}
				}
			},

			/*** POSTCSS plugins ***/ 
			postcss: {
				options: {
					processors: [
						require('postcss-sort-media-queries')({sort: 'mobile-first'}),
						require('autoprefixer')()
					]
				},
				dist: {
					src: 'assets/css/*.css'
				}
			},

			/*** Watch files for changes ***/
			watch: {
				js: {
					files: [
						'<%= jshint.all %>'
					],
					tasks: ['jshint', 'concat', 'uglify'],
					options: {
						livereload: true,
					}
				},
				css: {
					files: [
						'assets/scss/',
						'assets/scss/*',
						'assets/scss/**/*',
					],
					tasks: ['sass', 'postcss'],
					options: {
						livereload: true,
					}
				},
				php: {
					files: ['../*.php', '../**/*.php'],
					options: {
						livereload: true
					}
				}
			},

			browserSync: {
				dev: {
					bsFiles: {
						src : 'assets/css/*.css'
					},
					options: {
						watchTask: true,
						// make sure to change this url so that Browsersync works
						proxy: 'starter-theme.local'
					}
				}
			}
		});

		/*** Register tasks ***/
		grunt.registerTask('default', [
			'clean',
			'jshint',
			// 'concat',
			// 'uglify',
			// 'sass',
			// 'postcss',
			// 'browserSync',
			'watch',
		]);
	};
}());