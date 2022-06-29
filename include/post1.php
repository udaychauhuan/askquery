<?php


class Post
{

    private $Error = "";

    public function create_post($userid, $data, $files)
    {
        # code...
        if (!empty($data['post']) || !empty($files['file']['name'])) {
            # code...
            $post_image = " ";
            $has_image = 0;

            if (!empty($files['file']['name'])) {
                # code...
                $post_image = $files;
                $has_image = 1;
                $folder = "upload/" . $userid . "/";

                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                    file_put_contents($folder . "index.php", "");
                }
                $image_class = new Image();
                $post_image = $folder . $image_class->generate_filename(15);
                move_uploaded_file($_FILES['file']['tmp_name'],  $post_image);
            }
            $post = addslashes($data['post']);
            $postid = $this->create_postid();
            $post_dis = addslashes($data['post_dis']);
            $post_title = addslashes($data['post_title']);

            //$id = $_SESSION['askquery_userid'];

            $query = "insert into posts (userid,postid,post,post_dis,post_title,image,has_image) values ('$userid','$postid','$post','$post_dis','$post_title','$post_image','$has_image') ";

            $db = new Database();
            $db->save($query);

            header("location: profile.php");
            die;
        } else {

            $this->Error .= "Please type something to your post ! <br>";
        }

