<?php
/**
* Простое ручное тестирование
*/
class UserStore
{
    private $users = array();    //массив для хранения пользователей

    public function addUser($name, $mail, $pass)    //добавляет нового пользователя
    {
        if(isset($this->users[$mail])){
            throw new Exception("Пользователь {$mail} уже зарегистрирован");
        }
        $this->users[$mail] = array('name' => $name, 'mail' => $mail, 'pass' => $pass);
        return true;
    }

    public function notifyPasswordFailure($mail)    //добавляет к пользователю сообщение об ошибке
    {
        if(isset($this->users[$mail])){
            $this->users[$mail]['failed'] = time();
        }
    }

    function getUser($mail)    //возвращает массив с данными о пользователе
    {
        return ($this->users[$mail]);
    }
}

//Используем инструментарий:
$store = new UserStore();
$store->addUser("Ivan Ivanov", "ivan@mail.ru", "12345");
$user = $store->getUser("ivan@mail.ru");
print_r($user);
