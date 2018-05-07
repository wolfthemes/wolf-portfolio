module.exports = {

	build: {

		options : {
			banner : '/*! <%= app.name %> Wordpress Plugin v<%= app.version %> */ \n'
			// preserveComments : 'some'
		},

		files: {

			'<%= app.jsPath %>/portfolio.min.js': [
				'<%= app.jsPath %>/portfolio.js'
			],
		}
	}
};