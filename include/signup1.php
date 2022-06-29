<?php

class Signup
{

    private $Error = "";

    //evalute data comes from signup form

    public function Evaluate($data)
    {
        # code...
        foreach ($data as $key => $value) {
            # code...
            if (empty($value)) {

                $this->Error .= $key . "  is empty ! <br>";
            }

            if ($key == "email") {

                if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$value))
                {
                     $this->Error  =   $this->Error . " please enter a valid email address ! <br>" ;
                }
            }

            if ($key == "first_name") {

                if(is_numeric($value))
                {
                     $this->Error  =   $this->Error . " First name can't be a nummber! <br>" ;
                } 
                if(strstr($value," "))
                {
                     $this->Error  =   $this->Error . " First name can't have a space! <br>" ;
                }  
            }

            if ($key == "last_name") {

                if(is_numeric($value))
                {
                     $this->Error  =   $this->Error . " Last name can't be a nummber! <br>" ;
                }
                if(strstr($value," "))
                {
                     $this->Error  =   $this->Error . " Last name can't have a space! <br>" ;
                }  
               
            }
           
        }

        if ($this->Error == "") {
            # code...
            //save data when no error

            $this->create_user($data);

        } else {

            return $this->Error;

        }
    }

    //create user
    public function create_user($data)
    {

        $first_name = ucfirst($data['first_name']);
        $last_name = ucfirst($data['last_name']);
        $email = $data['email'];
        $dob = $data['dob'];
        $password = $data['password'];
        $gender = $data['gender'];

        //create 
        $url_address = strtolower($first_name) . "." . strtolower($last_name);
        $userid = $this->create_userid();
        # query...
        $query = "insert into users (userid,first_name,last_name,email,dob,password,url_address,gender) values  ('$userid' ,'$first_name','$last_name','$email','$dob','$password','$url_address','$gender')";

         $db = new Database();
        $db->save($query);

    }

     private function create_userid()
    {
        # code...
        $length =rand(4,19);
        $number = "";
        for($i=1; $i < $length; $i++)
        {
            $new_rand =rand(0,9);
            $number .= $new_rand ; 
        }  

        return $number;
        
    }
}
?>