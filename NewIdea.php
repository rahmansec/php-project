<?php
include "db.php";

if (!(isset($_COOKIE["Authentication"]) && Select_User_Cookie($_COOKIE["Authentication"]))) 
        header("Location:index.php");

if (isset($_POST["title"]) && isset($_POST["description"]) && isset($_FILES["image"])) {
    $cookie = $_COOKIE["Authentication"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    print_r($_FILES["image"]);
    $tmpPath = $_FILES["image"]["tmp_name"];
    $fileName = md5("haCker*" . $_FILES["image"]["name"] . time()) . ".png";

    $result = Insert_Ideas($title, $description, $fileName, $cookie);
    if ($result) {
        move_uploaded_file($tmpPath, "image/$fileName");
        ?>
        <script>alert("ایده شما با موفقیت ثبت شد"); window.location = "My_ideas.php"</script>
        <?php
    } else { ?>
        <script>alert("خطا در ثبت اطلاعات")</script>
        <?php
    }
} 
else
Page();


function Page()
{ ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title> ثبت ایده </title>
        <link rel="stylesheet" href="css/NewIdeaStyle.css">
    </head>

    <body style="background-color: #a6edaf;">
        <fieldset style="background-color: lightseagreen;">
            <legend>
                <h1> « ثبت ایده » </h1>
            </legend>


            <button type="button" name="Exit" id="button" onclick="window.location='index.php'">
                <b> بازگشت به صفحه اصلی </b>
            </button>

            <form action="#" method="post" enctype="multipart/form-data">
                <!-- 
        <div id="aks">
            <img id="Picture" src="">
        </div>
         -->


                <div> <input id="title" type="text " name="title" required> </div>
                <textarea id="description" name="description" style="height: 250px;font-size: 18px; text-align: right;"
                    required></textarea>
                <div style="text-align: center;margin: 30px;">

                    <label for="user_file" id="userFileUpload">
                        <input type="file" name="image" id="user_file" accept="image/*">
                        <img src="css/upload.png" alt="">
                        لطفا یک فایل را انتخاب کنید
                    </label>
                </div>


                <input type="submit" name="record" value=" ثبت " id="record">

            </form>
        </fieldset>


    </body>

    <script>

    </script>

    </html>

    <?php
}
?>