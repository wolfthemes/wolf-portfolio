module.exports = {

	js:{
		files:[
			'<%= app.jsPath %>/*.js',
			'!<%= app.jsPath %>/lib/**',
			'!<%= app.jsPath %>/admin/*.js', 
			],
		tasks: [
			// 'jshint',
			'uglify',
			'notify:js'
		]
	},

	sass: {
		files: [
			'<%= app.scssPath %>/*.scss',
			'<%= app.scssPath %>/shortcodes/*.scss',
			'<%= app.scssPath %>/icons/*.scss',
			'<%= app.scssAdminPath %>/*.scss'
		],
		tasks: [
			'compass',
			'autoprefixer',
			'cssmin',
			'notify:scss'
		],
	},

	css: {
		files: ['*.css']
	},

	livereload: {
		files: [ '<%= app.cssPath %>/*.css', '<%= app.cssPath %>/admin/*.css' ],
		options: { livereload: true }
	}
};