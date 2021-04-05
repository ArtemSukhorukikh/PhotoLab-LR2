<?php
require_once 'operationsWithDB.php';


class user
{
    public $id;
    public $name;
    public $secondName;
    public $fatherName;
    public $email;
    public $userPosts;

    public function getData($userEmail, $type)
    {
        $tmpUser = getUser($userEmail, $type);
        $this->id = $tmpUser->id;
        $this->name = $tmpUser->name;
        $this->secondName = $tmpUser->secondName;
        $this->fatherName = $tmpUser->fatherName;
        $this->email = $tmpUser->email;
    }


    public function getUsersPostsData($userEmail)
    {
        $this->userPosts = getUserPhotos($userEmail);
    }
}


class photoPost
{
    public $postId;
    public $authorId;
    public $urlPhoto;
    public $description;
    public $countRatings;
    public $middleRating;
    public $datePublication;
}