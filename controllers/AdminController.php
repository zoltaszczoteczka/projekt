<?php
require_once 'AppController.php';

require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../model/UserMapper.php';
require_once __DIR__.'/../model/ItemMapper.php';

class AdminController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $user = new UserMapper();
        $this->render('index', ['user' => $user->getUser($_SESSION['id'])]);
    }

    public function users(): void
    {
        $user = new UserMapper();

        header('Content-type: application/json');
        http_response_code(200);

        echo $user->getUsers() ? json_encode($user->getUsers()) : '';
    }

    public function userDelete(): void
    {
        if (!isset($_POST['id'])) {
            http_response_code(404);
            return;
        }

        $user = new UserMapper();
        $user->delete((int)$_POST['id']);

        http_response_code(200);
    }


    public function items(): void
    {
        $items = new ItemMapper();

        header('Content-type: application/json');
        http_response_code(200);

        echo $items->getItems() ? json_encode($items->getItems()) : '';
    }

    public function itemDelete(): void
    {
        if (!isset($_POST['id_item'])) {
            http_response_code(404);
            return;
        }

        $items = new ItemMapper();
        $items->delete((int)$_POST['id_item']);

        http_response_code(200);
    }

    public function itemAdd(): void
    {
        //JAKI HTTP RESPONSE CODE
        $items = new ItemMapper();
        $items->addItem((string)$_POST['name'],(int)$_POST('price'));
    }
}