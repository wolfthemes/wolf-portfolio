module.exports = {
	
	main : {
		options: {
			// noAdvanced: true,
			// compatibility : true,
			// debug : true
			// keepBreaks : true
		},
		files: {
			'<%= app.cssPath %>/portfolio.min.css': ['<%= app.cssPath %>/portfolio.css']
		}
	}
};