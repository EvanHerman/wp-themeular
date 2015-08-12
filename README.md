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
1) Move bootstrap.css from 'wp-content/themes/themeular/css' to 'wp-content/themes/themeular/css/bootstrap-themes/'
2) Move newly selected theme from 'wp-content/themes/themeular/css/bootstrap-themes/' to 'wp-content/themes/themeular/css'
3) Run grunt (to recompile the styles as needed)


##### To Do:
* Setup custom menu management and power it via Angular.js
* Prepare for WP REST API  v2