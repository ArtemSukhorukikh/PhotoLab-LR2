<?php
require_once 'user.php';


function getLastPhotos(){
    try {
        $db = new PDO('pgsql:host=127.0.0.1;dbname=photoLabDB', 'user', '123qwe');
        $query = 'SELECT "idPost", "idUser", description, "datePublication", "middleRating", ratings, "urlPhoto" FROM public."photoLabPosts" ORDER BY "datePublication" DESC LIMIT 20;';
        $stmt = $db->prepare($query);
        $stmt->execute();
        $photoArray = [];
        while ($row = $stmt->fetch()) {
            $tmpPost = new photoPost();
            $tmpPost->postId = $row["idPost"];
            $tmpPost->authorId = $row["idUser"];
            $tmpPost->urlPhoto = $row["urlPhoto"];
            $tmpPost->description = $row["description"];
            $tmpPost->middleRating = $row["middleRating"];
            $tmpPost->datePublication = $row["datePublication"];
            //$tmpPost->countRatings = @count($row["ratings"]);
            $photoArray[] = $tmpPost;
        }
        return $photoArray;
    } catch (PDOException $th) {
        print 'Ошибка '. $th->getMessage();
        die();
    }
    return 'ERROR';
}


function getUserPhotos($userEmail)
{
    try {
        $db = new PDO('pgsql:host=127.0.0.1;dbname=photoLabDB', 'user', '123qwe');
        $query = 'SELECT "idPost", "idUser", description, "datePublication", "middleRating", ratings, "urlPhoto" FROM public."photoLabPosts" WHERE public."photoLabPosts"."idUser" = (SELECT "id" FROM public."photoLabUsers" WHERE public."photoLabUsers"."email" = ?) ORDER BY "datePublication" DESC';
        $stmt = $db->prepare($query);
        $stmt->execute([$userEmail]);
        $photoArray = [];
        while ($row = $stmt->fetch()) {
            $tmpPost = new photoPost();
            $tmpPost->urlPhoto = $row["urlPhoto"];
            $tmpPost->description = $row["description"];
            $tmpPost->middleRating = $row["middleRating"];
            $tmpPost->datePublication = $row["datePublication"];
            //$tmpPost->countRatings = @count($row["ratings"]);
            $photoArray[] = $tmpPost;
        }
        return $photoArray;
    } catch (PDOException $th) {
        print 'Ошибка '. $th->getMessage();
        die();
    }
    return 'ERROR';
}


function getUser($userValue, $type = 'email')
{
    try {
        $db = new PDO('pgsql:host=127.0.0.1;dbname=photoLabDB', 'user', '123qwe');
        if ($type == 'email') {
            $query = 'SELECT pUsers.id, pUsers.firstname, pUsers.secondname, pUsers.fathername, pUsers.email FROM "photoLabUsers" as pUsers WHERE pUsers.email = ?';
        }
        else {
            $query = 'SELECT pUsers.id, pUsers.firstname, pUsers.secondname, pUsers.fathername, pUsers.email FROM "photoLabUsers" as pUsers WHERE pUsers.id = ?';
        }
        $stmt = $db->prepare($query);
        $stmt->execute([$userValue]);
        $userData = $stmt->fetch();
        if (empty($userData)) {
            return "NO_SUCH_USER_IN_DB";
        }
        else {
            $user = new user();
            $user->id = $userData['id'];
            $user->name = $userData['firstname'];
            $user->secondName = $userData['secondname'];
            $user->fatherName = $userData['fathername'];
            $user->email = $userData['email'];
            return $user;
        }
    } catch (PDOException $th) {
        print 'Ошибка '. $th->getMessage();
        die();
    }
    return 'ERROR';
}

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
            return false;
        }
        else {
            if (!password_verify($userPassword, $user['hashpassword'])) {
                return false;
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