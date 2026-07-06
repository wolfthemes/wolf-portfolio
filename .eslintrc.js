module.exports = {
	env: {
		jest: true,
		node: true,
		es6: true,
		browser: true,
	},
	globals: {
		wp: 'readonly',
	},
	extends: 'plugin:@wordpress/eslint-plugin/recommended',
	rules: {
		'import/no-unresolved': 'off',
		'import/no-extraneous-dependencies': 'off',
		'import/named': 'off',
		'import/default': 'off',
		camelcase: 'off',
		'no-nested-ternary': 'off',
		'jsx-a11y/label-has-associated-control': 'off',
		'jsx-a11y/anchor-is-valid': 'off',
		'no-console': 'off',
	},
};
