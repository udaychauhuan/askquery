<?php 

  class Database{
     
    private $host ="localhost";
    private $username ="root";
    private $password ="";
    private $db ="askquery_db";
  
     //for connection
    public function connect()
    {
        # code...
        $connection = mysqli_connect($this->host,$this->username,$this->password,$this->db);
        return $connection;
    }

    public function read($query)
    {
        # code...
        $conn = $this->connect();
        $result = mysqli_query($conn,$query);
        if (!$result){
            # code...
            echo "error in result";
            return false;
        }
        else{
              
            $data = false ;
            while ($row = mysqli_fetch_assoc($result)) {
                # code...
                $data[] =  $row ;
            }
            return $data;
        }

    }

    public function save($query)
    {
        # code...
        $conn = $this->connect();
        $result = mysqli_query($conn,$query);

        if (!$result) {
            # code...
            return false;
        }
        else{
            return true;
        }

    }

    public function hashed_user()
    {
        $db = new Database();
        $sql = "select * from users";
        $result = $db->read($sql);

        foreach ($$result as $row ){
            # code...
            $id =  $row['id'];
            $password = hash("sha1" ,$row['password']);

            $sql =  "update set password = '$password' where id ='$id' limit 1";
        }
    }

   
  }
   
?>