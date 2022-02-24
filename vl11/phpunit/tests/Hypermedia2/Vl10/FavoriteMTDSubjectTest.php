<?php

namespace Hypermedia2\Vl10;

require dirname(__DIR__) . "../../../src/Hypermedia2/Vl10/FavoriteMTDSubject.php";

use Exception;
use PHPUnit\Framework\TestCase;

/**
 * Test class for FavoriteMTDSubject
 * @package Hypermedia2\Vl10
 */
class FavoriteMTDSubjectTest extends TestCase
{
    /**
     * Tests if the constructor assigns the correct value to the property and
     * getFavoriteSubject() returns it correctly.
     */
    public function testGetFavoriteSubject()
    {
        $name = "Hypermedia 2";
        $subject = new FavoriteMTDSubject($name);
        $this->assertEquals($name, $subject->getFavoriteSubject());
    }

    /**
     * Tests if the say method outputs the correct string.
     */
    public function testSaysFavoriteSubject()
    {
        $subject = new FavoriteMTDSubject("Hypermedia 2");
        $this->assertEquals("The best subject in MTD is Hypermedia 2!", $subject->say());
    }

    /**
     * Tests, if the respondTo methods outputs agreement if the subject matches.
     * @throws Exception
     */
    public function testRespondToInAgreement()
    {
        $subject = new FavoriteMTDSubject("Hypermedia 2");
        $opinion = "Hypermedia 2 is the best!";

        $this->assertEquals("Absolutely true!", $subject->respondTo($opinion));
    }

    /**
     * Tests if the respondTo method throws an exception if the subject doesn't match.
     * @throws Exception
     */
    public function testRespondToInDisagreement()
    {
        $subject = new FavoriteMTDSubject("Hypermedia 2");
        $opinion = "I love Digitale Medientechnik 2!";

        $this->expectException(Exception::class);

        $subject->respondTo($opinion);
    }
}
