<?php


class DB 
{
    var $_dbConn = 0;
    var $_queryResource = 0;
    
    function DB(){
		include("DB_config.php");
		
        $dbConn = mysql_pconnect($_DB['host'], $_DB['username'], $_DB['password']);
		if (! $dbConn)
            die ("MySQL Connect Error");			
			
   		mysql_query("SET NAMES utf8");
			
		if (! mysql_select_db($_DB['dbname'], $dbConn))
            die ("MySQL Select DB Error");
			
        $this->_dbConn = $dbConn;
        return true;
    }
    
   /* function connect_db($host, $user, $pwd, $dbname)
    {
        $dbConn = mysql_connect($host, $user, $pwd);
        if (! $dbConn)
            die ("MySQL Connect Error");
        mysql_query("SET NAMES utf8");
        if (! mysql_select_db($_DB['dbname'], $dbConn))
            die ("MySQL Select DB Error");
        $this->_dbConn = $dbConn;
        return true;
    }*/
    
    function query($sql)
    {
        if (! $queryResource = mysql_query($sql, $this->_dbConn))
            die ("MySQL Query Error");
        $this->_queryResource = $queryResource;
        return $queryResource;        
    }
	
	function get_array($r='')
    {
		$result=array();
		while($result[] = mysql_fetch_assoc($r))
		{		}
        return $result;
    }
	
	function get_fetch($r='')
    {
		$result=mysql_fetch_assoc($r);
        return $result;
    }
    
    /** Get array return by MySQL */
    function fetch_array()
    {
        return mysql_fetch_array($this->_queryResource);//, MYSQL_ASSOC);
    }
    
    function get_num_rows()
    {
        return mysql_num_rows($this->_queryResource);
    }

    /** Get the cuurent id */    
    function get_insert_id()
    {
        return mysql_insert_id($this->_dbConn);
    } 
	
	/** Get the mysql_free_result true or false */
	function free_result(){
		return mysql_free_result($_dbConn);
	}
    
}
?>