<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=food_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function test_save()
        {
            //arrange
            $name = "Steak";
            $test_Cuisine = new Cuisine($name);

            //act
            $test_Cuisine->save();

            //Assert
            $result = Cuisine::getAll();
            $this->assertEquals($test_Cuisine, $result[0]);
        }

        function test_getAll()
        {
            //arrange
            $name = "Steak";
            $name2 = "Pasta";
            $test_Cuisine = new Cuisine($name);
            $test_Cuisine->save();
            $test_Cuisine2 = new  Cuisine($name2);
            $test_Cuisine2->save();

            //act
            $result = Cuisine::getAll();

            //assert
            $this->assertEquals([$test_Cuisine, $test_Cuisine2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Steak";
            $name2 = "Pasta";
            $test_Cuisine = new Cuisine($name);
            $test_Cuisine->save();
            $test_Cuisine2 = new  Cuisine($name2);
            $test_Cuisine2->save();

            //Act
            Cuisine::deleteAll();

            //Assert
            $result = Cuisine::getAll();
            $this->assertEquals([], $result);
        }

        function test_getId()
        {
            //arrange
            $name = "Steak";
            $id = 1;
            $test_Cuisine = new Cuisine($name, $id);

            //act
            $result = $test_Cuisine->getId();

            //assert
            $this->assertEquals(1, $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Steak";
            $name2 = "Pasta";
            $test_Cuisine = new Cuisine($name);
            $test_Cuisine->save();
            $test_Cuisine2 = new  Cuisine($name2);
            $test_Cuisine2->save();

            //Act
            $id = $test_Cuisine->getId();
            $result = Cuisine::find($id);

            //Assert
            $this->assertEquals($test_Cuisine, $result);
        }

        function testGetRestaurants()
        {
            //arrange
            $name = "Steak" ;
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $test_cuisine_id = $test_cuisine->getId();

            $name = "Pok Pok";
            $location = "Portland";
            $test_restaurant = new Restaurant($name, $id, $location, $test_cuisine_id);
            $test_restaurant->save();

            $name2 = "Wendys";
            $location2 = "Seattle";
            $test_restaurant2 = new Restaurant($name2, $id, $location2, $test_cuisine_id);
            $test_restaurant2->save();

            //Act
            $result = $test_cuisine->getRestaurants();

            //assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function testUpdate()
        {
            //arrange
            $name = "Steak";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $new_name = "Burger";

            //Act
            $test_cuisine->update($new_name);

            //Assert
            $this->assertEquals("Burger", $test_cuisine->getName());

        }

        function testDelete()
        {
            //arrange
            $name = "Noodle";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name2 = "Burger";
            $test_cuisine2 = new Cuisine($name2, $id);
            $test_cuisine2->save();

            //act
            $test_cuisine->delete();

            //assert
            $this->assertEquals([$test_cuisine2], Cuisine::getAll());
        }

        function testDeleteCuisineRestaurants()
        {
          //arrange
          $name = "noodle";
          $id = null;
          $test_cuisine = new Cuisine($name, $id);
          $test_cuisine->save();

          $name = "wendys";
          $location = "portland";
          $cuisine_id = $test_cuisine->getId();
          $test_restaurant = new Restaurant($name, $id, $cuisine_id, $location);
          $test_restaurant->save();

          //act
          $test_cuisine->delete();

          //assert
          $this->assertEquals([], Restaurant::getAll());
        }


    }

?>
