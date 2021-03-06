# WP Themeular

Custom Angular.js powered WordPress theme

I became interested in learning more about Angular.js, so I figured I'd build up a custom theme. 

#### Grunt.js
All automation is handled by Grunt. The necessary scripts and styles have been combined into a single stylesheet (themeular.min.css) and a single javascript file (themeular.min.js).

To get up and running, simply download this repo locally. Once you have a local copy you can use the following commands:

```bash
$ npm install -g grunt-cli
$ npm install -g grunt
$ npm install
$ grunt
```

#### Switch Up Styles:
To swap default themes styles, simply replace the bootstrap-superhero.css file in 'wp-content/themes/themeular/css' with any of the themes found in 'wp-content/themes/themeular/css/bootstrap-themes/'.

Steps to switch themes:

1. Move `bootstrap-theme_name.css` from `wp-themeular/lib/public/css` to `wp-themeular/lib/public/css/bootstrap-themes/`
2. Move newly selected theme from `wp-themeular/lib/public/css/bootstrap-themes/` to `wp-themeular/lib/public/css`
3. Run `$ grunt` (to recompile the styles as needed)


##### To Do:
* Work on child menu items in the main_nav
* Work on edit/delete functionality
* Expose widget route endpoint via REST API
* Work on some form of theme settings page (preferably via customizer)