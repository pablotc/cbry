<?php
/**
* @package Mambo
* @subpackage Database
* @copyright  Refer to copyright.php
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* @author Mambo Foundation Inc see README.php
*/ 

/**
* Database connector class
*/
/*require_once( $mosConfig_absolute_path . '/includes/phpmailer/class.phpmailer.php' );
require_once( $mosConfig_absolute_path . '/includes/phpInputFilter/class.inputfilter.php' );*/

class database {
	/** @var string Internal variable to hold the query sql */
	var $_sql='';
	/** @var int Internal variable to hold the database error number */
	var $_errorNum=0;
	/** @var string Internal variable to hold the database error message */
	var $_errorMsg='';
	/** @var string Internal variable to hold the prefix used on all database tables */
	var $_table_prefix='';
	/** @var Internal variable to hold the connector resource */
	var $_resource='';
	/** @var Internal variable to hold the last query cursor */
	var $_cursor=null;
	/** @var boolean Debug option */
	var $_debug=0;
	/** @var array A log of queries */
	var $_log=array();
	/** @var string Null date */
	var $_null_date='0000-00-00 00:00:00';

	/**
	* Database object constructor
	* @param string Database host
	* @param string Database user name
	* @param string Database user password
	* @param string Database name
	* @param string Common prefix for all tables
	*/
	function database( $host='localhost', $user, $pass, $db, $table_prefix ) {
		global $configuration,$charset;
		$charset='iso-8859-1';
		$mysql_charsets['utf-8']='utf8';
		$mysql_charsets['iso-8859-1']='latin1';
		$mysql_charsets['iso-8859-15']='latin1';
		$mysql_charsets['koi8-r']='koi8r';
		$mysql_charsets['windows-1251']='cp1251';
		$mysql_charsets['cp1251']='cp1251';
		$mysql_charsets['gb2312']='gb2312';
		$mysql_charsets['gb18030']='gb2312';
		$mysql_charsets['gbk']='gb2312';
		$mysql_charsets['big5-hkscs']='big5';
		$mysql_charsets['big5']='big5';
		$mysql_charsets['euc-tw']='gb2312';
		$mysql_charsets['iso-8859-2']='latin2';
		$mysql_charsets['windows-1250']='latin2';
		$mysql_charsets['iso-8859-7']='latin7';
		$mysql_charsets['iso-8859-8-i']='hebrew';
		$mysql_charsets['iso-8859-8']='hebrew';
		$mysql_charsets['sjis']='sjis';
		$mysql_charsets['windows-1257']='latin7';
		$mysql_charsets['iso-8859-13']='latin7';
		$mysql_charsets['cp-866']='cp1251';
		$mysql_charsets['iso-8859-5']='latin5';
		$mysql_charsets['koi8-u']='koi8r';
		$mysql_charsets['windows-1252']='latin1';
		$mysql_charsets['tis-620']='tis620';
		$mysql_charsets['iso-8859-9']='latin5';
		$mysql_charsets['windows-1256']='cp1256';
		$mysql_charsets['georgian-ps']='geostd8';
		$mysql_charsets['euc-jp']='eucjpms';
		$mysql_charsets['euc-kr']='euckr';
		$mysql_charsets['iso-8859-6']='cp1256';
		$mysql_charsets['windows-1258']='latin1'; //No better match
		// perform a number of fatality checks, then die gracefully
		if (!function_exists( 'mysql_connect' )) $this->forceOffline(1);  
		if (!($this->_resource = @mysql_connect( $host, $user, $pass ))) $this->forceOffline(2);
		if (!mysql_select_db($db)) $this->forceOffline(3);
		$this->_table_prefix = $table_prefix;
		if(floatval(mysql_get_client_info())>=4.1){
			$charset=isset($charset)?$charset:'utf-8';
			$charset = isset($configuration)?$configuration->current_language->charset:$charset;
			$cs=$mysql_charsets[$charset];
			mysql_query( "SET CHARSET '" .$cs. "'" );
		}
	}

	function forceOffline ($error_number) {
			$mosSystemError = $error_number;
			$basePath = dirname( __FILE__ );
			include $basePath . '/configuration.php';
			// include $basePath . '/../offline.php';
			exit();
	}
	
	function getNullDate () {
	    return $this->_null_date;
	}
	/**
	* @param int
	*/
	function debug( $level ) {
	    $this->_debug = intval( $level );
	}

	function debug_trace () {
		trigger_error( $this->_errorNum, E_USER_NOTICE );
		//echo "<pre>" . $this->_sql . "</pre>\n";
		if (function_exists('debug_backtrace')) {
			foreach(debug_backtrace() as $back) {
			    if (@$back['file']) {
				    echo '<br />'.$back['file'].':'.$back['line'];
				}
			}
		}
	}
	/**
	* @return int The error number for the most recent query
	*/
	function getErrorNum() {
		return $this->_errorNum;
	}
	/**
	* @return string The error message for the most recent query
	*/
	function getErrorMsg() {
		return str_replace( array( "\n", "'" ), array( '\n', "\'" ), $this->_errorMsg );
	}
	/**
	* Get a database escaped string
	* @return string
	*/
	function getEscaped( $text ) {
	    if (phpversion() < '4.3.0') {
	        return mysql_escape_string( $text );
	    } else {
	        return mysql_real_escape_string( $text );
	    }
	}
	/**
	* Get a quoted database escaped string
	* @return string
	*/
	function Quote( $text ) {
	    if (phpversion() < '4.3.0') {
	        return '\'' . mysql_escape_string( $text ) . '\'';
	    } else {
	        return '\'' . mysql_real_escape_string( $text ) . '\'';
	    }
	}
	/**
	* Sets the SQL query string for later execution.
	*
	* @param string The SQL query
	*/
	function setBareQuery ($sql) {
		$this->_sql = $sql;
	}
	/**
	* Sets the SQL query string for later execution.
	*
	* This function replaces a string identifier <var>$prefix</var> with the
	* string held is the <var>_table_prefix</var> class variable.
	*
	* @param string The SQL query
	* @param string The common table prefix
	*/
	function setQuery( $sql, $prefix='#__' ) {
		$this->setBareQuery ($this->replacePrefix($sql, $prefix));
//      This is maintenance code for catching particular SQL statements
//		if (strpos($this->_sql,'SELECT menutype') === 0) debug_print_backtrace();
	}

	/**
	 * This function replaces a string identifier <var>$prefix</var> with the
	 * string held is the <var>_table_prefix</var> class variable.
	 *
	 * @param string The SQL query
	 * @param string The common table prefix
	 * @author thede, David McKinnis
	 */
	function replacePrefix ($sql, $prefix='#__') {
		$done = '';
		while (strlen($sql)) {
			$single = preg_match("/\'([^\\\']|\\.)*'/", $sql,$matches_single,PREG_OFFSET_CAPTURE);
			if ($double = preg_match('/\"([^\\\"]|\\.)*"/', $sql,$matches_double,PREG_OFFSET_CAPTURE) OR $single) {
				if ($single == 0 OR ($double AND $matches_double[0][1] < $matches_single[0][1])) {
					$done .= str_replace($prefix, $this->_table_prefix, substr($sql,0,$matches_double[0][1])).$matches_double[0][0];
					$sql = substr($sql,$matches_double[0][1]+strlen($matches_double[0][0]));
				}
				else {
					$done .= str_replace($prefix, $this->_table_prefix, substr($sql,0,$matches_single[0][1])).$matches_single[0][0];
					$sql = substr($sql,$matches_single[0][1]+strlen($matches_single[0][0]));
				}
			}
			else return $done.str_replace($prefix, $this->_table_prefix,$sql);
		}
		return $done;
	}
	/**
	* @return string The current value of the internal SQL vairable
	*/
	function getQuery($sql='') {
		if ($sql == '') $sql = $this->_sql;
		return "<pre>" . htmlspecialchars( $sql ) . "</pre>";
	}
	/**
	* Execute the query
	* @return mixed A database resource if successful, FALSE if not.
	*/
	function query($sql = '') {
		global $mosConfig_debug;
		if ($sql == '') $sql = $this->_sql;
		if ($this->_debug) $this->_log[] = $sql;
		if ($this->_cursor = mysql_query($sql, $this->_resource)) {
			$this->_errorNum = 0;
			$this->_errorMsg = '';
			return $this->_cursor;
		}
		else {
			$this->_errorNum = mysql_errno( $this->_resource );
			$this->_errorMsg = mysql_error( $this->_resource )." SQL=$sql";
			if ($this->_debug) $this->debug_trace();
			/*
			* ir al offline
			*
			*/		
			//$this->forceOffline(4);
            //mosRedirect( "offline.php" );
			return false;
		}
	}

