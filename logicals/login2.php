<?php
if(isset($_POST['username']) && isset($_POST['password'])) {
    try {
        // Connect
        $dbh = new PDO('mysql:host=localhost;dbname=databaselesson', 'root', '',
                        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_general_ci');
        
        // Search user
        $sqlSelect = "select id, first_name, last_name from users where user_name = :user_name and password = sha1(:password)";
        $sth = $dbh->prepare($sqlSelect);
        $sth->execute(array(':user_name' => $_POST['username'], ':password' => $_POST['password']));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $_SESSION['fn'] = $row['first_name']; $_SESSION['ln'] = $row['last_name']; $_SESSION['login'] = $_POST['username'];
        }
    }
    catch (PDOException $e) {
        $errormessage = "Hiba: ".$e->getMessage();
    }      
}
else {
    header("Location: .");
}
?>
