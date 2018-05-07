module.exports = {
	
	build: {
		src: [ '<%= app.root %>/pack/<%= app.slug %>/**' ],
		options: {
			force: true
		}
	},

	test:{
		src: [
			'<%= app.testPath %>/wp-content/plugins/<%= app.slug %>/**'

		],
		options: {
			force: true,
		}
	}
};