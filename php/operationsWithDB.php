<?php
require_once 'user.php';


function checkRating($idPost, $userEmail) {
    try {
        $db = new PDO('pgsql:host=127.0.0.1;dbname=photoLabDB', 'user', '123qwe');
        $query = 'SELECT "idRating" FROM public."postsRatings" WHERE ("idPost" = :idPost AND "userEmail" = :userEmail);';
        $params = [
            ':idPost' => $idPost,
            ':userEmail' => $userEmail,
        ];
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $rating = $stmt->fetch();
        $db = null;
        return isset($rating['idRating']);
    } catch (PDOException $th) {
        print 'Ошибка '. $th->getMessage();
        die();
    }
}


function addRating($userEmail, $idPost, $value) {
    try {
        $db = new PDO('pgsql:host=127.0.0.1;dbname=photoLabDB', 'user', '123qwe');
        $db->beginTransaction();
        $query = 'INSERT INTO "postsRatings" ("idPost", "userEmail", "valueRating" ) VALUES(:idPost, :userEmail, :value) RETURNING "idRating";';
        $params = [
            ':idPost' => $idPost,
            ':userEmail' => $userEmail,
            ':value' => $value,
        ];
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $ratingId = $stmt->fetch();
        $query = 'UPDATE public."photoLabPosts" SET ratings= array_append(ratings, :idRating) WHERE "photoLabPosts"."idPost" = :idPost;';
        $params = [
            ':idPost' => $idPost,
            ':idRating' => $ratingId['idRating'],
        ];
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $query = 'UPDATE public."photoLabPosts" SET "middleRating"= (SELECT avg("postsRatings"."valueRating") FROM public."postsRatings" WHERE public."postsRatings"."idPost" = :idPost) WHERE public."photoLabPosts"."idPost" = :idPost;';
        $params = [
            ':idPost' => $idPost,
        ];
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $db->commit();
        $db = null;
    } catch (PDOException $th) {
        $db->rollBack();
        print 'Ошибка '. $th->getMessage();
        die();
    }
}


function addPost($userEmail, $url, $description) {
    try {
        $db = new PDO('pgsql:host=127.0.0.1;dbname=photoLabDB', 'user', '123qwe');
        $query = 'INSERT INTO "photoLabPosts" ("description", "datePublication", "urlPhoto", "userEmail") VALUES(:description, :datePublication, :urlPhoto, :userEmail)';
        $params = [
            ':description' => $description,
            ':datePublication' => date( "Y-m-d" ),
            ':urlPhoto' => $url,
            ':userEmail' => $userEmail
        ];
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        $db = null;
    } catch (PDOException $th) {
        print 'Ошибка '. $th->getMessage();
        die();
    }
}


function getLastPhotos(){
    try {
        $db = new PDO('pgsql:host=127.0.0.1;dbname=photoLabDB', 'user', '123qwe');
        $query = 'SELECT "idPost", description, "datePublication", "middleRating", ratings, "urlPhoto", "userEmail" FROM public."photoLabPosts" ORDER BY "datePublication" DESC LIMIT 20;';
        $stmt = $db->prepare($query);
        $stmt->execute();
        $photoArray = [];
        while ($row = $stmt->fetch()) {
            $tmpPost = new photoPost();
            $tmpPost->postId = $row["idPost"];
            $tmpPost->authorEmail = $row["userEmail"];
            $tmpPost->urlPhoto = $row["urlPhoto"];
            $tmpPost->description = $row["description"];
            $tmpPost->middleRating = $row["middleRating"];
            $tmpPost->datePublication = $row["datePublication"];
            //$tmpPost->countRatings = @count($row["ratings"]);
            $photoArray[] = $tmpPost;
        }
        $db = null;
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
        $query = 'SELECT "idPost", description, "datePublication", "middleRating", ratings, "urlPhoto", "userEmail" FROM public."photoLabPosts" WHERE public."photoLabPosts"."userEmail" = ? ORDER BY "datePublication" DESC';
        $stmt = $db->prepare($query);
        $stmt->execute([$userEmail]);
        $photoArray = [];
        while ($row = $stmt->fetch()) {
            $tmpPost = new photoPost();
            $tmpPost->postId = $row["idPost"];
            $tmpPost->urlPhoto = $row["urlPhoto"];
            $tmpPost->description = $row["description"];
            $tmpPost->middleRating = $row["middleRating"];
            $tmpPost->datePublication = $row["datePublication"];
            $tmpPost->countRatings = $row["ratings"];
            $photoArray[] = $tmpPost;
        }
        $db = null;
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
        $db = null;
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
        $db = null;
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
        $db = null;
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