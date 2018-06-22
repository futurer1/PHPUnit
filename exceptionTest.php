   /**
     * Тестирование того, что выбрасывается исключение
     * Проверяет чтобы было выброшено именно то исключение, которое необходимо
     */
    public function testMethodWithException()
    {
        
        $mockClass = $this->getMockBuilder('\SomeClass')->setMethods(['someMethod'])->getMock();

        try {
            // отправляем неверные значения, которые должны привести к выбрасыванию исключения
            $mockClass->anotherMethod('parameter');
            $this->fail('no exception');
        } catch (\Exception $e) {
            if($e->getCode() != 1234) { // код того исключения, которое мы ожидаем
                $this->fail("Нет ожидаемого исключения! Ожидалось: 1234; Пришло: ".$e->getCode()." (".$e->getMessage().")\n");
            }
        }
    }
    
    /**
     * Тестирование только того, что исключения выбрасывается
     * идентично тесту testMethodWithException()
     * но проигрывает ему, так как контролирует только сам факт выброса исключения, но не какое именно было выброшено
     */
    public function testMethodWithException1()
    {
        // ожидаем исключение
        $this->expectException(\Exception::class);
        
        $mockClass = $this->getMockBuilder('\SomeClass')->setMethods(['someMethod'])->getMock();
        $mockClass->anotherMethod('parameter');
    }
