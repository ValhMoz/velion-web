<?php

require_once '../models/BaseModel.php'; // Asegúrate de incluir el archivo de la clase que estás probando

use PHPUnit\Framework\TestCase;

class BaseModelTest extends TestCase
{
    public function testInsert()
    {
        // Configurar
        $baseModel = new BaseModel();
        $tabla = 'ejemplo'; // Nombre de la tabla de prueba
        $datos = array(
            'campo1' => 'valor1',
            'campo2' => 'valor2'
        );

        // Ejecutar
        $resultado = $baseModel->insert($tabla, $datos);

        // Afirmar
        $this->assertTrue($resultado); // Verifica que la operación de inserción fue exitosa

        // Limpiar (opcional)
        // Puedes agregar un método de limpieza aquí para eliminar los datos de prueba insertados durante la prueba.
        // Por ejemplo: $baseModel->delete($tabla, "campo1 = 'valor1'");
    }
}
