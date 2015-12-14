<?php
// include 'db/connection/DBSettings.php';
include 'pages/header.php';
include 'db/orm/DBConnection.php';
include 'db/orm/QueryBuilder/UserQueryBuilder.php';

echo "E-Grade Project <br>";
include 'pages/login.php';

$dBConnection = new DBConnection();
$userQueryBuilder = new UserQueryBuilder();
$result = $dBConnection->query($userQueryBuilder->selectAllUsers());
//      $result = $dBConnection->query($userQueryBuilder->createSecretariat(1, "secu", "secp", "SECRETARIAT"));
echo $result . "</br>";
mysql_data_seek($result, 0);
$row = mysql_fetch_assoc($result);
$formData = "username";
echo "username from db:   " . $row[$formData];
$result = $dBConnection->query($userQueryBuilder->createSecretariat('secu', 'secp'));
if ($result=='1') echo "</br>". "inserted query result: " . "$result </br>" . "with id ". mysql_insert_id();
//  echo $userQueryBuilder->createSecretariat();
//  echo $result;
// print_r($obj);
include 'pages/footer.php';
?>
