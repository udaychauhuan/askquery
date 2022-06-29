<!-- image card -->
<div class=" popular_post ">
    <div class="right_div__title py-4 pl-2 ">
        <h2>Images</h2>
    </div>
    <div class="right_sub__div shadow">
        <div class='photo-gallery'>


            <div class='row photos gx-1 mb-1'>
                <?php
                $db = new Database();
                $sql = "select image, postid from posts where has_image = 1 && userid = '$user_data[userid]' order by id desc limit 9";
                $images = $db->read($sql);
                $goto = false;
                $i = "";

                if (is_array($images)) {

                    foreach ($images as $image_row) {


                        echo "<div class='col-sm-6 col-md-4 col-lg-4 mb-1 item'><a href='$image_row[image]' data-lightbox='photos'><img class='img-fluid img-thumbnail ' src='$image_row[image]' style='background-repeat:no-repeat;background-size:cover; width:100px;height:100px;' ></a></div>";
                    }
                } else {
                    echo '<div class=" alert-dismissible text-center text-capitalize " style= " font-size:20px; " role="alert">';
                    echo "No images were found !..";
                    echo '</div>';
                }

                ?>


            </div>

        </div>
        <div class="d-flex">
            <a href="profile_partition.php?section=photos" class="text-capitalize fw-light lh-base text-reset text-decoration-none fs-5 " style="margin-bottom: -15px;">show
                all images </a>
        </div>
    </div>
</div>