	function query_batch( $abort_on_error=true, $p_transaction_safe = false) {
		$this->_errorNum = 0;
		$this->_errorMsg = '';
		if ($p_transaction_safe) {
			$si = mysql_get_server_info();
			preg_match_all( "/(\d+)\.(\d+)\.(\d+)/i", $si, $m );
			$prefix = '';
			if ($m[1] >= 4) $prefix = 'START TRANSACTION; ';
			elseif ($m[2] >= 23) {
				if ($m[3] >= 19) $prefix = 'BEGIN WORK; ';
				elseif ($m[3] >= 17) $prefix = 'BEGIN; ';
			}
			if ($prefix) $this->_sql = $prefix.$this->_sql.'; COMMIT;';
		}
		$query_split = preg_split ("/[;]+/", $this->_sql);
		$error = 0;
		foreach ($query_split as $command_line) {
			$command_line = trim( $command_line );
			if ($command_line != '') {
				if (!$this->query($command_line)) {
					$error = 1; echo 'xxx ';
					if ($abort_on_error) {
						return $this->_cursor;
					}
				}
			}
		}
		return $error ? false : true;
	}

	/**
	* Diagnostic function
	*/
	function explain() {
		if (!($cur = $this->query("EXPLAIN ".$this->_sql))) return null;
		$headline = $header = $body = '';
		$buf = '<table cellspacing="1" cellpadding="2" border="0" bgcolor="#000000" align="center">';
		$buf .= $this->getQuery("EXPLAIN ".$this->_sql);
		while ($row = mysql_fetch_assoc($cur)) {
			$body .= "<tr>";
			foreach ($row as $k=>$v) {
				if ($headline == '') $header .= "<th bgcolor=\"#ffffff\">$k</th>";
				$body .= "<td bgcolor=\"#ffffff\">$v</td>";
			}
			$headline = $header;
			$body .= "</tr>";
		}
		$buf .= "<tr>$headline</tr>$body</table><br />&nbsp;";
		mysql_free_result( $cur );
		return "<div style=\"background-color:#FFFFCC\" align=\"left\">$buf</div>";
	}
	/**
	* @return int The number of rows returned from the most recent query - SELECT only
	*/
	function getNumRows( $cur=null ) {
		return mysql_num_rows( $cur ? $cur : $this->_cursor );
	}

	/**
	* @return int The number of rows affected by the most recent query - INSERT, UPDATE, DELETE
	*/
	function getAffectedRows(  ) {
		return mysql_affected_rows( $this->_resource );
	}

	/**
	* Load an array of retrieved database objects or values
	* @param int Database cursor
	* @param string The field name of a primary key
	* @return array If <var>key</var> is empty as sequential list of returned records.
	* If <var>key</var> is not empty then the returned array is indexed by the value
	* the database key.  Returns <var>null</var> if the query fails.
	*/
	function &retrieveResults ($key='', $max=0, $result_type='row') {
		$results = array();
		$sql_function = 'mysql_fetch_'.$result_type;
		if ($cur = $this->query()) {
			while ($row = $sql_function($cur)) {
				if ($key != '') {
					if ( is_array($row) ) {
						$results[$row[$key]] = $row;
					} else {
						$results[$row->$key] = $row;
					}
				} else {
					$results[] = $row;
				}
				if ($max AND count($results) >= $max) break;
			}
			mysql_free_result($cur);
		}
		return $results;
	}
	/**
	* This method loads the first field of the first row returned by the query.
	*
	* @return The value returned in the query or null if the query failed.
	*/
	function loadResult() {
		$results =& $this->retrieveResults('', 1, 'row');
		if (count($results)) return $results[0][0];
		else return null;
	}

	/**
	* Load an array of single field results into an array
	*/
	function loadResultArray($numinarray = 0) {
		$results =& $this->retrieveResults('', 0, 'row');
		$values = array();
		foreach ($results as $result) $values[] = $result[$numinarray];
		if (count($values)) return $values;
		else return null;
	}
	/**
	* Load a assoc list of database rows
	* @param string The field name of a primary key
	* @return array If <var>key</var> is empty as sequential list of returned records.
	*/
	function loadAssocList( $key='' ) {
		$results =& $this->retrieveResults($key, 0, 'assoc');
		if (count($results)) return $results;
		else return null;
	}
	/**
	* Copy the named array content into the object as properties
	* only existing properties of object are filled. when undefined in hash, properties wont be deleted
	* @param array the input array
	* @param obj byref the object to fill of any class
	* @param string
	* @param boolean
	*/
	function mosBindArrayToObject( $array, &$obj, $ignore='', $prefix=NULL, $checkSlashes=true ) {
		if (!is_array($array) OR !is_object($obj)) return false;
		if ($prefix == null) $prefix = '';
		foreach (get_object_vars($obj) as $k => $v) {
			if( substr( $k, 0, 1 ) != '_' AND strpos($ignore, $k) === false) {
				if (isset($array[$prefix.$k])) {
					$obj->$k = ($checkSlashes AND get_magic_quotes_gpc()) ? $this->mosStripslashes( $array[$prefix.$k] ) : $array[$prefix.$k];
				}
			}
		}
		return true;
	}

	/**
	* Strip slashes from strings or arrays of strings
	* @param value the input string or array
	*/
	function mosStripslashes(&$value) {
	    if (is_string($value)) $ret = stripslashes($value);
		else {
		    if (is_array($value)) {
		        $ret = array();
		        while (list($key,$val) = each($value)) {
		            $ret[$key] = $this->mosStripslashes($val);
		        } // while
		    } else $ret = $value;
		} // if
	    return $ret;
	} // mosStripSlashes

	/**
	* This global function loads the first row of a query into an object
	*
	* If an object is passed to this function, the returned row is bound to the existing elements of <var>object</var>.
	* If <var>object</var> has a value of null, then all of the returned query fields returned in the object.
	* @param string The SQL query
	* @param object The address of variable
	*/
	function loadObject( &$object ) {
		if ($object != null) {
			$results =& $this->retrieveResults('', 1, 'assoc');
			if (count($results)) {
				$this->mosBindArrayToObject($results[0], $object, null, null, false);
				return true;
			}
		}
		else {
			$results =& $this->retrieveResults('', 1, 'object');
			if (count($results)) {
				$object = $results[0];
				return true;
			}
			else $object = null;
		}
		return false;
	}
	/**
	* Load a list of database objects
	* @param string The field name of a primary key
	* @return array If <var>key</var> is empty as sequential list of returned records.
	* If <var>key</var> is not empty then the returned array is indexed by the value
	* the database key.  Returns <var>null</var> if the query fails.
	*/
	function loadObjectList( $key='' ) {
		$results =& $this->retrieveResults($key, 0, 'object');
		if (count($results)) return $results;
		else return null;
	}
	/**
	* @return The first row of the query.
	*/
	function loadRow() {
		$results =& $this->retrieveResults('', 1, 'row');
		if (count($results)) return $results[0];
		else return null;
	}
	/**
	* Load a list of database rows (numeric column indexing)
	* @param string The field name of a primary key
	* @return array If <var>key</var> is empty as sequential list of returned records.
	* If <var>key</var> is not empty then the returned array is indexed by the value
	* the database key.  Returns <var>null</var> if the query fails.
	*/
	function loadRowList( $key='' ) {
		$results =& $this->retrieveResults('', 0, 'row');
		if (count($results)) return $results;
		else return null;
	}

