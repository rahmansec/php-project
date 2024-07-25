<?php

include "db.php";
session_start();

if (isset($_COOKIE["Authentication"])) {
    header("Location: My_ideas.php");

} else
    if (isset($_POST["Submit"])) {
        $mobile = $_POST["mobile"];
        $passWord = md5($_POST["password"]);

        $check = Login_Check($mobile, $passWord);

        if ($check) {
            
            
            header("Location: My_ideas.php");
            return true;
        } else {
            page();
            ?>
            <script>
                document.getElementById("error-message").style.display = "block";
            </script>
            <?php

            //echo "نام کاربری یا رمز عبور اشتباه است";
        }

    } else
        page();

function page()
{
    ?>
    <html dir="rtl">

    <head>
        <title>ورود به سایت</title>
        <link rel="stylesheet" href="css/Login_Style.css">
        <meta charset="UTF-8">
    </head>

    <body>

        <form action="" method="post">

            <h1>ورود به سایت</h1>

            <label for="username">شماره موبایل خود را وارد کنید </label><br >
            <input type="text" id="mobile" name="mobile" /><br />

            <label for="password">رمز عبور</label><br />
            <input type="password" id="password" name="password" /><br />

            <input type="submit" value="ورود" name="Submit" />

            <p id="error-message">نام کاربری یا رمز عبور اشتباه است.</p>
            <br>
            <br>
            <a href="ForgotPassword.php">رمز عبور خود را فراموش کرده اید؟</a>
        </form>

    </body>

    </html>

    <?php
}
?>