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



    }
?>
