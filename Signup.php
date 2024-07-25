<?php
include "db.php";
if(isset($_COOKIE["Authentication"]))
{
  header("Location:My_ideas.php");
}
if (!isset($_POST["Submit"])) {
  Form();
} else {
  $firstName = $_POST["FirstName"];
  $lastName = $_POST["LastName"];
  $mobile = $_POST["Mobile"];
  $sex = $_POST["Sex"];
  $password = $_POST["Password"];
  $passwordRepet = $_POST["PasswordRepet"];
  $result = false;
  if ($password == $passwordRepet)
    $result = Insert_User($firstName, $lastName, $mobile, $email, md5($password));
  else {
    Form();
    ?>
    <script>alert("رمزعبور تکرار شده همسان نیست")</script>
    <?php
    return;
  }

  if ($result) {
    ?>
    <script>alert("اطلاعات با موفقیت ثبت شد")</script>
    <?php
    header("Location: login.php");
  } else {
    ?>
    <script>alert("خطا در ثبت اطلاعات")</script>
    <?php
    echo $result;
    Form();
  }
}


function Form()
{ ?>
  <html lang="fa" dir="rtl">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Signup_Style.css">

    <title>ثبت نام</title>
  </head>
  <script src="js/Signup_Script.js"></script>

  <body>
    <div class="wrapper">
      <h2>ثبت نام</h2>
      <form id="Form" action="" method="post">
        <div class="input-box">
          <input type="text" name="FirstName" placeholder="نام خود را وارد کنید" required>
        </div>
        <div class="input-box">
          <input type="text" name="LastName" placeholder="نام خانوادگی خود را وارد کنید" required>
        </div>
        <div class="input-box">
          <input type="text" name="Mobile" placeholder="شماره تلفن همراه خود را وارد کنید"
            pattern="09(0[1-2]|1[0-9]|3[0-9]|2[0-1])-?[0-9]{3}-?[0-9]{4}" required>
        </div>
        <div class="input-box">
          <input type="password" id="Password" name="Password" placeholder="رمز عبور خود را وارد کنید"
            onchange="Input_Validate()" required>
        </div>
        <div class="input-box">
          <input type="password" id="PasswordRepet" name="PasswordRepet" placeholder="رمزعبور را تکرار کنید"
            onchange="Input_Validate()" required>
        </div>
        <div>
          <input type="radio" name="Sex" value="Man" checked>مرد
          &nbsp; <input type="radio" name="Sex" value="Woman">زن

        </div>
        <br>
        <div class="input-box button">
          <input type="Submit" value="ثبت نام" name="Submit" onclick="Length_Password()">
        </div>
        <div class="text">
          <h3 style="font-size: 18px;">آیا حساب کاربری قبلا دارید؟ <a href="login.php">وارد شوید</a></h3>
        </div>
      </form>
    </div>
  </body>

  </html>
  <?php
}
?>