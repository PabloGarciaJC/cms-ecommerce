<?php
declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

final class StackTest extends TestCase
{
    #[DataProvider('additionProvider')]
    #[TestDox('Suma de dos numeros enteros')]
    #[Test]
    public function sumar(int $expected, int $a, int $b): void
    {
        // Comprobación de afirmaciones
        $this->assertSame($expected, $a + $b);
    }

    public static function additionProvider()
    {
        return [
            'data set 1' => [0, 0, 0],
            'data set 2' => [1, 0, 1],
            'data set 3' => [1, 1, 0],
            'data set 4' => [3, 1, 1]
        ];
    }
}
