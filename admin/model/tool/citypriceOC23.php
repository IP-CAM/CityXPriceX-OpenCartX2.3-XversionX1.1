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
  
}