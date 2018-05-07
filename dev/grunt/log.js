module.exports = function(grunt) {
	/**
	 * Zip theme
	 */
	grunt.registerTask( 'log', function() {
		grunt.task.run( [
			'markdown',
			'string-replace:build',
			'rsync:log',
			'notify:log'
		] );
	} );
};