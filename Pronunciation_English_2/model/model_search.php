<?php
require_once "../database/connection.php";

class model_search extends connection
{
	function getID()
    {
        $sql = "select * from vocabulary order by ID DESC";
        $kq = $this->con->query($sql);
        if ($kq->num_rows > 0) return $kq;
        return $this->con->error();
    }

   function Count_ID_table_vocabulary()
    { 
        $sql = "SELECT COUNT(ID) as count FROM vocabulary ";
        $result = $this->con->query($sql);
            return $result;
    }













}
?>