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
        if(isset($_SESSION['id_user']) && isset($_SESSION['role']) && $_SESSION['role'] == 2) {
            $this->render('index', ['user' => $user->getUser($_SESSION['id'])]);
        } else {
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=index");
            exit();
        }

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

    public function itemAdd()
    {
        $mapper = new ItemMapper();
        $user = new UserMapper();
        $item = null;

        if ($this->isPost()) {
            //VALIDATE INPUTS
            $validationFailed = false;
            $messages[] = null;
            if(preg_match('/[^A-Za-z]/', $_POST['name'])) {
                $validationFailed = true;
                array_push($messages, 'The name should only consist of letters ('.$_POST['name'].' is wrong!)');
            }
            if(preg_match('/[^0-9]/', (int)$_POST['price'])) {
                $validationFailed = true;
                array_push($messages, 'The price should only consist of numbers (' . (int)$_POST['price'] . ' is wrong!)');
            }//JAKI HTTP RESPONSE CODE

                if($validationFailed) {
                    return $this->render('index', ['message' => $messages]);
                }
                $tmp = $mapper->addItem($_POST['name'], (int)$_POST['price']);

                return $this->render('index', ['user'=> $user->getUser($_SESSION['id']),'message' => ['Your item has been registered!']]);
            }
            $this->render('index', ['user'=> $user->getUser($_SESSION['id']),'message' => ['Your item has been registered!']]);
    }
}