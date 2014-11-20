module.exports = function(grunt) {

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		watch: {
			scripts: {
				files: ['assets/scripts/**/*.js'],
				tasks: ['uglify'],
				options: {
					livereload: true,
					nospawn: true
				}
			},
			css: {
				files: ['assets/sass/**/*.scss'],
				tasks: ['sass'],
				options: {
					livereload: true
				},
			},
			grunt: {
				files: ['Gruntfile.js']
			},

			livereload: {
				options: { livereload: true },
				files: ['_build/**/*']
			}
		},
		uglify: {
			dist: {
				files: {
					'../assets/js/bootstrap.js': [
						'assets/scripts/vendor/bootstrap/affix.js',
						'assets/scripts/vendor/bootstrap/alert.js',
						'assets/scripts/vendor/bootstrap/button.js',
						'assets/scripts/vendor/bootstrap/carousel.js',
						'assets/scripts/vendor/bootstrap/collapse.js',
						'assets/scripts/vendor/bootstrap/dropdown.js',
						'assets/scripts/vendor/bootstrap/tab.js',
						'assets/scripts/vendor/bootstrap/transition.js',
						'assets/scripts/vendor/bootstrap/scrollspy.js',
						'assets/scripts/vendor/bootstrap/modal.js',
						'assets/scripts/vendor/bootstrap/tooltip.js',
						'assets/scripts/vendor/bootstrap/popover.js'
					],
					'../assets/js/application.js': [
						'assets/scripts/modules/equal.heights.js',
						'assets/scripts/dumfart.js',
						'!assets/scripts/vendor/bootstrap/*.js'
					],
                    '../assets/js/modernizr.min.js': [
                        'assets/scripts/modernizr.js'
                    ]
				}
			}
		},
		sass: {
			dist: {
				options: {
				style: 'compressed'
				},
				files: {
					'../assets/css/application.css': 'assets/sass/application.scss',
					'../assets/css/rte.css': 'assets/sass/rte.scss'
				}
			}
		},

		connect: {
			server: {
				options: {
					port: 9000,
					base: '_build',
					livereload: true
				}
			}
		},

	});


	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-connect');

	grunt.registerTask('default', ['serve']);
	grunt.registerTask('compile', [
		'sass',
		'uglify'
	]);

	grunt.registerTask('serve', [
		//'connect:server',
		'watch'
	]);

	grunt.event.on('watch', function(action, filepath) {
		grunt.config(['all'], filepath);
	});

};