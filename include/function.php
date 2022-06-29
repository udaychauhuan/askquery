<?php

function pagination_link(){

    $arr['next_page'] = "";
    $arr['prev_page'] = "";

    $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page_number = ($page_number < 1) ? 1 : $page_number;

    $url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];
    $url .= "?";
    $prev_page_link = $url;
    $next_page_link = $url;

    $page_found = false;  

    $num = 0;
    foreach ($_GET as $key => $value) {
        # code...
        $num++;

        if ($num == 1) {
            # code...
            if ($key == "page") {
                # code...
                $prev_page_link .= $key . "=" . ($page_number - 1);
                $next_page_link .= $key . "=" . ($page_number + 1);
                $page_found =  true;  
            } else {
                $prev_page_link .= $key . "=" . $value;
                $next_page_link .= $key . "=" . $value;
            }
        } else {
            if ($key == "page") {
                $prev_page_link .=  "&" . $key . "=" . ($page_number - 1);
                $next_page_link .=  "&" . $key . "=" . ($page_number + 1);
                $page_found =  true; 
            } else {
                # code...
                $prev_page_link .=  "&" . $key . "=" . $value;
                $next_page_link .=  "&" . $key . "=" . $value;
            }
        }
    }
    $arr['next_page'] = $next_page_link;
    $arr['prev_page'] = $prev_page_link;
    if (!$page_found) {
        # code...
        $arr['next_page'] = $next_page_link . "&page=2";
        $arr['prev_page'] = $prev_page_link . "&page=1";
    }

   return $arr;
}