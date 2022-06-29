<?php

class User{

    //get data
    public function get_data($id)
    {
        # code...
        $query ="select * from users where userid = '$id' limit 1";
        $db = new Database();
        $result = $db->read($query);

        if ($result) {
            # code...
            $row = $result[0];
            return $row;
        }else{
            
            return false;
        }
    }

    public function get_user($id)
    {
        # code...
        $query = "select * from users where userid = '$id' limit 1" ;
        $db = new Database();
        $result = $db->read($query);

        if ($result ) {
            # code...
            return $result[0];
            
        }else {

            echo 'its fales value in get users';
            return false;
        }
    }

    public function i_own_user($userid, $askquery_userid)
    {
        # code...
        if (!is_numeric($userid)) {
            # code...
            return false;
        } else {
            # code...
            $query = "select * from users where userid = '$userid' limit 1";
            $db = new Database();
            $result = $db->read($query);

            if (is_array($result)) {
                # code...
                if ($result[0]['userid'] == $askquery_userid) {
                    # code...
                    return true;
                }
            } else {
                return false;
            }
        }
    }

    public function get_friends($id)
    {
        # code...
        $query = "select * from users where userid != '$id' " ;
        $db = new Database();
        $result = $db->read($query);

        if ($result) {
            # code...
            return $result;
            
        }else {

            echo 'its fales value in get friend';
            return false;
        }
    }

    public function get_following($id, $type)
    {
        $db = new Database();
        $type = addslashes($type);
        if (is_numeric($id)) {
            # code...
            $sql = "select following from likes where type= '$type' && content_id = '$id' limit 1";
            $result = $db->read($sql);
            if (is_array($result)) {
                # code...
                $following = json_decode($result[0]['following'], true);
                return $following;
            }
        }
    }

    public function follow_user($id, $type, $askquery_userid)
    {
        # code...
        $db = new Database();
        # save likes details

        $sql = "select following from likes  where type = '$type' && content_id = '$askquery_userid' limit 1 ";
        $result = $db->read($sql);

        if (is_array($result)) {

            $likes  = json_decode($result[0]['following'], true);
            $userid = array_column($likes, "userid");
            if (!in_array($id, $userid)) {
                # code...
                $arr["userid"] = $id;
                $arr["date"] = date("y-m-d h:i:s");
                $likes[] = $arr;
                $likes_string   = json_encode($likes);
                $sql = "update likes set following = '$likes_string' where type = '$type' && content_id = '$askquery_userid' limit 1 ";
                $db->save($sql);

            } else {

                $key = array_search($askquery_userid, $userid);
                unset($likes[$key]);
                $likes_string  = json_encode($likes);
                $sql = "update likes set following = '$likes_string' where type = '$type' && content_id = '$askquery_userid' limit 1 ";
                $db->save($sql);

            }
        } else {
            # increment the post table
            $arr["userid"] = $id;
            $arr["date"] = date("y-m-d h:i:s");

            $arr2[] = $arr;

            $following  = json_encode($arr2);
            $sql = "insert into likes (type,content_id,following) values ('$type','$askquery_userid','$following')";
            $db->save($sql);
        }
    }

    public function get_followings($id, $type)
    {
        $db = new Database();
        $type = addslashes($type);

        if (is_numeric($id)) {
            # get following users details.
            $sql = "select following from likes where type = '$type' && content_id = '$id' limit 1";
            $result = $db->read($sql);
            if (is_array($result)) {
                # code...
                $following = json_decode($result[0]['following'], true);
                return $following;
            }
        }

        return false;
    }


    public function follow_usert($id, $type, $askquery_userid)
    {
        # code...
        $db = new Database();
        # save likes details

        $sql = "select following from following  where type = '$type' && content_id = '$askquery_userid' limit 1 ";
        $result = $db->read($sql);

        if (is_array($result)) {

            $likes  = json_decode($result[0]['following'], true);
            $userid = array_column($likes, "userid");
            if (!in_array($askquery_userid, $userid)) {
                # code...
                $arr["userid"] = $id;
                $arr["date"] = date("y-m-d h:i:s");
                $likes[] = $arr;
                $likes_string   = json_encode($likes);
                $sql = "update likes set following = '$likes_string' where type = '$type' && content_id = '$askquery_userid' limit 1 ";
                $db->save($sql);

            } else {

                $key = array_search($askquery_userid, $userid);
                unset($likes[$key]);
                $likes_string  = json_encode($likes);
                $sql = "update likes  set following = '$likes_string' where type = '$type' && content_id = '$askquery_userid' limit 1 ";
                $db->save($sql);
            }
        } else {
            # increment the post table
            $arr["userid"] = $id;
            $arr["date"] = date("y-m-d h:i:s");

            $arr2[] = $arr;

            $following  = json_encode($arr2);
            $sql = "insert into likes (type,content_id,following) values ('$type','$askquery_userid','$following')";
            $db->save($sql);


        }
    }

}

?>