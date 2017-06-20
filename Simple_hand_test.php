<?php
/**
* Простое ручное тестирование
*/
class UserStore
{
    private $users = array();    //массив для хранения пользователей

    public function addUser($name, $mail, $pass)
    {
        if(isset($this->users[$mail])){
            throw new Exception("Пользователь {$mail} уже зарегистрирован");
        }
        $this->users[$mail] = array('name' => $name, 'mail' => $mail, 'pass' => $pass);
        return true;
    }

    public function notifyPasswordFailure()
    {
    }

    function getUser($mail)
    {
    }
}

//Используем инструментарий:
$store = new UserStore();
$store->addUser("Ivan Ivanov", "ivan@mail.ru", "12345");
$user = $store->getUser("ivan@mail.ru");
print_r($user);
