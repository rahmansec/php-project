<?php


function Connect_Dbs()
{
    $hostName = "localhost";
    $db_Name = "test";
    $db_UserName = "root";
    $db_PassWord = "";

    $mysql = mysqli_connect($hostName, $db_UserName, $db_PassWord, $db_Name);
    return $mysql;
}

function Login_Check($mobile, $password)
{
    $mysql = Connect_Dbs();

    if (!$mysql) {
        ?>
        <script>alert("خطا در ارتباط با پایگاه داده")</script>
        <?php
        return false;
    } else {
        if (!check_Sqlinjection($mobile)) {

            $query = "SELECT * FROM `users` WHERE `mobile`='$mobile' and `password` = '$password' ";

            $data = mysqli_query($mysql, $query);

            $tedad = mysqli_num_rows($data);

            if ($tedad == 1) {
                $cookieValue = md5(md5($mobile . "*HaCker*" . $password));


                INSERT_Cookie($mobile, $cookieValue);
                return true;
            } else {

                return false;
            }

        } else
            echo "SQL Injection";
    }
}

function INSERT_Cookie($mobile, $cookie)
{
    $mysql = Connect_Dbs();

    setcookie("Authentication", $cookie, time() + 604800);
    $query = "UPDATE `users` SET `Cookie`='$cookie' WHERE `Mobile` = '$mobile'";
    $data = mysqli_query($mysql, $query);
    $result = mysqli_num_rows($data);
    if ($result == 1) {
        return true;
    }
    return false;
}
function Check_Sqlinjection($data)
{
    $blackList = ['\'', '"', '--', '#', '/*', 'and', 'sleep', 'or', 'union', 'select', 'from', 'schema', 'informtion', '=', 'where', '(', ')', 'And', 'Or'];

    $count = strlen($data);
    for ($i = 0; $i < $count; $i++) {
        if (in_array($data[$i], $blackList))
            return true;
    }
    return false;
}

function Select_User($mobile)
{
    $mysql = Connect_Dbs();
    $query = "SELECT * FROM `users` WHERE  `Mobile` = '$mobile'";
    $result = mysqli_query($mysql, $query);
    $data = mysqli_fetch_array($result);
    return $data;

}

function Select_User_Cookie($cookie)
{

    $mysql = Connect_Dbs();
    if (!Check_Sqlinjection($cookie)) {
        $query = "SELECT * FROM `users` WHERE  `Cookie` = '$cookie'";
        $result = mysqli_query($mysql, $query);
        if (mysqli_num_rows($result) == 1) {
            $data = mysqli_fetch_array($result);
            return $data;
        }
    }
    return false;
}

function Insert_User($firstName, $lastName, $mobile, $sex, $password)
{
    $sqlInjection = true;
    $arry = [$firstName, $lastName, $mobile];
    for ($i = 0; $i < count($arry); $i++) {
        if (Check_Sqlinjection($arry[$i])) {
            $sqlInjection = true;
            break;
        } else
            $sqlInjection = false;
    }

    if (!$sqlInjection) {
        $query = "INSERT INTO `users`(`FirstName`, `LastName`, `Mobile`, `Sex`, `Password`)
         VALUES ('$firstName','$lastName','$mobile','$sex','$password')";

        return mysqli_query(Connect_Dbs(), $query);

    }
}

function Update_User($firstName, $lastName, $mobile, $password, $cookie)
{
    $arry = [$firstName, $lastName, $mobile, $cookie];
    for ($i = 0; $i < count($arry); $i++) {
        if (Check_Sqlinjection($arry[$i])) {
            $sqlInjection = true;
            break;
        } else
            $sqlInjection = false;
    }
    if (!$sqlInjection) {
        $query = "UPDATE `users` SET `Password`='$password',`FirstName`='$firstName',`LastName`='$lastName',`Mobile`='$mobile' WHERE `Cookie` ='$cookie' ";
        return mysqli_query(Connect_Dbs(), $query);

    }
}


function Insert_Ideas($title, $description, $pathPicture, $cookie)
{
    $sqlInjection = true;
    $arry = [$title, $description, $cookie];
    for ($i = 0; $i < count($arry); $i++) {
        if (Check_Sqlinjection($arry[$i])) {
            $sqlInjection = true;
            break;
        } else
            $sqlInjection = false;
    }

    if (!$sqlInjection) {
        $userID = Select_User_Cookie($cookie)["ID"];
        echo $userID;
        $query = "INSERT INTO `ideas`(`UserID`, `Title`, `Description`, `Picture`,`Date_Of_Submit`) 
VALUES ('$userID','$title','$description','$pathPicture',Now())";

        return mysqli_query(Connect_Dbs(), $query);

    }
}


function Select_MyIdeas($cookie)
{
    $userID = Select_User_Cookie($cookie)["ID"];
    $query = "SELECT * FROM `ideas` WHERE UserID = $userID";
    return mysqli_query(Connect_Dbs(), $query);
}

function Select_Ideas()
{

    $query = "SELECT * FROM `ideas` limit 0,6";
    return mysqli_query(Connect_Dbs(), $query);
}


function Check_Like($userID, $postID)
{
    $query = "SELECT * FROM `like` WHERE `UserID` = $userID and `PostID` = $postID ";
    $result = mysqli_query(Connect_Dbs(), $query);
    if (mysqli_num_rows($result) > 0)
        return false;

    return true;
}


function Insert_Like($userID, $postID)
{
    $query = "INSERT INTO `like`(`UserID`, `PostID`) VALUES ($userID,$postID)";
    return mysqli_query(Connect_Dbs(), $query);


}


function Select_Like($postID)
{
    $query = "SELECT count(`PostID`) AS count FROM `like` WHERE `PostID` = $postID ";
    return mysqli_query(Connect_Dbs(), $query);

}


function Check_Like2($userID)
{
    $query = "SELECT PostID FROM `like` WHERE `UserID` = $userID";
    $rows = mysqli_query(Connect_Dbs(), $query);
    $list = "";
    while ($row = mysqli_fetch_assoc($rows)) {
        $list = $list . $row["PostID"] . "@";
    }


    return $list;
}



function Delete_Like($userID, $postID)
{
    $query = "DELETE FROM `like` WHERE `UserID` = $userID  and `PostID` =$postID";
    return mysqli_query(Connect_Dbs(), $query);

}


?>