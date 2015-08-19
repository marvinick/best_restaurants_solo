<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost;dbname=food_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CategoryTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
          Restaurant::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Pok Pok";
            $test_Restaurant = new Restaurant($name);

            //Act
            $result = $test_Restaurant->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Pok Pok";
            $id = 1;
            $test_Restaurant = new Restaurant($name, $id);

            //Act
            $result = $test_Restaurant->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "Restaurant";
            $test_Restaurant = new Restaurant($name);
            $test_Restaurant->save();

            //Act
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals($test_Restaurant, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Pok Pok";
            $name2 = "Uchi";
            $test_Restaurant = new Restaurant($name);
            $test_Restaurant->save();
            $test_Restaurant2 = new Restaurant($name2);
            $test_Restaurant2->save();

            //Act
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals([$test_Restaurant, $test_Restaurant2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Pok Pok";
            $name2 = "Uchi";
            $test_Restaurant = new Restaurant($name);
            $test_Restaurant->save();
            $test_Restaurant2 = new Restaurant($name2);
            $test_Restaurant2->save();

            //Act
            Restaurant::deleteAll();
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Pok Pok";
            $name2 = "Uchi";
            $test_Restaurant = new Restaurant($name);
            $test_Restaurant->save();
            $test_Restaurant2 = new Restaurant($name2);
            $test_Restaurant2->save();

            //Act
            $result = Restaurant::find($test_Restaurant->getId());

            //Assert
            $this->assertEquals($test_Restaurant, $result);
        }
    }

?>