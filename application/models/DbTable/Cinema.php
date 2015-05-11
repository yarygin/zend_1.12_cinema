<?php

class Application_Model_DbTable_Cinema extends Zend_Db_Table_Abstract
{

    protected $_name = 'cinema';

    public function getCinemaByName($name)
    {
        // Получаем id как параметр
        $name = $name;

        // Используем метод fetchRow для получения записи из базы.
        // В скобках указываем условие выборки (привычное для вас where)
        $row = $this->fetchRow('name = "' . $name . '"');

        // Если результат пустой, выкидываем исключение
        if(!$row) {
            throw new Exception("Нет записи с name - $name");
        }
        // Возвращаем результат, упакованный в массив
        return $row->toArray();
    }

}

