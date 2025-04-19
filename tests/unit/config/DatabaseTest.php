<?php

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use config\Database;
use mysqli;

class DatabaseTest extends TestCase
{
    #[Test]
    #[TestDox('Database: simulación de conexión BD')]
    public function testConexionMysqliDirectaYMock()
    {
        // 1. Inyección directa
        $mockMysqli1 = $this->createMock(mysqli::class);
        $db1 = new Database($mockMysqli1);
        $this->assertInstanceOf(mysqli::class, $db1->getConexion(), 'Fallo inyección directa MYSQLI');
    
        // 2. Simulación de método connect()
        $mockMysqli2 = $this->createMock(mysqli::class);
    
        $db2 = $this->getMockBuilder(Database::class)
                    ->onlyMethods(['connect'])
                    ->getMock();
    
        $db2->method('connect')->willReturn($mockMysqli2);
    
        $this->assertInstanceOf(mysqli::class, $db2->getConexion(), 'Fallo simulación de conexión');
    }
    
}
