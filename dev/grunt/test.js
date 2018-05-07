module.exports = function(grunt) {
	
	grunt.registerTask( 'test', function() {
		grunt.task.run( [
			'clean:test',
			'copyto:test'
		] );
	} );
};