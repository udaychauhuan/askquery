<?php

class Login
{

    private $Error = "";

    //create user
    public function evaluat($data)
    {
        $email = addslashes($data['email']);
        $password = addslashes($data['password']);

        # query...
        $query = "select  * from  users where email = '$email' limit 1";

        $db = new Database();
        $result = $db->read($query);

        if ($result) {
            # code...
            $row = $result[0];
          //here comes hash password
            if ($password == $row['password']) {
                # code...
                $_SESSION['askquery_userid'] = $row['userid'];
            } else {
                $this->Error .= "Wrong email or password <br>";
            }
        } else {
            $this->Error .= "Wrong email or password <br>";
        }
        return $this->Error;
    }
    // private function hash_text($text)
    // {
    //     $text = hash("sha1", $text);
    //     return $text;
    // }

    public function check_login($id)
    {
        # code...
        if (is_numeric($id)) {

            $query = "select * from  users where userid = '$id' limit 1";

            $db = new Database();
            $result = $db->read($query);

            if ($result) {

                $user_data = $result[0];
                return $user_data;
            }
        } else {
            header("location: login.php");
            die;
        }
    }
}
?>