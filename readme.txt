===Zen Cart Product Page Download Time Estimator Plus Filesize v1.2===

Tested on Zen Cart 1.39H & 1.5.0 and php 5.2.17 as well as PHP 5.3.13

License This product licensed under the GPL.  See attached license for information. ==

This module is an beginner installation.  

========================================================

This add-on reads the file size of your downloads, and outputs an estimated 
download time for cable and DSL average speeds, plus displaying the actual
file size and format.

========================================================

===Database Changes===
None

===Core File Edits===
None

===Support===

Please direct support requests to our helpdesk here (https://pro-webs-support.com/)

===EOF Support===

===Basic Installation===
1. !!!! Backup your database and affected files !!!!
2. Upload the included files to your Zen cart installation maintaining
   their file structure.
3. Then edit includes/templates/your_template/templates/tpl_product_info_display.php
   to add the following include where you want the output to display.
   
<?php require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_DOWNLOAD_ESTIMATE)); ?>

===EOF Basic Installation===

===Tips===
The div containing the output has an ID if dl to create styling for the div.
===EOF Tips===   

===Change History===
Date       Version  Who             Why
===============================================================================
12/03/2004 - Initial Release, version 1.0   Jason LeBaron
10/7/2014 - Redone by PRO-Webs.net for newer Zen Cart and ISP speeds.