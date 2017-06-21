<?php
/**
* Использование клиентского класса для тестирования основного класса.
* Validator - класс-валидатор для проверки данных перед отправкой их куда-то ещё.
* Validator сверяется с содержимым хранилища в объекте UserStore $store.
*/
class Validator
{
/**
* Используется для хранения экземпляра объекта класса UserStore
*
* @var object
*/
    private $store;
    
    public function __construct(UserStore $store)
    {
        $this->store = $store;
    }
  
    public function validateUser($mail, $pass)
    {
        if(!is_array($user = $this->store->getUser($mail))) {    //если метод объекта $store не может 
                                                                 //вернуть массив с данными о пользователе
            return false;
        }
        if($user['pass'] == $pass) {    //если проверяемый пароль совпал с возвращенным из объекта $store
            return true;
        }
        $this->store->notifyPasswordFailure($mail);
        return false;
    }
}

/**
* Проверяемый класс
*/
class UserStore
{
/**
* Массив для хранения пользователей
*
* @var array
*/
    private $users = array();
    
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

$validator = new Validator($store);
if($validator->validateUser("ivan@mail.ru", "12345")) {
    echo "Пользователь найден.";
}
