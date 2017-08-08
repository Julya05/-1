<?php
$mysqli = mysqli_connect("localhost", "root", "", "users");
$data = $_POST;

if (isset($data["do_order"])) {
    $name = mysqli_real_escape_string($mysqli, trim($_POST["name"]));
    $email = mysqli_real_escape_string($mysqli, trim($_POST["email"]));
    $street = mysqli_real_escape_string($mysqli, trim($_POST["street"]));
    $hous = mysqli_real_escape_string($mysqli, trim($_POST["hous"]));
    $housing = mysqli_real_escape_string($mysqli, trim($_POST["housing"]));
    $flat = mysqli_real_escape_string($mysqli, trim($_POST["flat"]));
    $floor = mysqli_real_escape_string($mysqli, trim($_POST["floor"]));
    $comment = mysqli_real_escape_string($mysqli, trim($_POST["comment"]));
    $errors = array();
    if (trim($data["street"]) == "") {
        $errors[] = "Введите Ваш адрес!";
    }

    if (trim($data["hous"]) == "") {
        $errors[] = "Введите номер дома!";
    }

    if (trim($data["housing"]) == "") {
        $errors[] = "Введите номер корпуса";
    }

    if (trim($data["flat"]) == "") {
        $errors[] = "Введите вномер крвартиры";
    }

    if (trim($data["floor"]) == "") {
        $errors[] = "Введите номер этажа";
    }

    if (trim($data["name"]) == "") {
        $errors[] = "Введите Ваше имя!";
    }

    if (trim($data["email"]) == "") {
        $errors[] = "Введите Ваш email!";
    }

    if (empty ($errors)) {

    } else {
        echo "<div style='color: #FF1830;'>" . array_shift($errors) . "</div><hr>";
    }

    if (!empty($name) && !empty($email) && !empty($street) && !empty($hous) && !empty($housing) && !empty($flat) && !empty($floor) && !empty($comment)) {
        $query = "SELECT * FROM `order` WHERE `street`='$street'";
        $asd = mysqli_query($mysqli, $query);
        //if (!$asd) {
         //   printf("Errormessage: %s\n", $mysqli->error);
       // }
        if (mysqli_num_rows($asd) == 0) {
            mysqli_query($mysqli, "INSERT INTO `order` (`id`, `name`,`email`,`street`,`hous`,`housing`,`flat`,`floor`,`comment`) 
VALUES (NULL, '$name', '$email','$street','$hous','$housing','$flat','$floor','$comment')");
            echo "<div style='color: #1854FF;'>Ваш заказ принят!</div>";
            $message = "Ваш заказ - DarkBeefBurger за 500 рублей будет доставлен по адресу: $street дом $hous, корпус $housing, квартира $flat, $floor этаж.  \r\n 
            Спасибо - это ваш первый заказ!";
            $to = $email;
            $subject = "Номер вашего заказа " . uniqid();
            mail($to, $subject, $message);
            mysqli_close($mysqli);
            exit ();
        } else {
            echo " ";
        }
    }
}

?>
<form action="/order.php" method="POST">

    <p>
    <p><strong>Имя</strong>:</p>
    <input type="text" name="name" value="<?php echo @$data["name"];?>">
    </p>

    <p>
    <p><strong>Email</strong>:</p>
    <input type="email" name="email" value="<?php echo @$data["email"];?>">
    </p>

    <p>
    <p><strong>Адрес</strong>:</p>
    <input type="text" name="street" value="<?php echo @$data["street"];?>">
    </p>

    <p>
    <p><strong>Дом</strong>:</p>
    <input type="number" name="hous" value="<?php echo @$data["hous"];?>">
    </p>

    <p>
    <p><strong>Корпус</strong>:</p>
    <input type="number" name="housing" value="<?php echo @$data["housing"];?>">
    </p>

    <p>
    <p><strong>Квартира</strong>:</p>
    <input type="number" name="flat" value="<?php echo @$data["flat"];?>">
    </p>

    <p>
    <p><strong>Этаж</strong>:</p>
    <input type="number" name="floor" value="<?php echo @$data["floor"];?>">
    </p>

    <p>
    <p><strong>Комментарий</strong>:</p>
    <input type="text" name="comment" value="<?php echo @$data["comment"];?>">
    </p>

    <p>
        <button type="order" name="do_order">Заказать</button>
    </p>

</form>