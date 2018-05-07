module.exports = {
	build: {
		files: [ {
			cwd: '<%= app.root %>/', // root
			src: [
				'**', /* Include everything */
				"!READMETMPL",
				"!dev.config.php",
				"!.git/**", // very important
				"!dev/**",
				"!html/**",
				"!pack/**",
				"!scss/**",
				"!scss-admin/**"
			],
			dest: '<%= app.root %>/pack/<%= app.slug %>',
		} ],
		ignoreInDest: '.git/**',
		updateAndDelete: true,
		verbose: true
	},
};