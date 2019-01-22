<?php
require_once 'AppController.php';
require_once __DIR__.'/../model/ItemMapper.php';

class UploadController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['video/mp4', 'video/mov'];

    private $message = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function items(): void
    {
        $items = new ItemMapper();

        header('Content-type: application/json');
        http_response_code(200);

        echo $items->getItems() ? json_encode($items->getItems()) : '';
    }

    public function upload()
    {

        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {

            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $this->message[] = 'File uploaded.';
        }

        //$this->render('upload', [ 'message' => $this->message]);

        if(isset($_SESSION['id']))
            return $this->render('upload', [ 'message' => $this->message]);
        else {
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=index");
            exit();
        }
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported.';
            return false;
        }

        return true;
    }
}