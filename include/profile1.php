<?php

class Profile{

    public function get_profile($id)
    {
        $id=addslashes($id);
        $db = new Database();
        $query = " select * from users where userid ='$id' limit 1 "; 
        return $db->read($query);
    }
}

?>