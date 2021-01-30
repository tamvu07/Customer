<?php
require_once "config.php";

class connection
{
    private $result ;
    protected $con;

    public function __construct()
    {
        $this->con = new mysqli(sql_server, sql_user, sql_password, sql_database);
        $this->con->set_charset("utf8");
    }

    public function select($sql)
    {
        $this->result = $this->con->query($sql);
    }


}

?>