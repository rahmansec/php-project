<?php
include "db.php";

$rows = Select_Ideas();






?>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> HOME </title>
    <link rel="stylesheet" href="css/HomeStyle.css">
</head>

<body>

    <h2> « R . H » </h2>

    <button id="button1" class="but" type="button" onclick="window.location='NewIdea.php'"> ایده جدید </button>
    <button id="button2" class="but" type="button" onclick="window.location='My_ideas.php' "> ایده های من </button>
    <?php
    if (!isset($_COOKIE["Authentication"])) {
        echo "<button id=\"button3\" class=\"but\" type=\"button\" onclick=\"window.location='Signup.php'\"> ثبت نام </button>
      <button id=\"button4\" class=\"but\" type=\"button\" onclick=\"window.location='Login.php'\"> ورود </button>";
    }


    while ($row = mysqli_fetch_assoc($rows)) {
        $postID = $row["ID"];
        $resultLike = Select_Like($postID);
        if ($resultLike) {
            $like = mysqli_fetch_array($resultLike)["count"];
        } else
            $like = 0;


        $title = $row["Title"];
        $description = $row["Description"];

        $image = $row["Picture"];

        echo "<div id=\"box1\" class=\"box-mother\">
        <div class=\"image\"><img src=\"image/$image\" style=\"width: 200px; height: 150px;\"></div>
        <h3> $title </h3>
        <p class=\"text1\"> $description </p>
        <div class=\"label-like\">
            <label id=\"like_$postID\" > $like </label>
                                
                <button class=\"like\" id=\"Post_$postID\" name=\"like\" value=\"false\" onclick='Submit_Like($postID)'> لایک </button>
            
        </div>
    </div>";

    }
    ?>

    <script>

        
        function Submit_Like(id) {
            var lable = Number(document.getElementById("like_"+id).innerText);
            var element = document.getElementById("Post_" + id);
            const xhr = new XMLHttpRequest();
            if (element.value == "true") {
                xhr.open("GET", "like.php?ID=" + id + "&delete=true");
                xhr.send();

                xhr.onreadystatechange = () => {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById("like_"+id).innerHTML=lable-1;
                        document.getElementById("Post_" + id).innerHTML = "لایک"
                        element.value="false";
                    }
                }
            }

            else if (element.value == "false") {
                xhr.open("GET", "like.php?ID=" + id);
                xhr.send();

                xhr.onreadystatechange = () => {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        console.log(xhr.response);
                        document.getElementById("like_"+id).innerHTML=lable+1;
                        document.getElementById("Post_" + id).innerHTML = "برداشتن لایک"
                      element.value="true";
                    } else if (xhr.status == 400) {
                        alert(xhr.responseText);
                    }
                };
            }
        }

        function Enable_BtnLike() {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "like.php?Check=true");
            xhr.send();

            xhr.onload = () => {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = xhr.responseText;

                    var post = response.split("@");

                    for (let index = 0; index < post.length-1; index++) {
                        document.getElementById("Post_" + post[index]).innerHTML = "برداشتن لایک";
                        document.getElementById("Post_" + post[index]).value = "true";
                    }

                }
            }
        }

        Enable_BtnLike();





    </script>

</body>



</html>
<?php



?>