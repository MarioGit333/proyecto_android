<?php

/**
 * Representa el la estructura de las Alumnoss
 * almacenadas en la base de datos
 */
require 'Database.php';

class Distanciastiempos
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'Alumnos'
     *
     * @param $idAlumno Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM distanciatiempo ORDER BY distancia DESC, tiempo";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getById($usuario)
    {
        $consulta = "SELECT *
                             FROM distanciatiempo
                             WHERE usuario = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($usuario));
            // Capturar primera fila del resultado
            return $comando->fetchAll(PDO::FETCH_ASSOC);
             

        } catch (PDOException $e) {
            // Aqu� puedes clasificar el error dependiendo de la excepci�n
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $idAlumno      identificador
     * @param $nombre      nuevo nombre
     * @param $direccion nueva direccion
     
     */
   

    /**
     * Insertar un nuevo Alumno
     *
     * @param $nombre      nombre del nuevo registro
     * @param $direccion direcci�n del nuevo registro
     * @return PDOStatement
     */
    public static function insert(
        $distancia,
        $tiempo,
		$usuario
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO distanciatiempo ( " .
            "distancia," .
			"tiempo," .
            " usuario)" .
            " VALUES( ?,?, ?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $distancia,
                $tiempo,
				$usuario
            )
        );

    }
	
	/*public static function insert(
        $distancia,
        $tiempo,
		$nombre
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO distanciatiempo ( " .
            "distancia," .
			"tiempo," .
            " nombre)" .
            " VALUES( ?,?,? )";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $distancia,
                $tiempo,
				$nombre
            )
        );

    }*/

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idAlumno identificador de la tabla Alumnos
     * @return bool Respuesta de la eliminaci�n
     */
    public static function delete($idAlumno)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM distanciatiempo WHERE id=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idAlumno));
    }
}

?>