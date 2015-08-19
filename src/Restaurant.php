<?php
    class Restaurant
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurants (name) VALUES ('{$this->getName()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
            $restaurants = array();
            foreach($returned_restaurants as $restaurant) {
                $name = $restaurant['name'];
                $id = $restaurant['id'];
                $new_restaurant = new Restaurant($name, $id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM restaurants;");
        }

        static function find($search_id)
        {
            $found_restaurant = null;
            $restaurants = Restaurant::getAll();
            foreach($restaurants as $restaurant) {
                $restaurant_id = $restaurant->getId();
                if ($restaurant_id == $search_id) {
                  $found_restaurant = $restaurant;
                }
            }
            return $found_restaurant;
        }
    }
?>