<?php
include "db.php";
session_start();
if (!isset($_COOKIE["Authentication"])) {
    header("Location:login.php");
}

?>

<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title> عنوان ایده </title>

    <style>
        body {
            direction: rtl;
            font-family: "2  Bardiya";
            background-color: #f6f6f6;
        }

        table {
            width: 60%;
            margin: 170px auto;
            text-align: center;
            box-shadow: -2px 2px 1px rgba(0, 0, 0, .1), -4px 4px 3px rgba(0, 0, 0, .3);
        }

        table,
        th,
        td {
            border: 2px solid #0073ad;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px;
            font-size: 15px;
        }

        tr:nth-child(even) {
            background-color: #ffeef5;
        }

        tr:nth-child(odd) {
            background-color: #fffcfc;
        }

        th {
            color: #fff;
            background-color: #007bff;
            font-size: 20px;
            font-weight: bold;
            transition: all 0.5s;
        }

        th:hover {
            color: #00eaff;
            background-color: #fff;
        }
        #button {
    font-size: 15px;
    width: 140px;
    height: 45px;
    font-weight: bold;
    text-align: center;
    color: #1ca0ac;
    background-color: #fff;
    padding: 4px;
    margin: 10px 25px;
    border: 2px solid #159db5;
    border-radius: 15px 5px;
    cursor: pointer;
    transition: all 0.5s;
    box-shadow: -1px 1px 1px rgba(0, 0, 0, .1), -2px 2px 3px rgba(0, 0, 0, .3);
}

#button:hover {
    background-color: #1d9fb0;
    color: white;
    border: 2px solid #1c89d7;
    border-radius: 5px 5px;
}

#exit {
    text-decoration: none;
}
    </style>

</head>

<body style="background-color: gainsboro;">
<button type="button" name="Exit" id="button" onclick="window.location='index.php'">
                <b> بازگشت به صفحه اصلی </b>
            </button>
    <table>

        <tr>
            <th> عنوان ایده </th>
            <th> شرح ایده </th>
            <th> تاریخ ثبت </th>
            <!-- <th> ویرایش </th>
            <th> حذف </th> -->
        </tr>
        <?php
        $cookie = $_COOKIE["Authentication"];
        $rows = Select_MyIdeas($cookie);
        while ($row = mysqli_fetch_assoc($rows)) {
            $title = $row["Title"];
            $description = $row["Description"];
            $date = $row["Date_Of_Submit"];
            echo "<tr>
<td> $title </td>
<td> $description </td>
<td> $date </td>
<!--<td> <input type=\"button\" value=\"ویرایش\"> </td>
<td> <input type=\"button\" value=\"حذف\"> </td>
--></tr>";
        }
        ?>
    </table>

</body>

</html>

<?php

?>