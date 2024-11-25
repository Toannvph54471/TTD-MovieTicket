<?php

class UserLoginController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function showFormLogin()
    {
        $view = 'authen/form-login';

        $title = 'Đăng nhập';
        $description = 'Đăng nhập với tài khoản TTD Movie Ticket';

        require_once PATH_VIEW_CLIENT_MAIN;
    }

    public function login()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                throw new Exception("Yêu cầu phương thức phải là POST !");
            }

            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;


            if (empty($email) || empty($password)) {
                throw new Exception('Email và Password không được để trống!');
            }

            $user = $this->user->find(
                '*',
                'email = :email AND password = :password',
                [
                    'email'     => $email,
                    'password'  => $password
                ]
            );

            if (empty($user)) {
                throw new Exception('Thông tin tài khoản không đúng!');
            }

            // Kiểm tra role tài khoản
            if (!empty($user)) {
                $_SESSION['user'] = $user;
                header('Location: ' . BASE_URL);
                exit();
            }
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();

            header('Location: ' . BASE_URL . '?action=show-form-login');
            exit();
        }
    }

    public function logout()
    {
        session_destroy();

        header('Location: ' . BASE_URL);
        exit();
    }

    public function info()
    {
        $view ='authen/info-user';
        $title='Thông tin người dùng';
        $description='Hiển thị thông tin người dùng';

        $id = $_SESSION['user']['id'];

        $user=$this->user->getID($id);

        require_once PATH_VIEW_CLIENT_MAIN;
    }
}