	/**
	* Document::db_insertObject()
	*
	* { Description }
	*
	* @param [type] $keyName
	* @param [type] $verbose
	*/
	function insertObject( $table, &$object, $keyName = NULL, $verbose=false ) {
		$fmtsql = "INSERT INTO $table ( %s ) VALUES ( %s ) ";
		$fmtsql = $this->replacePrefix($fmtsql);
		$fields = array();
		foreach (get_object_vars( $object ) as $k => $v) {
			if (is_array($v) OR is_object($v) OR $v === NULL OR $k[0] == '_') continue;
			$fields[] = "`$k`";
			$values[] = "'" . $this->getEscaped( $v ) . "'";
		}
		if (!isset($fields)) die ('class database method insertObject - no fields');
		$this->setBareQuery( sprintf( $fmtsql, implode( ",", $fields ), implode( ",", $values ) ) );
		($verbose) && print "$sql<br />\n";
		if (!$this->query()) return false;
		$id = mysql_insert_id();
		($verbose) && print "id=[$id]<br />\n";
		if ($keyName && $id) $object->$keyName = $id;
		return true;
	}

	/**
	* Document::db_updateObject()
	*
	* { Description }
	*
	* @param [type] $updateNulls
	*/
	function updateObject( $table, &$object, $keyName, $updateNulls=true ) {
		$fmtsql = "UPDATE $table SET %s WHERE %s";
		$fmtsql = $this->replacePrefix($fmtsql);
		$tmp = array();
		foreach (get_object_vars( $object ) as $k => $v) {
			if (is_array($v) OR is_object($v) OR $k[0] == '_' OR ($v === null AND !$updateNulls)) continue;
			if( $k == $keyName ) { // PK not to be updated
				$where = "$keyName='" . $this->getEscaped( $v ) . "'";
				continue;
			}
			if ($v) $v = $this->getEscaped($v);
			$tmp[] = "`$k`='$v'";
		}
		if (!isset($tmp)) return true;
		if (!isset($where)) die ('database class updateObject method - no key value');
		$this->setBareQuery( sprintf( $fmtsql, implode( ",", $tmp ) , $where ) );
		return $this->query();
	}

	/**
	* @param boolean If TRUE, displays the last SQL statement sent to the database
	* @return string A standised error message
	*/
	function stderr( $showSQL = false ) {
		return "DB function failed with error number $this->_errorNum"
		."<br /><font color=\"red\">$this->_errorMsg</font>"
		.($showSQL ? "<br />SQL = <pre>$this->_sql</pre>" : '');
	}

	function insertid()
	{
		return mysql_insert_id();
	}

	function getVersion()
	{
		return mysql_get_server_info();
	}

	/**
	* Fudge method for ADOdb compatibility
	*/
	function GenID( $foo1=null, $foo2=null ) {
		return '0';
	}
	/**
	* @return array A list of all the tables in the database
	*/
	function getTableList() {
		$this->setQuery( 'SHOW tables' );
		$this->query();
		return $this->loadResultArray();
	}
	/**
	* @param array A list of table names
	* @return array A list the create SQL for the tables
	*/
	function getTableCreate( $tables ) {
		$result = array();

		foreach ($tables as $tblval) {
			$this->setQuery( 'SHOW CREATE table ' . $tblval );
			$this->query();
			$result[$tblval] = $this->loadResultArray( 1 );
		}

		return $result;
	}
	/**
	* @param array A list of table names
	* @return array An array of fields by table
	*/
	function getTableFields( $tables ) {
		$result = array();

		foreach ($tables as $tblval) {
			$this->setQuery( 'SHOW FIELDS FROM ' . $tblval );
			$this->query();
			$fields = $this->loadObjectList();
			foreach ($fields as $field) {
				$result[$tblval][$field->Field] = preg_replace("/[(0-9)]/",'', $field->Type );
			}
		}

		return $result;
	}

	function displayLogged () {
		echo count($this->_log).' queries executed';
		echo '<pre>';
	 	foreach ($this->_log as $k=>$sql) {
	 	    echo $k+1 . "\n" . $sql . '<hr />';
		}
	}

	/* Helper method - maybe should go into database itself */
	function doSQL ($sql) {
		$this->setQuery($sql);
		if (!$this->query()) {
			echo "<script> alert('".$this->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}
	}

	/* Helper method - maybe could go into database itself */
	function &doSQLget ($sql, $classname) {
		$this->setQuery($sql);
		$rows = $this->loadObjectList();
		$target = get_class_vars($classname);
		if ($rows) {
			foreach ($rows as $row) {
				$next = new $classname(0);
				foreach ($target as $field=>$value) {
					if (isset($row->$field)) $next->$field = $row->$field;
				}
				$result[] = $next;
			}
		}
		else $result = array();
		return $result;
	}


}

class mamboDatabase extends database {

	function mamboDatabase () {
		global $mosConfig_host,$mosConfig_user,$mosConfig_password, $mosConfig_db,$mosConfig_dbprefix;
		$host =$mosConfig_host;
		$user = $mosConfig_user;
		$pw = $mosConfig_password;
		$db = $mosConfig_db;
		$prefix = $mosConfig_dbprefix;
		parent::database($host, $user, $pw, $db, $prefix);
	}

	function &getInstance () {
		static $instance;
		if (!is_object($instance)) $instance = new mamboDatabase();
		return $instance;
	}
}

/**
* mosDBAbstractRow Abstract Class.
* @abstract
* @package Mambo
* @subpackage Database
*
* Parent classes to all database derived objects.  Customisation will generally
* not involve tampering with this object.
* @package Mambo
* @author Martin Brampton counterpoint@mambo-foundation.org
*/
class mosDBAbstractRow {
	/** @var string Name of the table in the db schema relating to child class */
	var $_tbl = '';
	/** @var string Name of the primary key field in the table */
	var $_tbl_key = '';
	/** @var string Error message */
	var $_error = '';

	/**
	*	Object constructor to set table and key field
	*
	*	Can be overloaded/supplemented by the child class
	*	@param string $table name of the table in the db schema relating to child class
	*	@param string $key name of the primary key field in the table
	*/
	function mosDBAbstractRow ($table='', $keyname='id', $db='') {
		if ($table) $this->_tbl = $table;
		else $this->_tbl = $this->tableName();
		$this->_tbl_key = $keyname;
		if (is_object($db)) $this->_db = $db;
	}

	/**
	*	generic check method
	*
	*	can be overloaded/supplemented by the child class
	*	@return boolean True if the object is ok
	*/
	function check() {
		return true;
	}

	/**
	* Checks if this object lacks the property given by the parameter
	* @param string The name of the property
	* @return bool
	*/
	function lacks( $property ) {
		$thisclass = get_class($this);
		if (array_key_exists( $property, get_class_vars($thisclass) )) return false;
		$this->_error = T_(sprintf('WARNING: %s does not support %s.', $thisclass, $property));
		return true;
	}

