<?php
require_once '../models/BaseModel.php';

use PHPUnit\Framework\TestCase;

class BaseModelTest extends TestCase
{
    protected static $conexion;

    public static function setUpBeforeClass(): void
    {
        // Establecer la conexión a la base de datos para las pruebas
        $host = 'mysql';
        $usuario = 'root';
        $contrasena = 'root';
        $base_de_datos = 'clinic-managment';

        self::$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

        if (self::$conexion->connect_error) {
            die("Error al conectar con la base de datos: " . self::$conexion->connect_error);
        }
    }

    public function testInsert()
    {
        $datos = array(
            'campo1' => 'valor1',
            'campo2' => 'valor2'
        );

        $baseModel = new BaseModel();
        $this->assertTrue($baseModel->insert('tabla_prueba', $datos));
    }

    public function testUpdate()
    {
        $datos = array(
            'campo1' => 'nuevo_valor1',
            'campo2' => 'nuevo_valor2'
        );
        $condicion = 'id = 1'; // Ajusta la condición según tu base de datos

        $baseModel = new BaseModel();
        $this->assertTrue($baseModel->update('tabla_prueba', $datos, $condicion));
    }

    public function testDelete()
    {
        $condicion = 'id = 1'; // Ajusta la condición según tu base de datos

        $baseModel = new BaseModel();
        $this->assertTrue($baseModel->delete('tabla_prueba', $condicion));
    }

    public function testRead()
    {
        $condicion = 'id = 1'; // Ajusta la condición según tu base de datos

        $baseModel = new BaseModel();
        $resultados = $baseModel->read('tabla_prueba', $condicion);

        $this->assertIsArray($resultados);
        $this->assertNotEmpty($resultados);
    }

    public static function tearDownAfterClass(): void
    {
        // Cerrar la conexión a la base de datos después de las pruebas
        self::$conexion->close();
    }
}
