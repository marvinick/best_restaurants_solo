<?php
    class Restaurant
    {
        private $name;
        private $id;
        private $location;
        private $cuisine_id;


        function __construct($name, $id = null, $location, $cuisine_id)
        {
            $this->name = $name;
            $this->id = $id;
            $this->location = $location;
            $this->cuisine_id = $cuisine_id;

        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setLocation($new_location)
        {
            $this->location = (string) $new_location;
        }

        function getLocation()
        {
            return $this->location;
        }

        function getId()
        {
            return $this->id;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurants (name, location, cuisine_id) VALUES ('{$this->getName()}', '{$this->getLocation()}', {$this->getCuisineId()})");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
            $restaurants = array();
            foreach($returned_restaurants as $restaurant) {
                $name = $restaurant['name'];
                $id = $restaurant['id'];
                $location = $restaurant['location'];
                $cuisine_id = $restaurant['cuisine_id'];

                $new_restaurant = new Restaurant($name, $id, $location, $cuisine_id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM restaurants;");
          //$GLOBALS['DB']->exec("DELETE FROM cuisines;");
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