	/**
	/* Move a database row object up or down through the ordering
	/* @param int positive to move up, negative to move down
	/* @param string Additional conditions on the WHERE clause to limit the effect
	*/
	function move( $direction, $where='' ) {
		$compops = array (-1 => '<', 0 => '=', 1 => '>');
		$relation = $compops[($direction>0)-($direction<0)];
		$ordering = ($relation == '<' ? 'DESC' : 'ASC');
		$k = $this->_tbl_key;
		$o1 = $this->ordering;
		$k1 = $this->$k;
		$database = isset($this->_db) ? $this->_db : mamboDatabase::getInstance();
		$sql = "SELECT $k, ordering FROM $this->_tbl WHERE ordering $relation $o1";
		$sql .= ($where ? "\n AND $where" : '').' ORDER BY ordering '.$ordering.' LIMIT 1';
		$database->setQuery( $sql );
		if ($database->loadObject($row)) {
			$o2 = $row->ordering;
			$k2 = $row->$k;
			$sql = "UPDATE $this->_tbl SET ordering = (ordering=$o1)*$o2 + (ordering=$o2)*$o1 WHERE $k = $k1 OR $k = $k2";
			$database->doSQL($sql);
		}
	}
	/**
	* Compacts the ordering sequence of the selected records
	* @param string Additional conditions on WHERE clause to limit ordering to a particular subset of records
	*/
	function updateOrder( $where='', $cfid=null, $order=null ) {
		if ($this->lacks('ordering')) return false;
		$k = $this->_tbl_key;
		if ($this->_tbl == "#__content_frontpage") $order2 = ", content_id DESC";
		else $order2 = "";

		$database = isset($this->_db) ? $this->_db : mamboDatabase::getInstance();
		
		if (!is_null($cfid) AND !is_null($order)) {
			foreach ($cfid as $i=>$id) {
				$o = intval($order[$i]);
				$set[] = "(id=$id)*$o";
			}
			$sql = "UPDATE $this->_tbl SET ordering = ".implode(' + ', $set).' WHERE id IN ('.implode(',', $cfid).')';
			$database->doSQL($sql);
		}
		
		$sql = "SELECT $k, ordering FROM $this->_tbl "
		. ($where ? "\nWHERE $where" : '')
		. "\nORDER BY ordering$order2";
		$database->setQuery($sql);
		if (!$rows = $database->loadObjectList()) {
			$this->_error = $database->getErrorMsg();
			return false;
		}
		$i = 1;
		foreach ($rows as $row) {
			$sql = "UPDATE $this->_tbl SET ordering=$i WHERE $k = ".$row->$k;
			$database->doSQL($sql);
			$i++;
		}
		return true;
	}

}
	

/**
* mosDBTable Abstract Class.
* @abstract
* @package Mambo
* @subpackage Database
*
* Parent classes to all database derived objects.  Customisation will generally
* not involve tampering with this object.
* @package Mambo
* @author Andrew Eddie <eddieajau@users.sourceforge.net
*/
class mosDBTable extends mosDBAbstractRow {
	/** @var mosDatabase Database connector */
	var $_db = null;

	/**
	 *	@return bool True if DB query failed.  Sets the error message
	 */
	function queryTestFailure () {
		if ($this->_db->query()) return false;
		$this->_error = $this->_db->getErrorMsg();
		return true;
	}
	/**
	 * Filters public properties
	 * @access protected
	 * @param array List of fields to ignore
	 */
	function filter( $ignoreList=null ) {
		$callcheck = array('InputFilter', 'process');
		if (!is_callable($callcheck)) require_once(mamboCore::get('mosConfig_absolute_path').'/includes/phpInputFilter/class.inputfilter.php');
		// specific filters
		$iFilter =& new InputFilter();
		if (is_array($ignoreList)) foreach ($this->getPublicProperties() as $k) {
			if (!in_array($k, $ignoreList)) $this->$k = $iFilter->process($this->$k);
		}
		else foreach ($this->getPublicProperties() as $k) $this->$k = $iFilter->process($this->$k);
	}
	/**
	 *	@return string Returns the error message
	 */
	function getError() {
		return $this->_error;
	}
	/**
	* Gets the value of the class variable
	* @param string The name of the class variable
	* @return mixed The value of the class var (or null if no var of that name exists)
	*/
	function get( $_property ) {
		if(isset( $this->$_property )) return $this->$_property;
		else return null;
	}
	/**
	 * Returns an array of public properties
	 * @return array
	 */
	function getPublicProperties() {
		static $cache = null;
		if (is_null( $cache )) {
			$cache = array();
			foreach (get_class_vars( get_class( $this ) ) as $key=>$val) {
				if (substr( $key, 0, 1 ) != '_') {
					$cache[] = $key;
				}
			}
		}
		return $cache;
	}
	/**
	* Set the value of the class variable
	* @param string The name of the class variable
	* @param mixed The value to assign to the variable
	*/
	function set( $_property, $_value ) {
		$this->$_property = $_value;
	}
	/**
	*	binds a named array/hash to this object
	*
	*	can be overloaded/supplemented by the child class
	*	@param array $hash named array
	*	@return null|string	null is operation was satisfactory, otherwise returns an error
	*/
	function bind( $array, $ignore="" ) {
		$database =& mamboDatabase::getInstance();
		if (is_array($array)) return $database->mosBindArrayToObject($array, $this, $ignore);
		$this->_error = strtolower(get_class( $this ))."::bind failed.";
		return false;
	}

	/**
	*	binds an array/hash to this object
	*	@param int $oid optional argument, if not specifed then the value of current key is used
	*	@return any result from the database operation
	*/
	function load( $oid=null ) {
		$k = $this->_tbl_key;
		if ($oid !== null) {
			$this->$k = $this->_db->getEscaped($oid);
		}	
		if ($this->$k === null) return false;
		$this->_db->setQuery("SELECT * FROM $this->_tbl WHERE $this->_tbl_key='".$this->$k."'" );
		return $this->_db->loadObject($this);
	}

	/**
	* Inserts a new row if id is zero or updates an existing row in the database table
	*
	* Can be overloaded/supplemented by the child class
	* @param boolean If false, null object variables are not updated
	* @return null|string null if successful otherwise returns and error message
	*/
	function store( $updateNulls=false ) {
		$k = $this->_tbl_key;
		global $migrate;
		if( $this->$k && !$migrate) $ret = $this->_db->updateObject( $this->_tbl, $this, $this->_tbl_key, $updateNulls );
		else $ret = $this->_db->insertObject( $this->_tbl, $this, $this->_tbl_key );
		if( !$ret ) {
			$this->_error = strtolower(get_class( $this ))."::store failed <br />" . $this->_db->getErrorMsg();
			return false;
		} else return true;
	}

	/**
	*	Default delete method
	*
	*	can be overloaded/supplemented by the child class
	*	@return true if successful otherwise returns and error message
	*/
	function delete( $oid=null ) {
		$k = $this->_tbl_key;
		if ($oid) $this->$k = intval( $oid );
		$this->_db->setQuery( "DELETE FROM $this->_tbl WHERE $this->_tbl_key = '".$this->$k."'" );
		if ($this->queryTestFailure()) return false;
		return true;
	}

	function checkout( $who, $oid=null ) {
		if ($this->lacks('checked_out')) return false;
		$k = $this->_tbl_key;
		if ($oid !== null) $this->$k = $oid;
		$time = date( "%Y-%m-%d H:i:s" );
		if (intval( $who )) {
			// new way of storing editor, by id
			$this->_db->setQuery( "UPDATE $this->_tbl"
			. "\nSET checked_out='$who', checked_out_time='$time'"
			. "\nWHERE $this->_tbl_key='".$this->$k."'"
			);
		} else {
			// old way of storing editor, by name
			$this->_db->setQuery( "UPDATE $this->_tbl"
			. "\nSET checked_out='1', checked_out_time='$time', editor='".$who."' "
			. "\nWHERE $this->_tbl_key='".$this->$k."'"
			);
		}
		return $this->_db->query();
	}

	function checkin( $oid=null ) {
		if ($this->lacks('checked_out')) return false;
		$k = $this->_tbl_key;
		if ($oid !== null) $this->$k = $oid;
		$time = date("H:i:s");
		$this->_db->setQuery( "UPDATE $this->_tbl"
		. "\nSET checked_out='0', checked_out_time='0000-00-00 00:00:00'"
		. "\nWHERE $this->_tbl_key='".$this->$k."'"
		);
		return $this->_db->query();
	}

