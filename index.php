<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
           // include 'db/connection/DBSettings.php';
            include 'db/orm/DBConnection.php';
            include 'db/orm/QueryBuilder/UserQueryBuilder.php';

            echo "E-Grade Project </br>";
            $dBConnection = new DBConnection();
            $userQueryBuilder = new UserQueryBuilder();
            $result  = $dBConnection->query($userQueryBuilder->showUsers());
      //      $result = $dBConnection->query($userQueryBuilder->createSecretariat(1, "secu", "secp", "SECRETARIAT"));
        echo "$result </br>";
            mysql_data_seek($result, 0);
            $row = mysql_fetch_assoc($result);
            $formdata="username";
            echo $row[$formdata];
        $result = $dBConnection->query($userQueryBuilder->createSecretariat('secu', 'secp', 'SECRETARY'));
        echo "$result </br>";
//  echo $userQueryBuilder->createSecretariat();
          //  echo $result;
           // print_r($obj);
        ?>
    </body>
</html>