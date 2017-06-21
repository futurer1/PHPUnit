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
    }
}
