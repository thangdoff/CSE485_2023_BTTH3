<?php
require_once 'services/UserService.php';
require_once 'vendor/autoload.php';
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
class UserController
{
    // Hàm xử lý hành động index
    public function index()
    {
        // Nhiệm vụ 1: Tương tác với Services/Models
        echo "Tương tác với Services/Models from Article";
        // Nhiệm vụ 2: Tương tác với View
        echo "Tương tác với View from Article";
    }

    public function list()
    {
        // Nhiệm vụ 1: Tương tác với Services/Models
        // echo "Tương tác với Services/Models from Article";
        $userService = new UserService();
        $users = $userService->getAllUsers();
        // Nhiệm vụ 2: Tương tác với View
        $loader = new FilesystemLoader('views');
        $twig = new Environment($loader);
        $content = $twig->load('user/list_user.html.twig');
        echo $content->render(array(
            'users' => $users,
        ));
    }
    
    public function edit()
    {
        $this->userService = new UserService();
        $findUser = $this->userService ->findUserById($_GET['id']);
        $enum_list = $this->userService->getAllRole();
        if (isset($_POST['save'])) {
            $result = $this->userService ->editUser($_GET['id'], $_POST['username'], $_POST['password'], $_POST['role']);
            if ($result) {
                header('location:/CSE485_2023_BTTH03_3/index.php?controller=user&action=list');
            }
        }

        $loader = new FilesystemLoader('views');
        $twig = new Environment($loader);
        $content = $twig->load('user/edit_user.html.twig');
        echo $content->render(array(
             'findUser' =>$findUser,
             'enum_list'=>$enum_list
            ));
    }

    public function add()
    {
        // Nhiệm vụ 1: Tương tác với Services/Models
        // echo "Tương tác với Services/Models from Article";
        // Nhiệm vụ 2: Tương tác với View
        $this->userService = new UserService();
        $enum_list = $this->userService->getAllRole();
        if (isset($_POST['submit'])) {
            $result = $this->userService->addUser($_POST['username'], $_POST['password'], $_POST['role']);
            if ($result) {
                header('location:/CSE485_2023_BTTH03_3/index.php?controller=user&action=list');
            }
        }
        $loader = new FilesystemLoader('views');
        $twig = new Environment($loader);
        $content = $twig->load('user/add_user.html.twig');
        echo $content->render(array(
             'enum_list'=>$enum_list
            ));
    }

    public function delete(){
        $this->userService = new UserService();
        if (isset($_GET['id'])){
            $result = $this->userService->deleteUser($_GET['id']);
            if($result){
                header('location:/CSE485_2023_BTTH03_3/index.php?controller=user&action=list');
            }
        }
        include("views/user/list_user.php");
    }


}