<!-- following card -->
<div class=" popular_post ">
    <div class="right_div__title py-4 pl-2 ">
        <h2>Following</h2>
    </div>
    <div class="right_sub__div shadow">
        <?php
        $image = new Image();
        $user = new User();
        $post = new Post();

        $following = $user->get_followings($user_data['userid'], "user");
        if (is_array($following) && !empty($following)) {

            foreach ($following as $followings) {
                $FRIEND_ROW = $user->get_user($followings['userid'], "user");
                include("user.php");
            }
        } else {
            echo '<div class=" alert-dismissible text-center text-capitalize " style= " font-size:20px; " role="alert">';
            echo "you haven't follow any one !..";
            echo '</div>';
        }
        ?> <div class="">
            <a href="profile_partition.php?section=followings" class="text-capitalize fw-light lh-base text-reset text-decoration-none fs-5" style="margin-bottom: 25px ! important;">
                show all followed </a>
        </div>
    </div>
</div>