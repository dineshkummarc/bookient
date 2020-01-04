<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Bookient
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade Bookient to newer
* versions in the future. You can customise Bookient for your needs and if you find bugs
* please report to us (contact@pard.co) and commit fixed files to Bookient repository.
*
* @copyright  Copyright (c) 2015 www.bookient.com
* @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*/

/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP  < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;



/*====================TEST SERVER====================*/
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'bookient';
/*====================TEST SERVER====================*/


$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = 'app_';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
/*$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';*/

$db ['default'] ['char_set'] = 'latin1';
$db ['default'] ['dbcollat'] = 'latin1_swedish_ci'; 

$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;


/*================ stored_procedure ======================*/
$db['stored_procedure']['hostname'] = 'localhost';
$db['stored_procedure']['username'] = 'root';
$db['stored_procedure']['password'] = '';
$db['stored_procedure']['database'] = 'bookient';
$db['stored_procedure']['dbdriver'] = 'mysqli';
$db['stored_procedure']['dbprefix'] = 'app_';
$db['stored_procedure']['pconnect'] = TRUE;
$db['stored_procedure']['db_debug'] = TRUE;
$db['stored_procedure']['cache_on'] = FALSE;
$db['stored_procedure']['cachedir'] = '';
/*$db['stored_procedure']['char_set'] = 'utf8';
$db['stored_procedure']['dbcollat'] = 'utf8_general_ci';*/ 

$db ['stored_procedure']['char_set'] = 'latin1';
$db ['stored_procedure']['dbcollat'] = 'latin1_swedish_ci';

$db['stored_procedure']['swap_pre'] = '';
$db['stored_procedure']['autoinit'] = TRUE;
$db['stored_procedure']['stricton'] = FALSE;
/*================ stored_procedure ======================*/

/* End of file database.php */
/* Location: ./application/config/database.php */
