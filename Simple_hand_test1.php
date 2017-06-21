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
