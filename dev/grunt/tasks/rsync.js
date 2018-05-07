module.exports = {
	options: {
		args: ["--verbose", "--chmod=Du=rwx,Dg=rx,Do=rx,Fu=rw,Fg=r,Fo=r"],
		recursive: true
	},

	// stage
	stage: {
		options: {
			src: [ '<%= app.root %>/pack/<%= app.slug %>/' ],
			dest: "/home/csag/http/wolfthemes.com/stage/wp-content/plugins/<%= app.slug %>",
			host: "csag@wolfthemes.com",
			syncDestIgnoreExcl: true
		}
	},

	// sandbox
	sandbox: {
		options: {
			src: [ '<%= app.root %>/pack/<%= app.slug %>/' ],
			dest: "/home/csag/http/wolfthemes.com/sandbox/wp-content/plugins/<%= app.slug %>",
			host: "csag@wolfthemes.com",
			syncDestIgnoreExcl: true
		}
	},

	// log
	log: {
		options: {
			src: [ '<%= app.root %>/pack/dist/changelog.xml' ],
			dest: "/home/csag/http/wolfthemes.com/plugins/<%= app.slug %>",
			host: "csag@wolfthemes.com",
			syncDestIgnoreExcl: true
		}
	},

	// demo
	demo: {
		options: {
			src: [ '<%= app.root %>/pack/<%= app.slug %>/' ],
			dest: "/home/csag/http/wolfthemes.com/demos/wp-content/plugins/<%= app.slug %>",
			host: "csag@wolfthemes.com",
			syncDestIgnoreExcl: true
		}
	},

	vico: {
		options: {
			src: [ '<%= app.root %>/pack/<%= app.slug %>/' ],
			dest: "/home/csag/http/saguin.com/victor/wp-content/plugins/<%= app.slug %>",
			host: "csag@wolfthemes.com",
			syncDestIgnoreExcl: true
		}
	},

	// wolf
	wolf: {
		options: {
			src: [ '<%= app.root %>/pack/<%= app.slug %>/' ],
			dest: "/home/csag/http/wolfthemes.com/www/wp-content/plugins/<%= app.slug %>",
			host: "csag@wolfthemes.com",
			syncDestIgnoreExcl: true
		}
	},

	// help
	help: {
		options: {
			src: [ '<%= app.root %>/pack/<%= app.slug %>/' ],
			dest: "/home/csag/http/wolfthemes.com/help/wp-content/plugins/<%= app.slug %>",
			host: "csag@wolfthemes.com",
			syncDestIgnoreExcl: true
		}
	},

	doc:{
		options: {
			src: [ '<%= app.root %>/pack/Documentation/' ],
			dest: "/home/csag/http/wolfthemes.com/docs/documentation/plugins/<%= app.slug %>",
			host: "csag@wolfthemes.com",
			syncDestIgnoreExcl: true
		}
	},

	// new wolfthemes
	dist: {
		options: {
			src: [ '<%= app.root %>/pack/dist/' ],
			dest: "/home/csag/http/wolfthemes.com/plugins/<%= app.slug %>",
			host: "csag@wolfthemes.com",
			syncDestIgnoreExcl: true
		}
	}
};