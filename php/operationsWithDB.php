<?php

function addUserToDB($userFirstName, $userSecondName, $userFatherName, $userEmail, $userHashPassword){
    try {
        $db = new PDO('pgsql:host=127.0.0.1;dbname=photoLabDB', 'user', '123qwe');
        $query = 'INSERT INTO "photoLabUsers" ("firstname", "secondname", "fathername", "email", "hashpassword") VALUES(:firstname, :secondname, :fathername, :email, :hashpassword)';
        $params = [
            ':firstname' => $userFirstName,
            ':secondname' => $userSecondName,
            ':fathername' => $userFatherName,
            ':email' => $userEmail,
            ':hashpassword' => $userHashPassword
        ];
        $stmt = $db->prepare($query);
        $stmt->execute($params);
    } catch (PDOException $th) {
        print 'Ошибка '. $th->getMessage();
        die();
    }
    
}