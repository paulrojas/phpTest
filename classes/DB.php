<?php

class DB {

    var $db;

    function DB($dbname, $username, $password) {
        $this->db = mysql_connect ('localhost', $username, $password)
        or die ("unable to connect to database server");

        mysql_select_db ($dbname, $this->db) or die ("could not select database");
    }

    function query($sql) {
        $result = mysql_query ($sql, $this->db) or die ("invalid query: " . mysql_error());
        return $result;
    }

    function fetch($sql) {
        $data = array();
        $result = $this->query($sql);

        while($row = mysql_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    function getone($sql) {
        $result = $this->query($sql);

        if (mysql_num_rows($result) == 0)
            $value = false;
        else
            $value = mysql_result($result, 0);
        return $value;
    }
}
