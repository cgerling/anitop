<?php
require_once "base-connection.php";

class QueryManager {
    private $table;
    private $connection;

    public function __construct($table) {
        $this->connection = new BaseConnection();
        $this->table = $table;
    }

    public function selectOne($joinTables = array(), $whereStatement = array()) {
        $query = "SELECT * FROM {$this->table}".$this->mountInnerJoin($joinTables).$this->filter($whereStatement);
        $stmt = $this->createStatement($query);

        $stmt->execute();

        return $stmt->fetch();
    }

    public function select($joinTables = array(), $whereStatement = array()) {
        $query = "SELECT * FROM {$this->table}".$this->mountInnerJoin($joinTables).$this->filter($whereStatement);
        $stmt = $this->createStatement($query);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function selectAll($join = array()) {
        $query = "SELECT * FROM {$this->table}".$this->mountInnerJoin($join);
        $stmt = $this->createStatement($query);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function insert($fieldValues) {
        $fields = join(",", array_keys($fieldValues));
        $bindValues = array_fill(0, count($fieldValues), "?");
        $values = join(",", $bindValues);

        $query = "INSERT INTO {$this->table}({$fields}) VALUES ({$values})";

        $stmt = $this->createStatement($query);

        $stmt = $this->bindParams($stmt, $fieldValues);

        $stmt->execute();
    }

    public function update($fieldValues, $whereStatement = array()) {
        $updateFields = $this->mountKeyValueStatement(array_keys($fieldValues), array_fill(0, count($fieldValues), "?"));
        $updateFields = join(",", $updateFields);

        $query = "UPDATE {$this->table} SET {$updateFields}".$this->filter($whereStatement);
        
        $stmt = $this->createStatement($query);
        $stmt = $this->bindParams($stmt, $fieldValues);

        $stmt->execute();
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

    private function bindParams(PDOStatement $stmt, $values, $startIndex = 1) {
        foreach(array_values($values) as $key=>$value) {
            $index = $startIndex + $key;
            $stmt->bindValue($index, $value);
        }

        return $stmt;
    }

    private function mountKeyValueStatement($fields, $values) {
        $lowestIndex = min(count($fields), count($values));
        $keyValue = array();

        for($i = 0; $i < $lowestIndex; $i++) {
            $keyValue[] = "{$fields[$i]} = {$values[$i]}";
        }

        return $keyValue;
    }

    private function filter($whereStatement) {
        if(count($whereStatement) == 0) return "";

        $where = join(" ", $whereStatement);
        $where = " WHERE {$where}";

        return $where;
    }

    private function innerJoin($table, $column, $sourceTable, $sourceColumn) {
        $query = " INNER JOIN {$table} ON {$sourceTable}.{$sourceColumn} = {$table}.{$column}";

        return $query;
    }

    private function mountInnerJoin($joins) {
        $joinQuery = "";
        foreach($joins as $value) {
            $table = $value['sourceTable'] ?? $this->table;
            $joinQuery .= $this->innerJoin($value['targetTable'], $value['targetColumn'], $table, $value['sourceColumn']);
        }

        return $joinQuery;
    }
}