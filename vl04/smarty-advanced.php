<?php

require_once("Smarty/libs/Smarty.class.php");

class Person
{
    public $name;
    public $gender;
    public $age;

    public function __construct(string $name, string $gender, int $age)
    {
        $this->name = $name;
        $this->gender = $gender;
        $this->age = $age;
    }
}

$smarty = new Smarty();
$smarty->escape_html = true;

$array = ["John Doe", "male", 25];
$assocArray = ["name" => "Jane Doe", "details" => ["gender" => "female", "age" => 23]];
$object = new Person("Jim Doe", "male", 3);

$smarty->assign("data1", $array);
$smarty->assign("data2", $assocArray);
$smarty->assign("data3", $object);
$smarty->display("arrayexample.tpl");