	function hit( $oid=null ) {
		$k = $this->_tbl_key;
		if ($oid !== null) $this->$k = intval( $oid );
		$key = $this->$k;
		$this->_db->setQuery( "UPDATE $this->_tbl SET hits=(hits+1) WHERE $this->_tbl_key='$key'" );
		$this->_db->query();

		if (mamboCore::get('mosConfig_enable_log_items')) {
			$now = date( "Y-m-d" );
			$this->_db->setQuery( "SELECT hits"
			. "\nFROM #__core_log_items"
			. "\nWHERE time_stamp='$now' AND item_table='$this->_tbl' AND item_id='$key'"
			);
			$hits = intval( $this->_db->loadResult() );
			if ($hits) $this->_db->setQuery( "UPDATE #__core_log_items SET hits=(hits+1)"
				. "\nWHERE time_stamp='$now' AND item_table='$this->_tbl' AND item_id='".$this->$k."'"
				);
			else $this->_db->setQuery( "INSERT INTO #__core_log_items VALUES"
				. "\n('$now','$this->_tbl','".$this->$k."','1')"
				);
			$this->_db->query();
		}
	}

	/**
	* Generic save function
	* @param array Source array for binding to class vars
	* @param string Filter for the order updating
	* @returns TRUE if completely successful, FALSE if partially or not succesful.
	*/
	function save( $source, $order_filter ) {
		if (!$this->bind($_POST) OR !$this->check() OR !$this->store()OR !$this->checkin()) return false;
		$filter_value = $this->$order_filter;
		$this->updateOrder( $order_filter ? "`$order_filter`='$filter_value'" : "" );
		$this->_error = '';
		return true;
	}

	/**
	* Generic Publish/Unpublish function
	* @param array An array of id numbers
	* @param integer 0 if unpublishing, 1 if publishing
	* @param integer The id of the user performnig the operation
	*/
	function publish_array( $cid=null, $publish=1, $myid=0 ) {
		if (!is_array( $cid ) OR count( $cid ) < 1) {
			$this->_error = "No items selected.";
			return false;
		}
		$cids = implode( ',', $cid );
		$this->_db->setQuery( "UPDATE $this->_tbl SET published='$publish'"
		. "\nWHERE $this->_tbl_key IN ($cids) AND (checked_out=0 OR checked_out='$myid')"
		);
		if ($this->queryTestFailure()) return false;
		if (count( $cid ) == 1) $this->checkin( $cid[0] );
		return true;
	}

	/**
	* Export item list to xml
	* @param boolean Map foreign keys to text values
	*/
	function toXML( $mapKeysToText=false ) {
		$xml = '<record table="' . $this->_tbl . '"';
		if ($mapKeysToText) $xml .= ' mapkeystotext="true"';
		$xml .= '>';
		foreach (get_object_vars($this) as $k => $v) {
			if ($v === null OR is_array($v) OR is_object($v)) continue;
			if ($k[0] == '_') continue; // internal field
			$xml .= '<' . $k . '><![CDATA[' . $v . ']]></' . $k . '>';
		}
		$xml .= '</record>';
		return $xml;
	}
}

/**
* Abstract class for classes where the objects of the class can be relatively easily
*  stored in a single database table.  Can usually be adapted to more complex cases.
* Requires child classes to implement: tableName(), notSQL().
* tableName() must return the name of the database table, using #__ in the usual Mambo way
* notSQL() must return an array of strings, where each string is the name of a
*  variable that is NOT in the database table, or is not written explicitly,
*  e.g. the auto-increment key.  If this is the ONLY non-SQL field, then the
*  child class need not implement it, as that it is already in the abstract class.
* Child classes may implement timeStampField, in which case it must return the name
*  of a field that will have a timestamp placed in it whenever the DB is written.
*/

class mosTableEntry extends mosDBAbstractRow {

	/* Stores all POST data where the name matches an object variable name */
	function addPostData () {
		foreach (get_class_vars(get_class($this)) as $field=>$value) {
			if ($field!='id' AND $field[1] != '_' AND isset($_POST[$field])) {
				$this->$field = trim($_POST[$field]);
			}
		}
		$this->forceBools();
  	}

	/* Provided in case child class does not implement it.  Can force any values */
	/* within some limited range.  In particular, can force bools to be 0 or 1 */
	function forceBools () {
		return;
	}

	/* Updates an existing DB entry with the object's current values */
	function updateObjectDB () {
		$this->prepareValues();
		$database = mamboDatabase::getInstance();
		$database->doSQL($this->updateSQL());
	}

	/* Deletes the current object from the DB */
	function delete () {
		$table = $this->tableName();
		$sql = "DELETE FROM $table WHERE id=$this->id";
		$database = mamboDatabase::getInstance();
		$database->doSQL($sql);
	}

	/* Provided in case the child class does not provide a method for timeStampField */
	function timeStampField () {
		return '';
	}

	/* Provides SQL for updating the DB with the contents of the current object */
	function updateSQL () {
		$tabname = $this->tableName();
		$sql = "UPDATE $tabname SET %s WHERE id=$this->id";
		$exclude = $this->notSQL();
		foreach (get_class_vars(get_class($this)) as $field=>$value) {
			if (!in_array($field,$exclude) AND $field[0] != '_') $setter[] = $field."='".$this->$field."'";
		}
		$timestamp = $this->timeStampField();
		if ($timestamp) $setter[] = $timestamp."='".date('Y-m-d H:i:s')."'";
		return sprintf($sql,implode(',', $setter));
	}

	/* Default method for identifying fields not to be written to the DB */
	/* The child classes may override this and return more items in the array */
	function notSQL () {
		return array ('id');
	}

	/* Provides SQL to insert the current object into the DB */
	function insertSQL () {
		$tabname = $this->tableName();
		$sql = "INSERT INTO $tabname (%s) VALUES (%s)";
		$exclude = $this->notSQL();
		foreach (get_class_vars(get_class($this)) as $field=>$value) {
			if (!in_array($field,$exclude) AND $field[0] != '_') {
				$infields[] = $field;
				$values[] = "'".$this->$field."'";
			}
		}
		$timestamp = $this->timeStampField();
		if ($timestamp) {
			$infields[] = $timestamp;
			$values[] = "'".date('Y-m-d H:i:s')."'";
		}
		return sprintf($sql, implode(',', $infields), implode(',', $values));
	}

	/* Copies any matching fields from some arbitrary object into the current object */
	function setValues (&$anObject) {
		foreach (get_class_vars(get_class($this)) as $field=>$value) {
			if ($field != 'id' AND isset($anObject->$field)) $this->$field = $anObject->$field;
		}
	}

	/* Ensures values can safely be written to DB; assumes magic quotes forced off */
	function prepareValues () {
		$database = mamboDatabase::getInstance();
		foreach (get_class_vars(get_class($this)) as $field=>$value) {
			if (!is_numeric($this->$field) AND is_string($this->$field)) $this->$field = $database->getEscaped($this->$field);
		}
	}

	/* Takes some arbitrary SELECT type SQL and places the first or only result into the current object */
	function readDataBase($sql) {
		$database = mamboDatabase::getInstance();
		$database->setQuery( $sql );
		if (!$database->loadObject($this)) $this->id = 0;
	}

}
class mosHTML {
	function makeOption( $value, $text='', $value_name='value', $text_name='text' ) {
		$obj = new stdClass;
		$obj->$value_name = $value;
		$obj->$text_name = trim( $text ) ? $text : $value;
		return $obj;
	}

  function writableCell( $folder, $relative=1, $text='', $visible=1 ) {
	$writeable 		= '<b><font color="green">Se puede escribir</font></b>';
	$unwriteable 	= '<b><font color="red">No se puede escribir</font></b>';
	
  	echo '<tr>';
  	echo '<td class="item">';
	echo $text;
	if ( $visible ) {
		echo $folder . '/';
	}
	echo '</td>';
  	echo '<td align="left">';
	if ( $relative ) {
		echo is_writable( "../$folder" ) 	? $writeable : $unwriteable;
	} else {
		echo is_writable( "$folder" ) 		? $writeable : $unwriteable;
	}
	echo '</td>';
  	echo '</tr>';
  }