        return $this->Error;
    }

    // public function create_post($userid, $data, $files)
    // {
    //     # code...
    //     if (!empty($data['post']) || !empty($files['file']['name'])) {
    //         # code...
    //         $post_image = " ";
    //         $has_image = 0;

    //         if (!empty($files['file']['name'])) {
    //             # code...
    //             $post_image = $files;
    //             $has_image = 1;
    //             $folder = "upload/" . $userid . "/";

    //             if (!file_exists($folder)) {
    //                 mkdir($folder, 0777, true);
    //                 file_put_contents($folder . "index.php", "");
    //             }
    //             $image_class = new Image();
    //             $post_image = $folder . $image_class->generate_filename(15) .".jpg";
    //             move_uploaded_file($_FILES['file']['tmp_name'],  $post_image);
    //         }
    //         $post = addslashes($data['post']);
    //         $postid = $this->create_postid();
    //         $parents = 0;
    //         if (isset($data['parents']) && is_numeric($data['parents'])) {
    //             # code...
    //             $parents = $data['parents'];
    //         }
    //         $post_dis = addslashes($data['post_dis']);
    //         $post_title = addslashes($data['post_title']);

    //         //$id = $_SESSION['askquery_userid'];

    //         $query = "insert into posts (userid,postid,post,post_dis,post_title,image,has_image,parents) values ('$userid','$postid','$post','$post_dis','$post_title','$post_image','$has_image','$parents')";

    //         $db = new Database();
    //         $db->save($query);

    //         header("location: profile.php");
    //         die;
    //     } else {

    //         $this->Error .= "Please type something to your post ! <br>";
    //     }

    //     return $this->Error;
    // }

    public function edit_post($data, $files)
    {
        # code...
        if (!empty($data['post']) || !empty($files['file']['name'])) {
            # code...
            $post_image = "";
            $has_image = 0;

            if (!empty($files['file']['name'])) {
                # code...

                $folder = "upload/" . $data['userid'] . "/";

                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                    file_put_contents($folder . "index.php", "");
                }
                $image_class = new Image();
                $post_image = $folder . $image_class->generate_filename(15) .".jpg";
                move_uploaded_file($_FILES['file']['tmp_name'],  $post_image);

                $has_image = 1;
            }

            if (is_numeric($data['postid'])) {
                $postid = addslashes($data['postid']);
            } else {
                return false;
            }
            $post = addslashes($data['post']);
            $post_dis = addslashes($data['post_dis']);
            $post_title = addslashes($data['post_title']);

            //$id = $_SESSION['askquery_userid'];
            if ($has_image == 1) {
                $query = "update posts set post_title ='$post_title', image ='$post_image',post_dis ='$post_dis',post = '$post' where postid = '$postid' ";
            } else {
                $query = "update posts set post_title ='$post_title',post_dis ='$post_dis',post = '$post' where postid = '$postid' ";
            }

            echo $query;
            $db = new Database();
            $db->save($query);
        } else {

            $this->Error .= "Please type something to your post ! <br>";
        }

        return $this->Error;
    }
    

    public function get_like($id,$type )
    {
        $db = new Database();
        $type = addslashes($type);
        
        if (is_numeric($id)) {
            # code...
            $sql ="select likes from likes where type= '$type' && content_id = '$id' limit 1";
            $result = $db->read($sql);
            if (is_array($result)) {
                # code...
                $likes = json_decode($result[0]['likes'],true);
                return $likes;
            }
        } 
    }

    public function get_post($id)
    {
        # code...
        $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page_number = ($page_number < 1) ? 1 : $page_number;
        $limit = 4;
        $offset = ($page_number - 1) * $limit;
        $query = "select * from posts where userid = '$id' order by id desc limit $limit offset $offset";

        $db = new Database();
        $result = $db->read($query);

        if ($result) {
            # code...
            return $result;
        } else {
            return false;
        }
    }

    public function save_comments($id,$comments,$postid)
    {
        # code...
        $query = "update posts set comments ='$comments' || parent ='$id'  where postid = '$postid' limit 1";

        $db = new Database();
        $result = $db->save($query);

        if ($result) {
            # code...
            return $result;
        } else {
            return false;
        }
    }

    public function get_comments($id)
    {
        # code...
        $query = "select * from posts where parents = '$id' order by id asc limit 10";

        $db = new Database();
        $result = $db->read($query);

        if ($result) {
            # code...
            return $result;
        } else {
            return false;
        }
    }

    public function get_one_post($postid)
    {
        # code...
        if (!is_numeric($postid)) {
            # code...
            return false;
        } else {
            # code...
            $query = "select * from posts where postid = '$postid' limit 1";

            $db = new Database();
            $result = $db->read($query);

            if ($result) {
                # code...
                return $result[0];
            } else {
                return false;
            }
        }
    }

    public function delete_post($postid)
    {
        # code...
        if (!is_numeric($postid)) {
            # code...
            return false;
        } else {
            # code...
            $query = "delete from posts where postid = '$postid' limit 1";
            echo $query;
            $db = new Database();
            $db->save($query);
        }
    }
    public function i_own_post($postid, $askquery_userid)
    {
        # code...
        if (!is_numeric($postid)) {
            # code...
            return false;
        } else {
            # code...
            $query = "select * from posts where postid = '$postid' limit 1";
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

    public function like_post($id, $type, $askquery_userid)
    {
        # code...
        $db = new Database();
        # save likes details

        $sql = "select likes from likes  where type = '$type' && content_id = '$id' limit 1 ";
        $result = $db->read($sql);

        if (is_array($result)) {

            $likes  = json_decode($result[0]['likes'], true);
            $userid = array_column($likes, "userid");
            if (!in_array($askquery_userid, $userid)) {
                # code...
                $arr["userid"] = $askquery_userid;
                $arr["date"] = date("y-m-d h:i:s");
                $likes[] = $arr;
                $likes_string   = json_encode($likes);
                $sql = "update likes set likes = '$likes_string' where type = '$type' && content_id = '$id' limit 1 ";
                $db->save($sql);

                # increment the post table
                $sql = "update {$type}s set likes = likes + 1 where {$type}id = '$id' limit 1 ";
                $db->save($sql);
            } else {

                $key = array_search($askquery_userid, $userid);
                unset($likes[$key]);
                $likes_string  = json_encode($likes);
                $sql = "update likes set likes = '$likes_string' where type = '$type' && content_id = '$id' limit 1 ";
                $db->save($sql);

                # decrementing the post table
                $sql = "update {$type}s set likes = likes - 1 where {$type}id = '$id' limit 1 ";
                $db->save($sql);
            }
        } else {
            # increment the post table
            $arr["userid"] = $askquery_userid;
            $arr["date"] = date("y-m-d h:i:s");

            $arr2[] = $arr;

            $likes  = json_encode($arr2);
            $sql = "insert into likes (type,content_id,likes) values ('$type','$id','$likes')";
            $db->save($sql);

            # increment the post table
            $sql = "update {$type}s set likes = likes + 1 where {$type}id = '$id' limit 1 ";
            $db->save($sql);
        }
    }
    public function replyid()
    {
        $length = rand(1, 5);
        $number = "";
        for ($i = 1; $i < $length; $i++) {
            $new_rand = rand(0, 9);
            $number .= $new_rand;
        }

        return $number;
    }

    private function create_postid()
    {
        # code...
        $length = rand(4, 15);
        $number = "";
        for ($i = 1; $i < $length; $i++) {
            $new_rand = rand(0, 9);
            $number .= $new_rand;
        }

        return $number;
    }
}
