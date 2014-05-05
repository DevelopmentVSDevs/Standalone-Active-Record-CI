<?php
/* DOCUMENTOPIA.COM
******************************************************************************************
* This software is provided "as is", without warranty of any kind, express or implied,
* including but not limited to the warranties of merchantability, fitness for a particular
* purpose and noninfringement. In no event shall Documentopia.com LLC be liable for any
* claim, damages or other liability, whether in an action of contract, tort or otherwise,
* arising from, out of or in connection with Documentopia.com LLC or the use or other
* dealings with Documentopia.com LLC.
*
* Apache License, Version 2.0 
* http://www.apache.org/licenses/LICENSE-2.0 

*
* @link http://www.documentopia.com/licensing
*
* @author David Dula <coding@documentopia.com>
* @copyright - 2012 - Documentopia.com
******************************************************************************************
*/

define('DB_DEBUG', true);
define('DB_LOAD_FORGE', true);

error_reporting(E_ALL & ~(E_DEPRECATED | E_STRICT));

// This should be the base path to the database folder
if ( ! defined('BASEPATH')) {
	define('BASEPATH', pathinfo(__FILE__, PATHINFO_DIRNAME).'/');
	}

function get_instance() {
    global $db;
    if (isset($db)) {
        $item->db = $db;
        return ($item);
    } else {
        return (null);
    }
}

function log_message($level = 'error', $message, $php_error = FALSE) {
    if (DB_DEBUG) echo $message . "\n";
}

function show_error($message, $status_code = 500, $heading = 'An Error Was Encountered') {
    if (DB_DEBUG) echo $message . "\n";
}


// Open the configfile
include_once ('database.php');

require_once (BASEPATH . 'database/DB.php');
// Create The DB var
$db = DB($db['default']);


if (DB_LOAD_FORGE) {
    
    require_once (BASEPATH . 'database/DB_forge.php');
    require_once (BASEPATH . 'database/DB_utility.php');
    require_once (BASEPATH . 'database/drivers/' . $db->dbdriver . '/' . $db->dbdriver . '_utility.php');
    require_once (BASEPATH . 'database/drivers/' . $db->dbdriver . '/' . $db->dbdriver . '_forge.php');
    $class = 'CI_DB_' . $db->dbdriver . '_forge';
    $dbforge = new $class();
}


// At this point $db is set to the databaes adnd $dbforge is set to dbforge

$query = $db->get('table_name');
$row = $query->result_array();
print_r($row);


?>
