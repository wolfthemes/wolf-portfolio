# Repository Guidelines

## Project Structure & Module Organization

This repository is the `wolf-portfolio` WordPress plugin. The plugin bootstrap is `wolf-portfolio.php`; uninstall behavior lives in `uninstall.php`. PHP source is split between modern namespaced classes in `Functions/` and legacy procedural/includes in `inc/`. Front-end templates are in `templates/`, the Gutenberg "Last Works" block is in `blocks/last-works/`, source SCSS is in `src/styles/`, and compiled assets are committed under `assets/css/` and `assets/js/`. Translation files are stored in `languages/`.

## Build, Test, and Development Commands

- `npm install`: install webpack, Sass, and CSS build tooling.
- `npm run build`: compile `src/styles/portfolio.scss` to `assets/css/portfolio.css` and `assets/css/portfolio.min.css`.
- `npm run watch`: rebuild CSS while editing SCSS.
- `vendor/bin/phpcs --standard=phpcs.xml.dist`: lint PHP against the project WordPress ruleset when PHPCS dependencies are available.

There is no local dev server command. Test the plugin inside a WordPress install by activating it and checking portfolio archive, single work, taxonomy, shortcode, and block output.

## Coding Style & Naming Conventions

Follow WordPress PHP standards as configured in `phpcs.xml.dist`, with tabs for PHP indentation and escaped, sanitized output. Prefix globals with approved project prefixes such as `wolf_portfolio`, `wfolio`, `Wolf_Portfolio`, `WolfPortfolio`, or `WFOLIO`. Keep namespaced class work under `Functions/` and procedural compatibility code under `inc/`. Use the `wolf-portfolio` text domain for translatable strings. For JavaScript and webpack config, follow the existing spacing style with spaces inside parentheses, for example `require( 'path' )`.

## Testing Guidelines

No automated test framework is currently configured. For changes, run PHPCS where available and perform focused manual WordPress testing for affected behavior. For asset changes, run `npm run build` and confirm both normal and minified CSS outputs are updated. For template or query changes, verify empty portfolio states, filtered taxonomy views, and at least one single work page.

## Commit & Pull Request Guidelines

Recent history uses concise imperative commits, with conventional prefixes where helpful: `feat: ...`, `chore: ...`, `ci: ...`, plus short release/build messages such as `Updated version` or `Compiled files`. Keep commits scoped to one logical change. Pull requests should include a clear summary, manual test notes, linked issue or context, and screenshots for visible admin, block, shortcode, or front-end template changes. Mention any generated files updated by the build.

## Agent-Specific Instructions

Do not overwrite generated assets casually; rebuild them from source when changing SCSS. Preserve backward-compatible legacy hooks and template paths unless the change explicitly migrates them.
