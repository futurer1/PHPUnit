<?php
/**
* Использование клиентского класса для тестирования основного класса
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
    }
}
