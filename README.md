## Starting the new WordPress project

1. Create new empty repository for your new project.
2. Copy repository to your computer.
3. Copy all files from Starter repository (this one) to the new repository for your project (you can bypass `.gitlab-ci.yml` file if you are using custom deployment method).
4. Change the name of theme folder in `/wordpress/themes/` from `starter_theme` to your custom name.
5. Run `Search and replace` on the whole project with `Case sensitive` and `Whole word` options enabled. Here is the list of required replaces:
  * Replace `PROJECT_NAME`
  * Replace `PROJECT_AUTHOR`
  * Replace `PROJECT_VERSION`
  * Replace `PROJECT_AUTHOR_URL`
  * Replace `PROJECT_DATE`
  * Replace `PROJECT_DESCRIPTION`
  * Replace `project_name` (lowercase with underscores instead of spaces or dashes)
  * Replace `starter_theme` (your custom theme directory name)

  Run another `Search and replace` on the whole project with `Case sensitive` option enabled only.
  * Replace `starter_theme_` (lowercase with underscores instead of spaces or dashes which must end with `_`)
6. Commit everything to your new repository
7. Install WordPress on your computer ([Local app](https://localwp.com/) recommended)
8. Install necessary plugins for the project. Here is the list of the recommended plugins:
  * Advanced Custom Fields Pro (required)
  * ACF Code Field (required)
  * WP Migrate DB Pro
  * All-in-One WP Migration
  * Lazy Loader
  * Kadence Blocks
  * Disable Comments (recommended for projects without commenting support)
  * Disable Emojis (GDPR friendly)
  * Duplicate Post
  * [Email Encoder](https://wordpress.org/plugins/email-encoder-bundle/)
  * English WordPress Admin
  * Autoptimize (do not enable it during the development)
  * WP Fastest Cache (do not enable it during the development)
  * Intuitive Custom Post Order
  * HTML Forms or Contact Form 7
  * WPBruiser {no- Captcha anti-Spam}
  * Wordfence Security
  * ACF: Better Search
  * Custom Post Type UI
  * Max Mega Menu
  * WebP Express
  * Yoast SEO or SEOPress
9. Create symbolic linking between repository catalogs and your local WordPress installation. 

Example:

`ln -s /Users/user/Work/Repositories/projectname/wordpress/themes/themename /Users/user/Work/LocalWebsites/projectname/app/public/wp-content/themes`

`ln -s /Users/user/Work/Repositories/projectname/wordpress/mu-plugins/load.php /Users/user/Work/LocalWebsites/projectname/app/public/wp-content/mu-plugins`

`ln -s /Users/user/Work/Repositories/projectname/wordpress/mu-plugins/acf-header_tag /Users/user/Work/LocalWebsites/projectname/app/public/wp-content/mu-plugins`

`ln -s /Users/user/Work/Repositories/projectname/wordpress/mu-plugins/acf-spacing /Users/user/Work/LocalWebsites/projectname/app/public/wp-content/mu-plugins`

`ln -s /Users/user/Work/Repositories/projectname/wordpress/mu-plugins/acf-unique_id /Users/user/Work/LocalWebsites/projectname/app/public/wp-content/mu-plugins`

10. Set the new theme as a default one in WordPress
11. Synchronize ACF fields
12. [Set the content width in Kadence Blocks](https://good-start.dev/img/kadence-settings.png) to the content width in the design and substract 30px from it. For example if content in the design had 1200px of width then set 1170px in the settings.
13. Copy website to the staging server with All-in-One WP Migration plugin.
14. Gulp setup. Duplicate `options-example.js` file with the new name - `options.js`. Set the parameters:

```
'use strict';
module.exports = {
  serverLink: 'http://localurl.onlocal',
  isStatic: false,
  isWP: true,
  templateNameWP: 'themename'
};
```

15. Run `npm install` command in the project root and test if `npm run dev` and `npm run build` commands are working.
16. Configure deployment. Set the variables on gitlab repository settings in Settings -> CI/CD.

Commit changes and check if deployment is running correctly.

## Recommended tools for development

* VSCODE - code editor
* VSCODE - emmet
* VSCODE - Tailwind CSS IntelliSense
* VSCODE - Headwind
* Chrome - PerfectPixel
* Avocode - for managing designs, extracting assets, creating variables

## Working with the project

### WordPress Website

1. Setup WordPress on your local machine
2. Create symbolic links from repository to your WordPress
installation for theme and plugins.
Example: `/repositiories/project/wordpress/themes/theme_name` ->
`/local_websites/project/public_html/wp-content/themes/`
3. Duplicate `options-example.js` file with the name `options.js`. Set `serverLink`
variable according to your local URL to the project.
4. Run `npm install` in the project root.
5. Run `npm run dev` to start working on the WordPress site

### Static HTML Website

1. Duplicate `options-example.js` file with the name `options.js`. Set `isStatic` to `true` and `isWP` tp `false`.
4. Run `npm install` in the project root.
5. Run `npm run dev` to start working on the WordPress site

## Default Deployment

### WordPress website

1. Set `isStatic` (false), `isWP` (true) and `templateNameWP` variables in `gulpfile.js` file.
2. Run `npm install` in the project root.
3. Run `npm run build` to generate website.
4. Upload files from `/wordpress/` to the `wp-content` folder on the server.

### Static HTML website

1. Set `isStatic` (true) and `isWP` (false) variables in `gulpfile.js` file.
2. Run `npm install` in the project root.
3. Run `npm run build` to generate website.
4. Upload files from `/static/` to the root folder on the server
