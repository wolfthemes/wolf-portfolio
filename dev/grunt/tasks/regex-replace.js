module.exports = {

	build : {
		src: [
			'../pack/<%= app.slug %>/**/*.php'
		],

		actions: [
			{
				name: 'feat',
				search: '\#FEATURE(.*?(\n))+.*?\#!FEATURE ',
				replace: '',
				flags: ''
			}
		]
	}

};