	/**
	* Generates an HTML select list
	* @param array An array of objects
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param string The name of the object variable for the option value
	* @param string The name of the object variable for the option text
	* @param mixed The key that is selected
	* @returns string HTML for the select list
	*/
	function selectList( &$arr, $tag_name, $tag_attribs, $key, $text, $selected=NULL ) {
		// check if array
		if ( is_array( $arr ) ) {
			reset( $arr );
		}

		$html 	= "\n<select name=\"$tag_name\" $tag_attribs>";
		$count 	= count( $arr );

		for ($i=0, $n=$count; $i < $n; $i++ ) {
			$k = $arr[$i]->$key;
			$t = $arr[$i]->$text;
			$id = ( isset($arr[$i]->id) ? @$arr[$i]->id : null);

			$extra = '';
			$extra .= $id ? " id=\"" . $arr[$i]->id . "\"" : '';
			if (is_array( $selected )) {
				foreach ($selected as $obj) {
					$k2 = $obj->$key;
					if ($k == $k2) {
						$extra .= " selected=\"selected\"";
						break;
					}
				}
			} else {
				$extra .= ($k == $selected ? " selected=\"selected\"" : '');
			}
			$html .= "\n\t<option value=\"".$k."\"$extra>" . $t . "</option>";
		}
		$html .= "\n</select>\n";

		return $html;
	}

	/**
	* Writes a select list of integers
	* @param int The start integer
	* @param int The end integer
	* @param int The increment
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @param string The printf format to be applied to the number
	* @returns string HTML for the select list
	*/
	function integerSelectList( $start, $end, $inc, $tag_name, $tag_attribs, $selected, $format="" ) {
		$start 	= intval( $start );
		$end 	= intval( $end );
		$inc 	= intval( $inc );
		$arr 	= array();

		for ($i=$start; $i <= $end; $i+=$inc) {
			$fi = $format ? sprintf( "$format", $i ) : "$i";
			$arr[] = mosHTML::makeOption( $fi, $fi );
		}

		return mosHTML::selectList( $arr, $tag_name, $tag_attribs, 'value', 'text', $selected );
	}

	/**
	* Writes a select list of month names based on Language settings
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @returns string HTML for the select list values
	*/
	function monthSelectList( $tag_name, $tag_attribs, $selected ) {
		$arr = array(
			mosHTML::makeOption( '01', _JAN ),
			mosHTML::makeOption( '02', _FEB ),
			mosHTML::makeOption( '03', _MAR ),
			mosHTML::makeOption( '04', _APR ),
			mosHTML::makeOption( '05', _MAY ),
			mosHTML::makeOption( '06', _JUN ),
			mosHTML::makeOption( '07', _JUL ),
			mosHTML::makeOption( '08', _AUG ),
			mosHTML::makeOption( '09', _SEP ),
			mosHTML::makeOption( '10', _OCT ),
			mosHTML::makeOption( '11', _NOV ),
			mosHTML::makeOption( '12', _DEC )
		);

		return mosHTML::selectList( $arr, $tag_name, $tag_attribs, 'value', 'text', $selected );
	}

	/**
	* Generates an HTML select list from a tree based query list
	* @param array Source array with id and parent fields
	* @param array The id of the current list item
	* @param array Target array.  May be an empty array.
	* @param array An array of objects
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param string The name of the object variable for the option value
	* @param string The name of the object variable for the option text
	* @param mixed The key that is selected
	* @returns string HTML for the select list
	*/
	function treeSelectList( &$src_list, $src_id, $tgt_list, $tag_name, $tag_attribs, $key, $text, $selected ) {

		// establish the hierarchy of the menu
		$children = array();
		// first pass - collect children
		foreach ($src_list as $v ) {
			$pt = $v->parent;
			$list = @$children[$pt] ? $children[$pt] : array();
			array_push( $list, $v );
			$children[$pt] = $list;
		}
		// second pass - get an indent list of the items
		$ilist = mosTreeRecurse( 0, '', array(), $children );

		// assemble menu items to the array
		$this_treename = '';
		foreach ($ilist as $item) {
			if ($this_treename) {
				if ($item->id != $src_id && strpos( $item->treename, $this_treename ) === false) {
					$tgt_list[] = mosHTML::makeOption( $item->id, $item->treename );
				}
			} else {
				if ($item->id != $src_id) {
					$tgt_list[] = mosHTML::makeOption( $item->id, $item->treename );
				} else {
					$this_treename = "$item->treename/";
				}
			}
		}
		// build the html select list
		return mosHTML::selectList( $tgt_list, $tag_name, $tag_attribs, $key, $text, $selected );
	}

	/**
	* Writes a yes/no select list
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @returns string HTML for the select list values
	*/
	function yesnoSelectList( $tag_name, $tag_attribs, $selected, $yes=_CMN_YES, $no=_CMN_NO ) {
		$arr = array(
		mosHTML::makeOption( '0', $no ),
		mosHTML::makeOption( '1', $yes ),
		);

		return mosHTML::selectList( $arr, $tag_name, $tag_attribs, 'value', 'text', $selected );
	}

	/**
	* Generates an HTML radio list
	* @param array An array of objects
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @param string The name of the object variable for the option value
	* @param string The name of the object variable for the option text
	* @returns string HTML for the select list
	*/
	function radioList( &$arr, $tag_name, $tag_attribs, $selected=null, $key='value', $text='text' ) {
		reset( $arr );
		$html = "";
		for ($i=0, $n=count( $arr ); $i < $n; $i++ ) {
			$k = $arr[$i]->$key;
			$t = $arr[$i]->$text;
			$id = ( isset($arr[$i]->id) ? @$arr[$i]->id : null);

			$extra = '';
			$extra .= $id ? " id=\"" . $arr[$i]->id . "\"" : '';
			if (is_array( $selected )) {
				foreach ($selected as $obj) {
					$k2 = $obj->$key;
					if ($k == $k2) {
						$extra .= " selected=\"selected\"";
						break;
					}
				}
			} else {
				$extra .= ($k == $selected ? " checked=\"checked\"" : '');
			}
			$html .= "\n\t<input type=\"radio\" name=\"$tag_name\" id=\"$tag_name$k\" value=\"".$k."\"$extra $tag_attribs />";
			$html .= "\n\t<label for=\"$tag_name$k\">$t</label>";
		}
		$html .= "\n";

		return $html;
	}

	/**
	* Writes a yes/no radio list
	* @param string The value of the HTML name attribute
	* @param string Additional HTML attributes for the <select> tag
	* @param mixed The key that is selected
	* @returns string HTML for the radio list
	*/
	function yesnoRadioList( $tag_name, $tag_attribs, $selected, $yes=_CMN_YES, $no=_CMN_NO ) {
		$arr = array(
			mosHTML::makeOption( '0', $no ),
			mosHTML::makeOption( '1', $yes )
		);

		return mosHTML::radioList( $arr, $tag_name, $tag_attribs, $selected );
	}

	/**
	* @param int The row index
	* @param int The record id
	* @param boolean
	* @param string The name of the form element
	* @return string
	*/
	function idBox( $rowNum, $recId, $checkedOut=false, $name='cid' ) {
		if ( $checkedOut ) {
			return '';
		} else {
			return '<input type="checkbox" id="cb'.$rowNum.'" name="'.$name.'[]" value="'.$recId.'" onclick="isChecked(this.checked);" />';
		}
	}

	function sortIcon( $base_href, $field, $state='none' ) {
		global $mosConfig_live_site;

		$alts = array(
			'none' 	=> _CMN_SORT_NONE,
			'asc' 	=> _CMN_SORT_ASC,
			'desc' 	=> _CMN_SORT_DESC,
		);
		$next_state = 'asc';
		if ($state == 'asc') {
			$next_state = 'desc';
		} else if ($state == 'desc') {
			$next_state = 'none';
		}

		$html = "<a href=\"$base_href&field=$field&order=$next_state\">"
		. "<img src=\"$mosConfig_live_site/images/M_images/sort_$state.png\" width=\"12\" height=\"12\" border=\"0\" alt=\"{$alts[$next_state]}\" />"
		. "</a>";
		return $html;
	}

