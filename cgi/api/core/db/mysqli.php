<?php

class db_mysqli
{
    private $connid;
	private $dbname;
	private $querynum = 0;
	private $query = array();
	private $debug = 1;

    function __construct($dbhost, $dbuser, $dbpw, $dbname = '', $pconnect = 0, $charset = '') {
        $func = $pconnect == 1 ? 'mysqli_pconnect' : 'mysqli_connect';
        if(!$this->connid = $func($dbhost, $dbuser, $dbpw, $dbname)) {
            exit('Can not connect to MySQL server');
            return false;
        }
        mysqli_query($this->connid, "SET NAMES {$charset}");
        $this->dbname = $dbname;
    }

    function select($sql) {
    	$query = $this->query($sql);
		$result = array();
		while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
			$result[] = $row;
		}
		return $result;
	}

	function get_one($sql) {
		$data = $this->select($sql);
		return isset($data[0])?$data[0]:NULL;
	}

	function update($sql) {
		$this->query($sql);
		return mysqli_affected_rows($this->connid);
	}

	function insert($sql) {
		$this->query($sql);
		return mysqli_insert_id($this->connid);
	}

	function delete($sql) {
		$this->query($sql);
		return mysqli_affected_rows($this->connid);
	}

    function query($sql , $type = '') {
    	if ( empty($sql) ) return NULL;
		if (!($query = @mysqli_query($this->connid, $sql))) {
			echo $sql;
			exit('MySQL Query Error:' . $sql);
			return false;
		}
		$this->query[] = $sql;
		$this->querynum++;
		return $query;
	}

	function affected_rows() {
		return mysqli_affected_rows($this->connid);
	}
}