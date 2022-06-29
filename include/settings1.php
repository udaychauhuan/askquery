<?php

class Settings
{
   
   private $Error = false;
  public function get_settings($id)
  {
      # code...
      $db = new  Database();
      $sql = "select * from users where userid = '$id' limit 1";
      $row = $db->read($sql);
      if (is_array($row)) {
          return $row[0];
          # code...
      }
  }
    public function save_settings($data, $data2, $id)
    {
        $db = new Database();


        $change = "";
        $pass2 = "";
        $pass1 = "";

        foreach ($data as $key => $value) {
            # code...
            if (empty($value)) {

                $this->Error  .=  $key . "is empty ! <br>";
            }

            if ($key == "email") {

                if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value)) {
                    $this->Error  =   $this->Error . " please enter a valid email address ! <br>";
                }
            }

            if ($key == "first_name") {

                if (is_numeric($value)) {
                    $this->Error  =   $this->Error . " First name can't be a nummber! <br>";
                }
                if (strstr($value, " ")) {
                    $this->Error  =   $this->Error . " First name can't have a space! <br>";
                }
            }

            if ($key == "last_name") {

                if (is_numeric($value)) {
                    $this->Error  =   $this->Error . " Last name can't be a nummber! <br>";
                }
                if (strstr($value, " ")) {
                    $this->Error  =   $this->Error . " Last name can't have a space! <br>";
                }
            }
        }



        if ($this->Error == "") {



            if ($data['password'] != $data['confirm_password']) {
                unset($data['password']);
            }
            unset($data['confirm_password']);

            $sql = "update users set ";

            foreach ($data as $key => $value) {
                $sql .= $key . "='" . $value . "',";
            }
            $sql = trim($sql, ",");
            $sql .= " where userid = '$id' limit 1 ";
            $db->save($sql);
        } else {

            return $this->Error;
        }
    }
}