	/**
	* Writes Close Button
	*/
	function CloseButton ( &$params, $hide_js=NULL ) {
		// displays close button in Pop-up window
		if ( $params->get( 'popup' ) && !$hide_js ) {
			?>
			<script language="javascript" type="text/javascript">
			<!--
			document.write('<div align="center" style="margin-top: 30px; margin-bottom: 30px;">');
			document.write('<a href="#" onclick="javascript:window.close();"><span class="small"><?php echo _PROMPT_CLOSE;?></span></a>');
			document.write('</div>');
			//-->
			</script>
			<?php
		}
	}

	/**
	* Writes Back Button
	*/
	function BackButton ( &$params, $hide_js=NULL ) {
		// Back Button
		if ( $params->get( 'back_button' ) && !$params->get( 'popup' ) && !$hide_js) {
			?>
			<div class="back_button">
				<a href='javascript:history.go(-1)'>
					<?php echo _BACK; ?></a>
			</div>
			<?php
		}
	}

	/**
	* Cleans text of all formating and scripting code
	*/
	function cleanText ( &$text ) {
		$text = preg_replace( "'<script[^>]*>.*?</script>'si", '', $text );
		$text = preg_replace( '/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is', '\2 (\1)', $text );
		$text = preg_replace( '/<!--.+?-->/', '', $text );
		$text = preg_replace( '/{.+?}/', '', $text );
		$text = preg_replace( '/&nbsp;/', ' ', $text );
		$text = preg_replace( '/&amp;/', ' ', $text );
		$text = preg_replace( '/&quot;/', ' ', $text );
		$text = strip_tags( $text );
		$text = htmlspecialchars( $text );

		return $text;
	}

	/**
	* Writes Print icon
	*/
	function PrintIcon( &$row, &$params, $hide_js, $link, $status=NULL ) {
		if ( $params->get( 'print' )  && !$hide_js ) {
			// use default settings if none declared
			if ( !$status ) {
				$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';
			}

			// checks template image directory for image, if non found default are loaded
			if ( $params->get( 'icons' ) ) {
				$image = mosAdminMenus::ImageCheck( 'printButton.png', '/images/M_images/', NULL, NULL, _CMN_PRINT, _CMN_PRINT );
			} else {
				$image = _ICON_SEP .'&nbsp;'. _CMN_PRINT. '&nbsp;'. _ICON_SEP;
			}

			if ( $params->get( 'popup' ) && !$hide_js ) {
				// Print Preview button - used when viewing page
				?>
				<script language="javascript" type="text/javascript">
				<!--
				document.write('<td align="right" width="100%" class="buttonheading">');
				document.write('<a href="#" onclick="javascript:window.print(); return false;" title="<?php echo _CMN_PRINT;?>">');
				document.write('<?php echo $image;?>');
				document.write('</a>');
				document.write('</td>');
				//-->
				</script>
				<?php
			} else {
				// Print Button - used in pop-up window
				?>
				<td align="right" width="100%" class="buttonheading">
					<a href="<?php echo $link; ?>" target="_blank" onclick="window.open('<?php echo $link; ?>','win2','<?php echo $status; ?>'); return false;" title="<?php echo _CMN_PRINT;?>">
						<?php echo $image;?></a>
				</td>
				<?php
			}
		}
	}

	/**
	* simple Javascript Cloaking
	* email cloacking
 	* by default replaces an email with a mailto link with email cloacked
	*/
	function emailCloaking( $mail, $mailto=1, $text='', $email=1 ) {
		// convert text
		$mail 			= mosHTML::encoding_converter( $mail );
		// split email by @ symbol
		$mail			= explode( '@', $mail );
		$mail_parts		= explode( '.', $mail[1] );
		// random number
		$rand			= rand( 1, 100000 );

		$replacement 	= "\n <script language='JavaScript' type='text/javascript'>";
		$replacement 	.= "\n <!--";
		$replacement 	.= "\n var prefix = '&#109;a' + 'i&#108;' + '&#116;o';";
		$replacement 	.= "\n var path = 'hr' + 'ef' + '=';";
		$replacement 	.= "\n var addy". $rand ." = '". @$mail[0] ."' + '&#64;';";
		$replacement 	.= "\n addy". $rand ." = addy". $rand ." + '". implode( "' + '&#46;' + '", $mail_parts ) ."';";

		if ( $mailto ) {
			// special handling when mail text is different from mail addy
			if ( $text ) {
				if ( $email ) {
					// convert text
					$text 			= mosHTML::encoding_converter( $text );
					// split email by @ symbol
					$text 			= explode( '@', $text );
					$text_parts		= explode( '.', $text[1] );
					$replacement 	.= "\n var addy_text". $rand ." = '". @$text[0] ."' + '&#64;' + '". implode( "' + '&#46;' + '", @$text_parts ) ."';";
				} else {
					$replacement 	.= "\n var addy_text". $rand ." = '". $text ."';";
				}
				$replacement 	.= "\n document.write( '<a ' + path + '\'' + prefix + ':' + addy". $rand ." + '\'>' );";
				$replacement 	.= "\n document.write( addy_text". $rand ." );";
				$replacement 	.= "\n document.write( '<\/a>' );";
			} else {
				$replacement 	.= "\n document.write( '<a ' + path + '\'' + prefix + ':' + addy". $rand ." + '\'>' );";
				$replacement 	.= "\n document.write( addy". $rand ." );";
				$replacement 	.= "\n document.write( '<\/a>' );";
			}
		} else {
			$replacement 	.= "\n document.write( addy". $rand ." );";
		}
		$replacement 	.= "\n //-->";
		$replacement 	.= '\n </script>';

		// XHTML compliance `No Javascript` text handling
		$replacement 	.= "<script language='JavaScript' type='text/javascript'>";
		$replacement 	.= "\n <!--";
		$replacement 	.= "\n document.write( '<span style=\'display: none;\'>' );";
		$replacement 	.= "\n //-->";
		$replacement 	.= "\n </script>";
		$replacement 	.= _CLOAKING;
		$replacement 	.= "\n <script language='JavaScript' type='text/javascript'>";
		$replacement 	.= "\n <!--";
		$replacement 	.= "\n document.write( '</' );";
		$replacement 	.= "\n document.write( 'span>' );";
		$replacement 	.= "\n //-->";
		$replacement 	.= "\n </script>";

		return $replacement;
	}

	function encoding_converter( $text ) {
		// replace vowels with character encoding
		$text 	= str_replace( 'a', '&#97;', $text );
		$text 	= str_replace( 'e', '&#101;', $text );
		$text 	= str_replace( 'i', '&#105;', $text );
		$text 	= str_replace( 'o', '&#111;', $text );
		$text	= str_replace( 'u', '&#117;', $text );

		return $text;
	}
}

