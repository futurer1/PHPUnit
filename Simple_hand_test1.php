<?php
/**
* Использование клиентского класса для тестирования основного класса.
* Validator - класс-валидатор для проверки данных перед отправкой их куда-то ещё.
* Validator сверяется с содержимым хранилища в объекте UserStore $store.
*/
class Validator
{
    private $store;
    
    public function __construct(UserStore $store)
    {
        $this->store = $store;
    }
  
    public function validateUser($mail, $pass)
    {
        if(!is_array($user = $this->store->getUser($mail))) {    //если метод объекта store не может 
                                                                 //вернуть массив с данными о пользователе
            return false;
        }
        if($user['pass'] == $pass) {    //если проверяемый парольсовпал с возвращенным из объекта store
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
