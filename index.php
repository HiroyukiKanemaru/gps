<?php
require 'connection.php';

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];

    $query = "INSERT INTO tb_data VALUES('', '$name', '$email', '$latitude', '$longitude')";
    mysqli_query($conn, $query);

    echo
    "
    <script>
    alert('Data Added Successfully');
    document.location.href='data.php';
    </script>
    ";
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data With Geolocation Data</title>
</head>

<body onload="getLocation();">
    <form class="myform" action="" method="post" autocomplete="off">
        <label for="">Name</label>
        <input type="text" name="name" required value=""><br>
        <label for="">Email</label>
        <input type="email" name="email" required value=""><br>
        <input type="hidden" name="latitude" value="">
        <input type="hidden" name="longitude" value="">
        <button type="submit" name="submit">Submit</button>
    </form>
    <script type="text/javascript">
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            }
        }

        function showPosition(position) {
            document.querySelector('.myform input[name = "latitude"]').value = position.coords.latitude;
            document.querySelector('.myform input[name = "longitude"]').value = position.coords.longitude;
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("You Must Allow The Request For Geolocation To Fill Out The Form");
                    Location.reload();
                    break;
            }
        }
    </script>
    <br>
    <a href="data.php">Database Page</a>
</body>

</html>
