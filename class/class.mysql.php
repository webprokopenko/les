<?
Class Mysql{
    var $link, $result, $count;

    function connect($dbhost, $dbusername, $dbpassword, $dbname)
    {
        $this->link = mysql_pconnect($dbhost, $dbusername, $dbpassword);
        mysql_select_db($dbname);
        $query = "set character set utf8";
        mysql_query($query) or die(mysql_error());

        mysql_query('SET NAMES uff8');
        mysql_query('set session character_set_server=utf8');
        mysql_query('set session character_set_database=utf8');
        mysql_query('set session character_set_connection=utf8');
        mysql_query('set session character_set_results=utf8');
        mysql_query('set session character_set_client=utf8');
    }

    function query($query)
    {
        $this->result = mysql_query($query);
        if($this->result === FALSE)
        {
            return false;
        }else{
            return true;
        }

    }

    function fetch_one($query)
    {
        $this->query($query);
        return mysql_fetch_array($this->result);
    }

    function fetch_array($query)
    {
        $this->query($query);
        $row=array();
        while($str = mysql_fetch_array($this->result))
            $row[] = $str;
        $this->count = count($row);
        return $row;
    }

    function close()
    {
        mysql_close($this->link);
    }
}
?>