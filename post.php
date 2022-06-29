<?php
$image = "assets/female_pic.jpg";

if ($ROW_USER['gender'] == "male") {
    # code...
    $image = "assets/male_pic.jpg";
}
if (file_exists($ROW_USER['profile_image'])) {
    # code...
    $image = $ROW_USER['profile_image'];
}
?>
<div class="col-12 card p-4 shadow post mb-2 my-5">
    <div class="col-12  blog_left__div">
        <!-- user-image -->
        <div class="d-flex ">
            <img src="<?php echo $image ?>" style="height: 60px; width: 60px;" class="rounded-circle shadow" alt="">
        </div>
        <div class="dropdown d-flex justify-content-end">
            <?php
            //  if im a user
            $post = new Post();

            if ($post->i_own_post($ROW['postid'], $_SESSION['askquery_userid'])) {
                # code...
                echo "
          <button class='dropbtn' style='margin-top: -40px; border :none;'><i class='fa fa-ellipsis-v'></i></button>
          <div class='dropdown-content'> 
          <a href='delete_edit.php?id= $ROW[postid]&change=edit' class='text-muted fs-4'>
            Edit
          </a>
          <a href='delete_edit.php?id= $ROW[postid]&change=delete' class='text-muted fs-4'>
            Delete
          </a>
          </div>";
            }

            ?>
        </div>
        <!-- <a href="" class="test-reset text-muted text-decoration-none ">Edit</a> / <a href="" class="test-reset text-decoration-none text-muted">Delete</a> -->
        </p>
        <!-- user-image -->
        <div class="d-flex justify-content-center align-items-center flex-column mx-3 pb-1 " style="margin-top: -14px;">
            <h1 class="text-uppercase th fs-1 ">
                <!-- post title --> <?php echo htmlspecialchars($ROW['post_title']) ?>
                <!-- post title -->
            </h1>
            <p class="blog_title td">
                <span class="font-weight-bold fs-2">
                    <!-- title discription --> <?php echo htmlspecialchars($ROW['post_dis']) ?>
                    <!-- title discription -->
                </span>
                <!-- post date  -->
                <span class="fw-light text-muted fs-3"> <?php echo htmlspecialchars($ROW['date']) ?> </span>
                <!-- post date  -->
            </p>
        </div>
        <figure class="right_side_img mb-4 d-flex justify-content-center border">
            <!-- post image --> <?php
                                $post_image = " ";
                                if (file_exists($ROW['image'])) {
                                    $post_image = $ROW['image'];
                                }
                                ?> <img src="<?php echo $post_image  ?>" class="img-fluid shadow-lg" style="max-height: 500px ! important; max-width: 100% ! important;">
        </figure>
        <p class="mb-3">
            <span class="font-weight-bold text-uppercase fw-bold mx-1">
                <!-- user name -->
                <?php echo htmlspecialchars($ROW_USER['first_name']) . " " . htmlspecialchars($ROW_USER['last_name']) ?>
                <!-- user name -->
            </span>
            <!-- mian post --> <?php echo htmlspecialchars($ROW['post']) ?>
            <!-- mian post -->
        </p>
        <div class="d-flex justify-content-between left_div_btns">
            <div>
                <!--  like post -->
                <a href="like.php?type=post&id=<?php echo  $ROW['postid'] ?>">
                    <button class="left_div__like" id="like_btn">
                        <?php

                        $i_liked = false;
                        if (isset($_SESSION['askquery_userid'])) {
                            $db = new  Database();
                            $sql = "select likes from likes  where type = 'post' && content_id = '$ROW[postid]' limit 1 ";
                            $result = $db->read($sql);
                            if (is_array($result)) {
                                $likes  = json_decode($result[0]['likes'], true);
                                $userid = array_column($likes, "userid");
                                if (in_array($_SESSION['askquery_userid'], $userid)) {
                                    $i_liked = true;
                                }
                            }
                        }
                        //////////////////////////////////like part//////////////////        
                        $unlike = "<i class='fa fa-thumbs-up'></i> Like";
                        $like = "✓ Liked";
                        $likes = "";

                        if ($ROW['likes'] > 0) {
                            if ($i_liked) {
                                $likes = $like . "<badge class='bg-gray text-dark p-1'>" . $ROW["likes"] . "</badge>";
                            } else {
                                $likes = $unlike . "<badge class='bg-gray text-dark p-1'>" . $ROW["likes"] . "</badge>";
                            }
                        } else {
                            $likes = $unlike;
                        }
                        ?>
                        <?php echo $likes ?>
                    </button>
                </a>
            </div>

            <div>
                <button class="left_div__reply"><a href="single_post.php?change=comment&id=<?php echo $ROW['postid'] ?>" class="test-reset bg-gray text-dark text-decoration-none ">comment </a><span class="bg-gray text-dark">1
                    </span></button>
            </div>


        </div>

    </div>
</div>