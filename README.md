-----------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------
# phpOpenFW
-----------------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------
phpOpenFW is an open source MVC PHP web development framework released under the MIT License.

-----------------------------------------------------------------------------------------------------------
## Author
-----------------------------------------------------------------------------------------------------------
Christian J. Clark

-----------------------------------------------------------------------------------------------------------
## Website / Documentation
-----------------------------------------------------------------------------------------------------------
http://www.phpopenfw.org/

-----------------------------------------------------------------------------------------------------------
## License
-----------------------------------------------------------------------------------------------------------
Released under the MIT License: https://mit-license.org/

-----------------------------------------------------------------------------------------------------------
## Version
-----------------------------------------------------------------------------------------------------------
2.1.0rc6

-----------------------------------------------------------------------------------------------------------
## Requirements
-----------------------------------------------------------------------------------------------------------
phpOpenFW requires PHP >= 5.6, libxslt, libxml, php-xsl, and php-xml.

-----------------------------------------------------------------------------------------------------------
## Features
-----------------------------------------------------------------------------------------------------------
phpOpenFW has an abundance of features that facilitate the development of powerful, flexible applications, sites, and scripts. 
Below is an outline of some of the features offered by phpOpenFW:

#### Framework Facilities

* Database Abstraction Layers
* Active Record Class
* SQL Query Builder
* XML Element Class (abstract)
* HTML Helpers
* Form Engine
* Plugin Facility
* Validation Objects (SSV / SSV2)

#### Application Facilities

* Built-in Authentication services
* Module list / Navigation Facility

#### Plugins

* XML Transformation (using XSL)
* Quick Database Actions
* Date / Time Functions
* Code Benchmark

-----------------------------------------------------------------------------------------------------------
## Apache ModRewrite Rules
-----------------------------------------------------------------------------------------------------------
When using the nav_xml_format of "rewrite", you need to have to following apache mod_rewrite rules 
in place for the application navigation to work correctly. You can tweak the rules to suit you application, 
but there needs to be a catch-all rule that forward all pages through the applications main index.php 
script. Also, the pass-through for the CSS, images, and Javascript is important as well.

#### Example:

RewriteEngine On
RewriteRule ^([^/\.]+).html$ index.php?page=$1 [L]
RewriteRule ^(themes|css|img|javascript) - [L]
RewriteRule  .*favicon\.ico$ - [L]
RewriteRule ^.*$ index.php [L,qsa]

**If you are using Virtual Document Roots with Apache your rules will most likely need to look something like this:**

RewriteEngine On
RewriteBase /
RewriteRule ^([^/\.]+).html$ index.php?page=$1 [L]
RewriteRule ^(themes|css|img|javascript) - [L]
RewriteRule ^.*favicon\.ico$ - [L]
RewriteRule ^.*$ index.php [L,qsa]