define( "_MOS_NOTRIM", 0x0001 );
define( "_MOS_ALLOWHTML", 0x0002 );
define( "_MOS_ALLOWRAW", 0x0004 );
function mosGetParam( &$arr, $name, $def=null, $mask=0 ) {
	static $noHtmlFilter 	= null;
	static $safeHtmlFilter 	= null;

	$return = null;
	if (isset( $arr[$name] )) {
		$return = $arr[$name];

		if (is_string( $return )) {
			// trim data
			if (!($mask&_MOS_NOTRIM)) {
				$return = trim( $return );
			}

			if ($mask&_MOS_ALLOWRAW) {
				// do nothing
			} else if ($mask&_MOS_ALLOWHTML) {
				// do nothing - compatibility mode
			} else {
				// send to inputfilter
				if (is_null( $noHtmlFilter )) {
					$noHtmlFilter = new InputFilter( /* $tags, $attr, $tag_method, $attr_method, $xss_auto */ );
				}
				$return = $noHtmlFilter->process( $return );

				if (empty($return) && is_numeric($def)) {
				// if value is defined and default value is numeric set variable type to integer
					$return = intval($return);
				}
			}

			// account for magic quotes setting
			if (!get_magic_quotes_gpc()) {
				$return = addslashes( $return );
			}
		}

		return $return;
	} else {
		return $def;
	}
}
function mosRedirect( $url, $msg='' ) {

   global $mainframe;

    // specific filters
	$iFilter = new InputFilter();
	$url = $iFilter->process( $url );
	if (!empty($msg)) {
		$msg = $iFilter->process( $msg );
	}

	// Strip out any line breaks and throw away the rest
	$url = preg_split("/[\r\n]/", $url);
	$url = $url[0];

	if ($iFilter->badAttributeValue( array( 'href', $url ))) {
		$url = $GLOBALS['mosConfig_live_site'];
	}

	if (trim( $msg )) {
	 	if (strpos( $url, '?' )) {
			$url .= '&mosmsg=' . urlencode( $msg );
		} else {
			$url .= '?mosmsg=' . urlencode( $msg );
		}
	}

	if (headers_sent()) {
		echo "<script>document.location.href='$url';</script>\n";
	} else {
		@ob_end_clean(); // clear output buffer
		header( 'HTTP/1.1 301 Moved Permanently' );
		header( "Location: ". $url );
	}
	exit();
}


/**
* Function to create a mail object for futher use (uses phpMailer)
* @param string From e-mail address
* @param string From name
* @param string E-mail subject
* @param string Message body
* @return object Mail object
*/
function mosCreateMail( $from='', $fromname='', $subject, $body ) {
	global $mosConfig_absolute_path, $mosConfig_sendmail;
	global $mosConfig_smtpauth, $mosConfig_smtpuser;
	global $mosConfig_smtppass, $mosConfig_smtphost;
	global $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_mailer;

	$mail = new mosPHPMailer();

	$mail->PluginDir = $mosConfig_absolute_path .'/includes/phpmailer/';
	$mail->SetLanguage( 'en', $mosConfig_absolute_path . '/includes/phpmailer/language/' );
	$mail->CharSet 	= substr_replace(_ISO, '', 0, 8);
	$mail->IsMail();
	$mail->From 	= $from ? $from : $mosConfig_mailfrom;
	$mail->FromName = $fromname ? $fromname : $mosConfig_fromname;
	$mail->Mailer 	= $mosConfig_mailer;

	// Add smtp values if needed
	if ( $mosConfig_mailer == 'smtp' ) {
		$mail->SMTPAuth = $mosConfig_smtpauth;
		$mail->Username = $mosConfig_smtpuser;
		$mail->Password = $mosConfig_smtppass;
		$mail->Host 	= $mosConfig_smtphost;
	} else

	// Set sendmail path
	if ( $mosConfig_mailer == 'sendmail' ) {
		if (isset($mosConfig_sendmail))
			$mail->Sendmail = $mosConfig_sendmail;
	} // if

	$mail->Subject 	= $subject;
	$mail->Body 	= $body;

	return $mail;
}
/**
* Mail function (uses phpMailer)
* @param string From e-mail address
* @param string From name
* @param string/array Recipient e-mail address(es)
* @param string E-mail subject
* @param string Message body
* @param boolean false = plain text, true = HTML
* @param string/array CC e-mail address(es)
* @param string/array BCC e-mail address(es)
* @param string/array Attachment file name(s)
* @param string/array ReplyTo e-mail address(es)
* @param string/array ReplyTo name(s)
* @return boolean
*/
function mosMail( $from, $fromname, $recipient, $subject, $body, $mode=0, $cc=NULL, $bcc=NULL, $attachment=NULL, $replyto=NULL, $replytoname=NULL ) {
	global $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_debug;

	// Allow empty $from and $fromname settings (backwards compatibility)
	if ($from == '') {
		$from = $mosConfig_mailfrom;
	}
	if ($fromname == '') {
		$fromname = $mosConfig_fromname;
	}

	// Filter from, fromname and subject
	if (!JosIsValidEmail( $from ) || !JosIsValidName( $fromname ) || !JosIsValidName( $subject )) {
		return false;
	}

	$mail = mosCreateMail( $from, $fromname, $subject, $body );

	// activate HTML formatted emails
	if ( $mode ) {
		$mail->IsHTML(true);
	}

	if (is_array( $recipient )) {
		foreach ($recipient as $to) {
			if (!JosIsValidEmail( $to )) {
				return false;
			}
			$mail->AddAddress( $to );
		}
	} else {
		if (!JosIsValidEmail( $recipient )) {
			return false;
		}
		$mail->AddAddress( $recipient );
	}
	if (isset( $cc )) {
		if (is_array( $cc )) {
			foreach ($cc as $to) {
				if (!JosIsValidEmail( $to )) {
					return false;
				}
				$mail->AddCC($to);
			}
		} else {
			if (!JosIsValidEmail( $cc )) {
				return false;
			}
			$mail->AddCC($cc);
		}
	}
	if (isset( $bcc )) {
		if (is_array( $bcc )) {
			foreach ($bcc as $to) {
				if (!JosIsValidEmail( $to )) {
					return false;
				}
				$mail->AddBCC( $to );
			}
		} else {
			if (!JosIsValidEmail( $bcc )) {
				return false;
			}
			$mail->AddBCC( $bcc );
		}
	}
	if ($attachment) {
		if (is_array( $attachment )) {
			foreach ($attachment as $fname) {
				$mail->AddAttachment( $fname );
			}
		} else {
			$mail->AddAttachment($attachment);
		}
	}
	//Important for being able to use mosMail without spoofing...
	if ($replyto) {
		if (is_array( $replyto )) {
			reset( $replytoname );
			foreach ($replyto as $to) {
				$toname = ((list( $key, $value ) = each( $replytoname )) ? $value : '');
				if (!JosIsValidEmail( $to ) || !JosIsValidName( $toname )) {
					return false;
				}
				$mail->AddReplyTo( $to, $toname );
			}
        } else {
			if (!JosIsValidEmail( $replyto ) || !JosIsValidName( $replytoname )) {
				return false;
			}
			$mail->AddReplyTo($replyto, $replytoname);
		}
    }

	$mailssend = $mail->Send();

	if( $mosConfig_debug ) {
		//$mosDebug->message( "Mails send: $mailssend");
	}
	if( $mail->error_count > 0 ) {
		//$mosDebug->message( "The mail message $fromname <$from> about $subject to $recipient <b>failed</b><br /><pre>$body</pre>", false );
		//$mosDebug->message( "Mailer Error: " . $mail->ErrorInfo . "" );
	}
	return $mailssend;
} // mosMail

/**
 * Checks if a given string is a valid email address
 *
 * @param	string	$email	String to check for a valid email address
 * @return	boolean
 */
function JosIsValidEmail( $email ) {
	$valid = preg_match( '/^[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}$/', $email );

	return $valid;
}

/**
 * Checks if a given string is a valid (from-)name or subject for an email
 *
 * @since		1.0.11
 * @deprecated	1.5
 * @param		string		$string		String to check for validity
 * @return		boolean
 */
function JosIsValidName( $string ) {
	/*
	 * The following regular expression blocks all strings containing any low control characters:
	 * 0x00-0x1F, 0x7F
	 * These should be control characters in almost all used charsets.
	 * The high control chars in ISO-8859-n (0x80-0x9F) are unused (e.g. http://en.wikipedia.org/wiki/ISO_8859-1)
	 * Since they are valid UTF-8 bytes (e.g. used as the second byte of a two byte char),
	 * they must not be filtered.
	 */
	$invalid = preg_match( '/[\x00-\x1F\x7F]/', $string );
	if ($invalid) {
		return false;
	} else {
		return true;
	}
}



?>
