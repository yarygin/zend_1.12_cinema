<?php

class Application_Model_DbTable_Movie extends Zend_Db_Table_Abstract
{

    protected $_name = 'movie';

    // Метод для получения записи по id
    public function getMovie($id)
    {
        // Получаем id как параметр
        $id = (int)$id;

        // Используем метод fetchRow для получения записи из базы.
        // В скобках указываем условие выборки (привычное для вас where)
        $row = $this->fetchRow('id = ' . $id);

        // Если результат пустой, выкидываем исключение
        if(!$row) {
            throw new Exception("Нет записи с id - $id");
        }
        // Возвращаем результат, упакованный в массив
        return $row->toArray();
    }
    
    // Метод для добавление новой записи
    public function addMovie($title, $published)
    {
        // Формируем массив вставляемых значений
        $data = array(
            'title' => $title,
            'published' => $published,
        );
        
        // Используем метод insert для вставки записи в базу
        $this->insert($data);
    }
    
    // Метод для обновления записи
    public  function updateMovie($id, $title, $published)
    {
        // Формируем массив значений
        $data = array(
            'title' => $title,
            'published' => $published,
        );
        
        // Используем метод update для обновления записи
        // В скобках указываем условие обновления (привычное для вас where)
        $this->update($data, 'id = ' . (int)$id);
    }
    
    // Метод для удаления записи
    public function deleteMovie($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('id = ' . (int)$id);
    }
}
