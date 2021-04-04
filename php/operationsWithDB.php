<?php

function addUserToDB($userFirstName, $userSecondName, $userFatherName, $userEmail, $userHashPassword)
{
    try {
        $db = new PDO('pgsql:host=127.0.0.1;dbname=photoLabDB', 'user', '123qwe');
        if (!checkUserInDB($userEmail)) {
            $db = NULL;
            return 'REGISTRATION_FALL_USER_ALREADY_REGISTRED';
        }
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
        $db = NULL;
        return true;
    } catch (PDOException $th) {
        print 'Ошибка '. $th->getMessage();
        die();
    }
    
}

function checkUserInDB($userEmail)
{
    try {
        $db = new PDO('pgsql:host=127.0.0.1;dbname=photoLabDB', 'user', '123qwe');
        $query = 'SELECT pUsers.email FROM "photoLabUsers" as pUsers WHERE pUsers.email = ?';
        $stmt = $db->prepare($query);
        $stmt->execute([$userEmail]);
        $user = $stmt->fetch();
        return empty($user);
    } catch (PDOException $th) {
        print 'Ошибка '. $th->getMessage();
        die();
    }
}

function findUserInDB($userEmail, $userPassword)
{
    try {
        $db = new PDO('pgsql:host=127.0.0.1;dbname=photoLabDB', 'user', '123qwe');
        $query = 'SELECT pUsers.email, pUsers.hashpassword FROM "photoLabUsers" as pUsers WHERE pUsers.email = ?';
        $stmt = $db->prepare($query);
        $stmt->execute([$userEmail]);
        $user = $stmt->fetch();
        if ($user == false) {
            return 'NO_USER_WITH_THAT_EMAIL';
        }
        else {
            if (!password_verify($userPassword, $user['hashpassword'])) {
                return 'WRONG_PASSWORD';
            }
            else {
                return true;
            }
        }
    } catch (PDOException $th) {
        print 'Ошибка '. $th->getMessage();
        die();
    }
}