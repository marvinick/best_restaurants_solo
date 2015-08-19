<?php

    class Cuisine
    {
        private $name;
        private $restaurant_id;
        private $id;
    }

    function __construct($name, $id = null, $restaurant_id)
    {
        $this->name = $name;
        $this->restaurant_id = $restaurant_id;
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

    function getCategoryId()
    {
        return $this->restaurant_id;
    }

    function save()
    {

    }

    static function getAll()
    {

    }

    static function deleteAll()
    {

    }

    static function find($search_id)
    {

    }

?>