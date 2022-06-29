<?php

class User_Detail
{

    private $Error = "";

    //evalute data comes from signup form

    public function Evaluate_details($data,$data1)
    {
        # code...
        foreach ($data as $key => $value) {
            # code...
        

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
            //save user details

            $this->save_user_details($data,$data1);

        } else {

            return $this->Error;

        }
    }

    //create user
    public function save_user_details($data,$data1)
    {

        
        $change = "";
        $email = "";
        $password ="";

        $userid = $_SESSION['askquery_userid'];
         

        if (isset($data['change'])) {
                                             //userid,first_name,last_name,email,dob,password,url_address,gender
            $change = $data['change'];
        }
        //for veriable
        if ($change == "userdetail") {
            $first_name = ucfirst($data1['first_name']);
            $last_name = ucfirst($data1['last_namd']);
            $work =  addslashes($data1['work']);
            $lives = addslashes($data1['lives']);
            $study = addslashes($data1['study']);
            $dob = $data1['dob'];
            $user_bio =  addslashes($data1['user_bio']);
            $url_address = strtolower($first_name) . "." . strtolower($last_name);
        }else {

            $email = $data1['email'];
            $password = $data1['password'];
        }



       //for query
       if ($change =="userdetail") {
        
            $query = "insert into users (userid, first_name,last_name,dob,url_address,work,lives,study,user_bio) values ('$userid','$first_name','$last_name','$dob','$url_address','$work','$lives','$study','$user_bio') where userid ='$userid' limit 1";
            // userid ='$userid',first_name ='$first_name',last_name ='$last_name' ,dob ='$dob' ,url_address ='$url_address' ,work ='$work' ,lives ='$lives' ,study ='$study' ,user_bio ='$user_bio'      
            print_r($query);
             
       }else {
            $query  = "update users set email ='$email', password='$password' where userid ='$userid' limit 1";
          }
     
        $db = new Database();
        $db->save($query);

    }
}
