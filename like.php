<?php

include "db.php";
if (isset($_COOKIE["Authentication"])) {
    $userID = Select_User_Cookie($_COOKIE["Authentication"])["ID"];

    if (isset($_GET["Check"]) && $_GET["Check"] == "true") {
        echo Check_Like2($userID);


    } elseif (isset($_GET["ID"])) {

        $postID = $_GET["ID"];

        if (!Check_Sqlinjection($postID)) {


            if (isset($_GET["delete"]) && $_GET["delete"] == "true") {
                if (Delete_Like($userID, $postID))
                    echo "true";
                else
                    echo "false";

            } else {
                $result = Check_Like($userID, $postID);

                if (!$result)
                    http_response_code(400);
                else {

                    $result = Insert_Like($userID, $postID);

                    if ($result) {




                        echo "true";

                    } else {
                        echo mysqli_error(Connect_Dbs());
                    }
                }
            }
        }
    }
} else {
    echo "برای لایک کردن باید در سایت عضویت داشته باشید";
    http_response_code(400);
}


?>