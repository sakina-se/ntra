<?php

namespace Controller;

use App\Ads;
use App\User;

class UserController
{
    public function index(): void
    {

        $branches = (new \App\User())->getUsers();


        loadView('dashboard/branches', ['ads' => $branches]);
    }

    public function create(): void
    {
        $user = new User();
        if ($_POST['username'] && $_POST['position'] && $_POST['gender'] && $_POST['phone'] && $_POST['email'] && $_POST['password']) {
            $username = $_POST['username'];
            $position = $_POST['position'];
            $gender = $_POST['gender'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $stmt = $user->createUser($username, $position, $gender, $phone, $email, $password);
            if ($stmt) {
                header('Location: /');
                exit();
            }
        }
    }

    public function login(): void
    {
        $user = new User();
        if ($_POST['email'] && $_POST['password']) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $stmt = $user->checkUser($email, $password);
            if ($stmt) {
                header('Location: /');
                exit();
            }
        }
    }

    public function loadProfile(): void
    {
        $ads = (new Ads())->getUsersAds($_SESSION['user']['id']);
        loadView('profile', ['ads' => $ads], false);
    }
}