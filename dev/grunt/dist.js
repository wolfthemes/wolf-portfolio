module.exports = function(grunt) {

	grunt.registerTask( 'dist', function() {
		grunt.task.run( [
			'compress:build',
			'rsync:dist',
			'notify:dist'
		] );
	} );
};