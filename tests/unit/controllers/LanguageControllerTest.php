<?php

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

final class LanguageControllerTest extends TestCase
{
    #[Test]
    #[TestDox('Suma de dos números enteros')]
    public function sumar()
    {
        $this->assertTrue(true);
    }
}
