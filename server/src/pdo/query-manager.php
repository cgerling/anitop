<?php
require_once "base-connection.php";

class QueryManager {
    private $table;
    private $connection;

    public function __construct($table) {
        $this->connection = new BaseConnection();
        $this->table = $table;
    }

    public function select($joinTables = array(), $whereStatement = array()) {
        $query = "SELECT * FROM {$this->table}".$this->filter($whereStatement).$this->mountInnerJoin($joinTables);
        $stmt = $this->createStatement($query);

        return $stmt->execute();
    }

    public function selectAll() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->createStatement($query);

        return $stmt->execute();
    }

    public function insert($fieldValues) {
        $fields = join(",", array_keys($fieldValues));
        $values = array_fill(0, count($fieldValues), "?");

        $query = "INSERT INTO {$this->table}({$fields}) VALUES ({$values})";

        $stmt = $this->createStatement($query);

        $stmt = $this->bindParams($stmt, $fieldValues);

        return $stmt->execute();
    }

    public function update($fieldValues, $whereStatement = array()) {
        $updateFields = $this->mountKeyValueStatement(array_keys($fieldValues), array_fill(0, count($fieldValues), "?"));
        $updateFields = join(",", $updateFields);

        $query = "UPDATE {$this->table} SET {$updateFields}".$this->filter($whereStatement);
        
        $stmt = $this->createStatement($query);
        $stmt = $this->bindParams($stmt, $fieldValues);
        
        return $stmt->execute();
    }

    public function delete($where = array()) {
        $whereStatement = $this->mountKeyValueStatement(array_keys($where), array_fill(0, count($where), "?"));

        $query = "DELETE FROM {$this->table} WHERE ".$whereStatement;

        $stmt = $this->createStatement($query);
        $stmt = $this->bindParams($stmt, $where);

        return $stmt->execute();
    }

    private function createStatement($query) {
        return $this->connection->get()->prepare($query);
    }

    private function bindParams($stmt, $values, $startIndex = 1) {
        foreach(array_values($values) as $key=>$value) {
            $index = $startIndex + $key;
            $stmt->bindParam($index, $value);
        }

        return $stmt;
    }

    private function mountKeyValueStatement($fields, $values) {
        $lowestIndex = min(count($fields), count($values));
        $keyValue = array();

        for($i = 0; $i < $lowestIndex; $i++) {
            $keyValue = "{$fields[$i]} = {$values[$i]}";
        }

        return $keyValue;
    }

    private function filter($whereStatement) {
        if(count($whereStatement) == 0) return "";

        $where = join(" ", $whereStatement);
        $where = " WHERE {$where}";

        return $where;
    }

    private function innerJoin($table, $column, $sourceColumn) {
        $query = " INNER JOIN {$table} ON {$this->table}.{$sourceColumn} = {$table}.{$column}";

        return $query;
    }

    private function mountInnerJoin($joins) {
        $joinQuery = "";
        foreach($joins as $value) {
            $joinQuery .= $this->innerJoin($value['table'], $value['targetColumn'], $value['column']);
        }

        return $joinQuery;
    }
}