<?php
require_once "../database/connection.php";

class model extends connection
{
	function getID()
    {
        $sql = "select * from vocabulary order by ID DESC";
        $kq = $this->con->query($sql);
        if ($kq->num_rows > 0) return $kq;
        return $this->con->error();
    }

	function get_example($VO_ID)
    {
        $sql = "select * from example where VO_ID = $VO_ID";
        $kq = $this->con->query($sql);
        if ($kq->num_rows > 0) return $kq;
        return 0;
    }

    function insert_vocabulary($VO,$Ty,$Ph,$Tr,$Pr,$Im)
    {
/*        $VO_1 = base64_encode($VO);
        $Ty_1 = base64_encode($Ty);
        $Ph_1 = base64_encode($Ph);
        $Tr_1 = base64_encode($Tr);
        $Pr_1 = base64_encode($Pr);*/

        $VO_1 = str_replace("'", "^" , $VO);
        $Ty_1 = str_replace("'", "^" , $Ty);
        $Ph_1 = str_replace("'", "^" , $Ph);
        $Tr_1 = str_replace("'", "^" , $Tr);
        $Pr_1 = str_replace("'", "^" , $Pr);
       /* $Pr_2  = trim($Pr_1,".mp3");*/
        $Pr_2  = pathinfo($Pr_1,PATHINFO_FILENAME);

        $sql = "insert into vocabulary(vocabulary,type,phonetic,translate,pronunciation,image) values('$VO_1','$Ty_1','$Ph_1','$Tr_1','$Pr_2','$Im')";
                     $result = $this->con->query($sql);
                    if($result === true){
                        return 1;
                    }else return 0;
    }

    function insert_example($_VO_id,$_EX,$_TRL)
    {
        /*$_EX_1 = base64_encode($_EX);*/
        $_EX_1 = str_replace("'", "^" , $_EX);
        $_TRL_1 = str_replace("'", "^" , $_TRL);
        $sql = "insert into example(VO_ID,example_test,translate) values('$_VO_id','$_EX_1','$_TRL_1')";
                     $result = $this->con->query($sql);

                    if($result === true){
                        return 1;
                    }else return 0;
    }

    function get_one_vocabulary($_VO_id)
    {
        $sql = "select * from vocabulary where ID = $_VO_id";
        $kq = $this->con->query($sql);
        if ($kq->num_rows > 0) return $kq;
        return 0;
    }

    function  update_one_vocabulary_1($_VO_id,$_VO,$_Ty,$_Ph,$_Tr,$_Pr,$_Im)
    {
/*        $_VO_1 = base64_encode($_VO);
        $_Ty_1 = base64_encode($_Ty);
        $_Ph_1 = base64_encode($_Ph);
        $_Tr_1 = base64_encode($_Tr);
        $_Pr_1 = base64_encode($_Pr);*/
        $_VO_1 = str_replace("'", "^" , $_VO);
        $_Ty_1 = str_replace("'", "^" , $_Ty);
        $_Ph_1 = str_replace("'", "^" , $_Ph);
        $_Tr_1 = str_replace("'", "^" , $_Tr);
        $_Pr_1 = str_replace("'", "^" , $_Pr);
        $_Im_1 = $_Im;
        /*start $_Ph_1*/
        $_Ph_2_0 = $_Ph_1;
        $count_n_Ph = substr_count($_Ph_1, "\n");
        if($count_n_Ph >= 1)
        {
            $_Ph_2 = str_replace("\n", "#" , $_Ph_1);
            $_Ph_2_1 = trim(preg_replace('/\s+/', ' ', $_Ph_2));
            $_Ph_2_0 = str_replace("#", "\r" , $_Ph_2_1);
        }
         $_Ph_3 = $_Ph_2_0;
         /*end $_Ph_1*/

        /*start $_Ty_1*/
        $_Ty_2_0 = $_Ty_1;
        $count_n_Ty = substr_count($_Ty_1, "\n");
        if($count_n_Ty >= 1)
        {
            $_Ty_2 = str_replace("\n", "#" , $_Ty_1);
            $_Ty_2_1 = trim(preg_replace('/\s+/', ' ', $_Ty_2));
            $_Ty_2_0 = str_replace("#", "\r" , $_Ty_2_1);
        }
         $_Ty_3 = $_Ty_2_0;
         /*end $_Ty_1*/

        /*start $_Tr_1*/
        $_Tr_2_0 = $_Tr_1;
        $count_n_Tr = substr_count($_Tr_1, "\n");
        if($count_n_Tr >= 1)
        {
            $_Tr_2 = str_replace("\n", "#" , $_Tr_1);
            $_Tr_2_1 = trim(preg_replace('/\s+/', ' ', $_Tr_2));
            $_Tr_2_0 = str_replace("#", "\r" , $_Tr_2_1);
        }
         $_Tr_3 = $_Tr_2_0;
         /*end $_Tr_1*/
         $sql = "
        UPDATE vocabulary SET vocabulary ='$_VO_1',type='$_Ty_3',phonetic='$_Ph_3',translate='$_Tr_3',pronunciation='$_Pr_1',image = '$_Im_1' WHERE ID='$_VO_id'
        ";
                     $result = $this->con->query($sql);

                    if($result === true){
                        return 1;
                    }else return 0;
    }

    function remove_one_vocabulary($_VO_id)
    {
        $sql = " DELETE FROM vocabulary WHERE ID='$_VO_id' ";
        $result = $this->con->query($sql);
        if($result === true)
        {
            return 1;
        }else return 0;
    }

    function remove_one_all_example_vocabulary($_VO_id)
    {
        $sql = " DELETE FROM example WHERE VO_ID='$_VO_id' ";
        $result = $this->con->query($sql);
        if($result === true)
        {
            return 1;
        }else return 0;
    }

    function get_one_example($_EX_id)
    {
        $sql = "select * from example where EX_ID = $_EX_id";
        $kq = $this->con->query($sql);
        if ($kq->num_rows > 0) return $kq;
        return 0;
    }

    function  update_one_example($_EX_id,$_text,$_translate)
    {
       /* $_EX_ID_1 = base64_encode($_EX_id);
        $_text_1 = base64_encode($_text);
        */         
        $_text_1 = str_replace("'", "^" , $_text);
        $_translate_1 = str_replace("'", "^" , $_translate);

        $sql = "
        UPDATE example SET example_test ='$_text_1', translate = '$_translate_1' WHERE EX_ID='$_EX_id' ";
                     $result = $this->con->query($sql);

                    if($result === true){
                        return 1;
                    }else return 0;
    }

    function remove_one_example($_EX_id)
    {
        $sql = " DELETE FROM example WHERE EX_ID='$_EX_id' ";
        $result = $this->con->query($sql);
        if($result === true)
        {
            return 1;
        }else return 0;
    }

    function Count_ID_table_vocabulary()
    { 
        $sql = "SELECT COUNT(ID) as count FROM vocabulary ";
        $result = $this->con->query($sql);
            return $result;
    }

    function get_text_search($_text_search)
    {
        $sql = "select * from vocabulary where vocabulary like '$_text_search%' ";
        $kq = $this->con->query($sql);
        if ($kq->num_rows > 0) return $kq;
        return 0;
    }

}
?>