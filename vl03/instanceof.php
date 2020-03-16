<?php

/**
 * A person.
 */
class Person
{
    // ...
}

/**
 * An employee based on Person.
 */
class Employee extends Person
{
    // ...
}

/**
 * An animal.
 */
class Animal
{
    // ...
}

$obj = new Employee();

if ($obj instanceof Employee) { // true
    echo "Object is Employee";
}
if ($obj instanceof Person) { // true
    echo "Object is Person";
}
if ($obj instanceof Animal) { // false
    echo "Object is Animal";
}
