<?php

class ModelToolCitypriceOC23 extends Model {

    //При инстализации модуля создаем таблицы
    public function createTables(){
        $sql = array();

        
        $sql[] = "
                        
            CREATE TABLE IF NOT EXISTS `".DB_PREFIX."city_price` (
             `id` int(255) NOT NULL,
       `product_id` int(255) NOT NULL,
       `city_id` int(255) NOT NULL,
       `price` decimal(15,4) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

        ";



        foreach( $sql as $q ){
             $this->db->query( $q );
        }
        return true;
    }

    //добавляем новую запись
    public function AddNew($data){

      $this->db->query('INSERT INTO `'.DB_PREFIX.'city_price` SET product_id = ' . (int)$data["product_id"] . ', `city_id` = "' . (int)$data["city_id"] . '", `price` = "' . $data["price"] . '"');  
      
      return true;

    }

    //сохраняем новые полученные данные (редактирования)
    public function updateInfo($data){
      $this->db->query("UPDATE " . DB_PREFIX . "city_price SET  product_id = '" .$data['product_id']. "', city_id = '" .$data['city_id']. "', price = '" .$data['price']. "'  WHERE id = '" .(int)$data['id']. "'");

      return true;
    }


    //по имени делаем поиск товара, а в ответ получаем ид товара
    public function FindProductID($name){

      $query = $this->db->query("SELECT product_id FROM `".DB_PREFIX."product_description` WHERE name LIKE '$name' ");
      
      return $query->row;
    }

    //делаем поиск по названию города, что бы получить  его id
    public function FindCityID($name){

      $query = $this->db->query("SELECT zone_id FROM `".DB_PREFIX."zone` WHERE name LIKE '$name' ");
      
      return $query->row;

    }

    //по id товара делаем поиск и получаем имя товара
    public function FindProductName($id){
      $query = $this->db->query("SELECT name FROM `".DB_PREFIX."product_description` WHERE product_id = $id ");
      
      return $query->row;

    }

    //по id города получаем его название
    public function FindCityName($id){
      $query = $this->db->query("SELECT name FROM `".DB_PREFIX."zone` WHERE zone_id = $id ");
      
      return $query->row;

    }

    //получаем весь товар, что есть в таблице oc_city_price
    public function getAllProducts(){
      $query = $this->db->query("SELECT * FROM `".DB_PREFIX."city_price` ORDER BY id DESC LIMIT 5");
      
      return $query->rows;

    }

    //получаем список имен товара по живому поиску
    public function FindLiveProduct($q){
      $query = $this->db->query("SELECT name FROM `".DB_PREFIX."product_description` WHERE name LIKE '%{$q}%' LIMIT 10 ");
      
      return $query->rows;
    }

    //получаем список имен товара по живому поиску
    public function FindLiveCity($q){
      $query = $this->db->query("SELECT name FROM `".DB_PREFIX."zone` WHERE name LIKE '%{$q}%' LIMIT 10 ");
      
      return $query->rows;
    }

    //метод по удалению строки с базы
    public function delID($id){
      $this->db->query("DELETE FROM `".DB_PREFIX."city_price` WHERE id = $id ");  
      return true;
    }

    //подсчитываем количество элементов в таблице (для пагинации)
    public function countProduct(){
      $query = $this->db->query("SELECT COUNT(*) AS id FROM `".DB_PREFIX."city_price`");
      
      return $query->row['id'];
    }
  
}