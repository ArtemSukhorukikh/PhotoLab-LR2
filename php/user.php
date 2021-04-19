<?php
require_once 'operationsWithDB.php';

class user //Класс описывающий основные информационные поля пользователя
{
    public $id;
    public $name;
    public $secondName;
    public $fatherName;
    public $email;
    public $userPosts;

    public function getData($userEmail, $type) // Заполенение данных о пользователе
    {
        $tmpUser = getUser($userEmail, $type);
        $this->id = $tmpUser->id;
        $this->name = $tmpUser->name;
        $this->secondName = $tmpUser->secondName;
        $this->fatherName = $tmpUser->fatherName;
        $this->email = $tmpUser->email;
    }


    public function getUsersPostsData($userEmail) // Получение публикаций пользователя
    {
        $this->userPosts = getUserPhotos($userEmail);
    }
}


class photoPost // Класс описывающий пост пользователя
{
    public $postId;
    public $authorEmail;
    public $urlPhoto;
    public $description;
    public $countRatings;
    public $middleRating;
    public $datePublication;
}