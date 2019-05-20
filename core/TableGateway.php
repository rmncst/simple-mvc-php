<?php
/**
 * Created by PhpStorm.
 * User: rmncs
 * Date: 19/05/2019
 * Time: 22:09
 */

namespace Core;


class TableGateway
{
    protected $_table;
    private $_connection;

    public function __construct($tableName)
    {
        $this->_table = $tableName;
        $this->_connection = DatabaseFactory::getDatabaseInstance();
    }

    public function insert(array $data)
    {
        // Logica para montar o insert
        foreach ($data as $campo => $valor) {
            $campos[] = $campo;
            $valores[] = "'$valor'";
        }

        $campos = implode(',', $campos);
        $valores = implode(',', $valores);

        $insert = "INSERT INTO {$this->_table}($campos)VALUES($valores)";

        return $this->_connection->query($insert);
    }

    public function update(array $dados, $where)
    {
        // Logica para montar o update
        foreach ($dados as $campo => $valor) {
            $sets[] = "$campo='$valor'";
        }

        $sets = implode(',', $sets);

        $update = "UPDATE {$this->_table} SET $sets WHERE $where";

        return $this->_connection->query($update);
    }

    public function query($campos = '*', $where = null, $ordem = null, $join = null, $limit = null)
    {
        // Logica para listar todos os registros
        $select = "SELECT $campos FROM $this->_table";

        if ($join) {
            $select .= " $join";
        }

        if ($where) {
            $select .= " $where";
        }

        if ($ordem) {
            $select .= " ORDER BY $ordem";
        }

        if ($limit) {
            $select .= " LIMIT $limit";
        }


        $pdoSt = $this->_connection->prepare($select);
        $pdoSt->execute();

        return $pdoSt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function buscarRegistro($where, $campos = '*')
    {
        // Lógica para retornar um registro
        $select = "SELECT $campos FROM $this->_table WHERE $where";
        $pdoSt = $this->_connection->prepare($select);
        $pdoSt->execute();
        return $pdoSt->fetch(\PDO::FETCH_ASSOC);
    }

    public function excluir($where)
    {
        $delete = "DELETE FROM $this->_table WHERE $where";
        return $this->_connection->query($delete);
    }

    public function qtde_registros()
    {
        $stmt = $this->_connection->prepare("SELECT count(1) as nreg FROM $this->_table");
        $stmt->execute();
        $consulta = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $consulta['nreg'];
    }

    public function trocar_table($_table){
        if($_table != ''){
            $this->_table = $_table;
        }
    }

    public function rodarsql($sql){
        $stmt = $this->_connection->prepare($sql);
        return $stmt->execute();
    }
}