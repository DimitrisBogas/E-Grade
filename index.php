<?php
// include 'db/connection/DBSettings.php';
include 'pages/header.php';
include 'db/orm/DBConnection.php';
include 'db/orm/QueryBuilder/UserQueryBuilder.php';

echo "E-Grade Project <br>";
include 'pages/login.php';

$dBConnection = new DBConnection();
$userQueryBuilder = new UserQueryBuilder();
$result = $dBConnection->query($userQueryBuilder->showUsers());
//      $result = $dBConnection->query($userQueryBuilder->createSecretariat(1, "secu", "secp", "SECRETARIAT"));
echo "$result </br>";
mysql_data_seek($result, 0);
$row = mysql_fetch_assoc($result);
$formData = "username";
echo $row[$formData];
$result = $dBConnection->query($userQueryBuilder->createSecretariat('secu', 'secp'));
echo "$result </br>";
//  echo $userQueryBuilder->createSecretariat();
//  echo $result;
// print_r($obj);
include 'pages/footer.php';
?>
