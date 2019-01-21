<?php

require_once "AppController.php";

require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../model/UserMapper.php';


class DefaultController extends AppController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $text = 'Hello there 👋';

        $this->render('index', ['text' => $text]);
    }

    public function login()
    {
        $mapper = new UserMapper();

        $user = null;

        if ($this->isPost()) {

            $user = $mapper->getUser($_POST['email']);

            if(!$user) {
                return $this->render('login', ['message' => ['Email not recognized']]);
            }

            if ($user->getPassword() !== md5($_POST['password'])) {
                return $this->render('login', ['message' => ['Wrong password']]);
            } else {
                $_SESSION["id"] = $user->getEmail();
                $_SESSION["role"] = $user->getRole();

                $url = "http://$_SERVER[HTTP_HOST]/";
                header("Location: {$url}?page=index");
                exit();
            }
        }

        $this->render('login');
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        $this->render('index', ['text' => 'You have been successfully logged out!']);
    }

    public function register()
    {
        $mapper = new UserMapper();
        $user = null;
        if ($this->isPost()) {

            $validationFailed = false;
            $messages[] = null;
            if(preg_match('/[^A-Za-z]/', $_POST['name'])) {
                $validationFailed = true;
                array_push($messages, 'The name should only consist of letters ('.$_POST['name'].' is wrong!)');
            }
            if(preg_match('/[^A-Za-z]/', $_POST['surname'])) {
                $validationFailed = true;
                array_push($messages, 'The surname should only consist of letters ('.$_POST['surname'].' is wrong!)');
            }
            if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/', $_POST['email'])) {
                $validationFailed = true;
                array_push($messages, 'The email provided is valid ('.$_POST['email'].' is wrong!)');
            }
            if($validationFailed) {
                return $this->render('register', ['message' => $messages]);
            }

            $user = $mapper->getUser($_POST['email']);
            if(!($user->getEmail() == null) && !($user->getEmail() == '')) {
                return $this->render('register', ['message' => ['This email has already been used!']]);
            }

            $tmp = $mapper->addUser($_POST['name'], $_POST['surname'], $_POST['email'], md5($_POST['password']));
            return $this->render('register', ['message' => ['Your account has been registered!']]);
        }
        $this->render('register');
    }
}