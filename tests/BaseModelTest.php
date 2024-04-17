<?php

require './models/BaseModel.php'; // Asegúrate de incluir el archivo de la clase que estás probando

use PHPUnit\Framework\TestCase;

class BaseModelTest extends TestCase
{
    public function testInsert()
    {
        // Configurar
        $baseModel = new BaseModel();

        // Simular la conexión a la base de datos
        $conexionMock = $this->createMock(mysqli::class);
        $conexionMock->method('query')->willReturn(true); // Simulamos que la consulta es exitosa
        $baseModel->setConexion($conexionMock);

        // Ejecutar
        $resultado = $baseModel->insert('ejemplo_tabla', ['campo1' => 'valor1', 'campo2' => 'valor2']);

        // Afirmar
        $this->assertTrue($resultado); // Verifica que la operación de inserción fue exitosa
    }

    public function testUpdate()
    {
        // Configurar
        $baseModel = new BaseModel();

        // Simular la conexión a la base de datos
        $conexionMock = $this->createMock(mysqli::class);
        $conexionMock->method('query')->willReturn(true); // Simulamos que la consulta es exitosa
        $baseModel->setConexion($conexionMock);

        // Ejecutar
        $resultado = $baseModel->update('ejemplo_tabla', ['campo1' => 'valor_nuevo'], 'condicion');

        // Afirmar
        $this->assertTrue($resultado); // Verifica que la operación de actualización fue exitosa
    }

    public function testDelete()
    {
        // Configurar
        $baseModel = new BaseModel();

        // Simular la conexión a la base de datos
        $conexionMock = $this->createMock(mysqli::class);
        $conexionMock->method('query')->willReturn(true); // Simulamos que la consulta es exitosa
        $baseModel->setConexion($conexionMock);

        // Ejecutar
        $resultado = $baseModel->delete('ejemplo_tabla', 'condicion');

        // Afirmar
        $this->assertTrue($resultado); // Verifica que la operación de eliminación fue exitosa
    }

    public function testRead()
    {
        // Configurar
        $baseModel = new BaseModel();

        // Simular la conexión a la base de datos y el resultado de la consulta
        $resultadoConsulta = [['campo1' => 'valor1', 'campo2' => 'valor2']];
        $conexionMock = $this->createMock(mysqli::class);
        $conexionMock->method('query')->willReturn($resultadoConsulta);
        $baseModel->setConexion($conexionMock);

        // Ejecutar
        $resultado = $baseModel->read('ejemplo_tabla', 'condicion');

        // Afirmar
        $this->assertEquals($resultadoConsulta, $resultado); // Verifica que los datos devueltos sean los esperados
    }
}
