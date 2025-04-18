<?php

use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use config\Database;
use mysqli;

class DatabaseTest extends TestCase
{

    #[TestDox('testConexionPorObjetoMysql')]
    public function testConexionPorObjetoMysql()
    {
        // Creamos un mock de la clase mysqli
        $mockMysqli = $this->createMock(mysqli::class);
        
        // Inyectamos el mock en la clase Database
        $db = new Database($mockMysqli);
        
        // Comprobamos que el objeto devuelto por getConexion() es el mock de mysqli
        $this->assertInstanceOf(mysqli::class, $db->getConexion());
    }

    #[TestDox('testConexionPorMock')]
    public function testConexionPorMock()
    {
        // Creamos un mock de mysqli para simular la conexión
        $mockMysqli = $this->createMock(mysqli::class);
        
        // Mock del método connect para que devuelva el mock de mysqli
        $db = $this->getMockBuilder(Database::class)
                   ->onlyMethods(['connect'])
                   ->getMock();
         
        // Se invoca el metodo ficticio y se pasa por parametro el mysqli para simular la logica 
        $db->method('connect')->willReturn($mockMysqli);
        
        // Verificamos que la conexión predeterminada devuelve una instancia de mysqli
        $this->assertInstanceOf(mysqli::class, $db->getConexion());
    }
}
