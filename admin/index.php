<?php
$mysqli = mysqli_connect("localhost", "root", "", "users");
$data = $_POST;
    $qr_result = mysqli_query ($mysqli, "SELECT Name FROM login" );
    $result = mysqli_query ($mysqli, "SELECT name FROM `order`" );
  echo '<table border="1">';
  echo '<thead>';
  echo '<tr>';
  echo '<th>Name</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
  while($data = mysqli_fetch_array($qr_result)){
      echo '<tr>';
      echo '<td>' . $data['Name'] . '</td>';
      echo '</tr>';
  }
echo '<table border="1">';
echo '<thead>';
echo '<tr>';
echo '<th>Order</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
while($asd = mysqli_fetch_array($result)){
    echo '<tr>';
    echo '<td>' . $asd['name'] . '</td>';
    echo '</tr>';
}

    echo '</tbody>';
  echo '</table>';
    mysqli_close($mysqli);
?>

<code lang="php">
