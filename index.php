<?php
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'order.php';
$connection = mysqli_connect("localhost", "root", "", "users");
$data = $_POST;
if (isset($data["do_signup"])) {
    $username = mysqli_real_escape_string($connection, trim($_POST["username"]));
    $email = mysqli_real_escape_string($connection, trim($_POST["email"]));
    $phone = mysqli_real_escape_string($connection, trim($_POST["phone"]));
    $errors = array();
    if (trim($data["username"]) == "") {
        $errors[] = "Введите логин!";
    }

    if (trim($data["email"]) == "") {
        $errors[] = "Введите email!";
    }

    if (trim($data["phone"]) == "") {
        $errors[] = "Введите ваш номер телефона";
    }
    if (empty ($errors)) {

    } else {
        echo "<div style='color: #FF1830;'>" . array_shift($errors) . "</div><hr>";
    }
    if (!empty($username) && !empty($email) && !empty($phone)) {
        $query = "SELECT * FROM login WHERE Name='$username'";
        $records = mysqli_query($connection, $query);
        if (mysqli_num_rows($records) == 0) {
            mysqli_query($connection, "INSERT INTO login (id,Name,Phone, Email ) VALUES(NULL, '$username','$phone', '$email')");
            echo "<div style='color: #1854FF;'>Вы успешно зарегестрированы!</div>";
            echo "<a href='order.php'>Сделать заказ</a>";
            mysqli_close($connection);
            exit ();
        } else {
            if (!empty($username) && !empty($email) && !empty($phone)) {
                $asd = mysqli_query($connection, "SELECT 'id', 'Name', 'Phone', 'Email' FROM login WHERE Name='$username' AND Phone = '$phone' AND Email = '$email'");
                if (mysqli_num_rows($asd) == 1) {
                    header("Location: http://$host/$uri/$extra");
                    exit;
                }
            }
        }
    }
}
?>

<form action="/index.php" method="POST">
    <p>
    <p><strong>Ваш логин</strong>:</p>
    <input type="text" name="username" value="<?php echo @$data["username"];?>">
    </p>

    <p>
    <p><strong>Ваш email</strong>:</p>
    <input type="email" name="email" value="<?php echo @$data["email"];?>">
    </p>

    <p>
    <p><strong>Ваш телефон</strong>:</p>
    <input type="number" name="phone" value="<?php echo @$data["phone"];?>">
    </p>

    <p>
        <button type="submit" name="do_signup">Зарегестрироваться</button>
    </p>

</form>



