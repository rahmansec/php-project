<?php
include "db.php";

if (!isset($_COOKIE["Authentication"])) {
  return;
}
$cookie = $_COOKIE["Authentication"];
$data = Select_User_Cookie($cookie);

if (isset($_POST["Change"])) {
  $passwordDb = $data["Password"];
  /////////////////////////////////
  $passwordInput = md5($_POST["Password"]);
  if (!($passwordDb == $passwordInput)) {

    ?>
    <script>alert("رمز فعلی وارد شده مطابقت ندارد")</script>

    <?php

  } else {



    $firstName = $_POST["FirstName"];
    $lastName = $_POST["LastName"];
    $mobile = $_POST["Mobile"];
    $address = $_POST["Address"];

    $password_Repet = $_POST["PasswordRepet"];

    if ($passwordInput == $password_Repet) {

      ?>
      <script>alert("رمز عبور  با تکرار مطابقت ندارد")</script>
      <?php
    } else {
      $result = Update_User($firstName, $lastName, $mobile, $passwordInput, $cookie);
      if ($result) {
        ?>
        <script>alert("اطلاعات با موفقیت ویرایش شد"); window.location = "My_ideas.php"</script>
        <?php

      } else {
        ?>
        <script>alert("خطا در ارتباط با پایگاه داده")</script>
        <?php

      }
    }

  }
}




$email = $data["Email"];
$firstName = $data["FirstName"];
$lastName = $data["LastName"];
$mobile = $data["Mobile"];
$address = $data["Address"];




page();
function Page()
{
  global $firstName;
  global $lastName;
  global $mobile;
  global $address;
  ?>
  <html lang="fa" dir="rtl">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Signup_Style.css">

    <title>ویرایش</title>
  </head>
  <script src="js/Signup_Script.js"></script>

  <body>
    <div class="wrapper">
      <h2>ویرایش</h2>
      <form id="Form" action="#" method="post">
        <div class="input-box">
          <input type="text" name="FirstName" value="<?php echo $firstName ?>" placeholder="نام خود را وارد کنید"
            required>
        </div>
        <div class="input-box">
          <input type="text" name="LastName" value="<?php echo $lastName ?>" placeholder="نام خانوادگی خود را وارد کنید"
            required>
        </div>
        <div class="input-box">
          <input type="text" name="Mobile" value="<?php echo $mobile ?>" placeholder="شماره تلفن همراه خود را وارد کنید"
            pattern="09(0[1-2]|1[0-9]|3[0-9]|2[0-1])-?[0-9]{3}-?[0-9]{4}" required>
        </div>
        <div class="input-box">
          <input type="password" id="Password" name="PasswordOld" placeholder="رمز عبور فعلی وارد کنید"
            onchange="Input_Validate()" required>
        </div>
        <div class="input-box">
          <input type="password" id="Password" name="Password" placeholder="رمز عبور جدید وارد کنید"
            onchange="Input_Validate()" required>
        </div>
        <div class="input-box">
          <input type="password" id="PasswordRepet" name="PasswordRepet" placeholder="رمزعبور را تکرار کنید"
            onchange="Input_Validate()" required>
        </div>
        <br>

        <div class="input-box button">
          <input type="Submit" value="ویرایش" name="Change" onclick="Length_Password()">
        </div>

      </form>
    </div>
  </body>

  </html>


  <?php
}
?>