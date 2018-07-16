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
  
}