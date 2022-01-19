<?php

class Database
{
    private static $bdd = null;

    private function __construct()
    {
    }

    public static function getBdd()
    {
        if (is_null(self::$bdd)) {
            self::$bdd = new PDO("mysql:host=localhost;dbname=ofm", 'root', '');
        }
        return self::$bdd;
    }

    public static function retrieve($tableName, $columns, $fields, $values)
    {
        $pdo = Database::getBdd();

        $flds = join(" = ? AND ", $fields) . " = ?";

        if ($columns == "*") {
            $stmt = $pdo->prepare("SELECT $columns FROM $tableName WHERE $flds");
        } else {
            $cols = join(", ", $columns);
            $stmt = $pdo->prepare("SELECT $cols FROM $tableName WHERE $flds");
        }

        $stmt->execute($values);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;

        if (empty($res)) {
            $res = array(array());
            if ($columns != "*") {
                foreach ($columns as $column) {
                    $res[0][$column] = "";
                }
            }
        }
        return $res;
    }

    public static function insert($tableName, $columns, $values)
    {
        $pdo = Database::getBdd();
        $cols = join(", ", $columns);
        $val = rtrim(str_repeat("?,", count($columns)), ",");

        $stmt = $pdo->prepare("INSERT INTO $tableName ($cols) VALUES ($val)");

        // Check for the correct execution of the statement
        if (!$stmt->execute(($values))) {
            $stmt = null;
            return false;
        }

        $stmt = null;
        return true;

    }

    public static function update_table($tableName, $columns, $values, $identifier, $reference){
        $pdo = Database::getBdd();
        $statement='';
        foreach ($columns as $col){
            $statement=$statement. $col.' = ?, ';
        }
        $statement=rtrim($statement,', ');
        $stmt = $pdo->prepare("UPDATE $tableName SET $statement WHERE $identifier= $reference");

        if (!$stmt->execute(($values))){
            $stmt = null;
            return false;
        }
        $stmt=null;
        return true;
    }

    public static function update_table_multiple($tableName, $columns, $values, $identifier, $reference)
    {
        $pdo = Database::getBdd();
        $statement='';
        foreach ($columns as $col){
            $statement = $statement. $col.' = ?, ';
        }
        $statement=rtrim($statement,', ');

        $idf_ref = '';
        for ($i = 0; $i < count($identifier); $i++) {
            $idf_ref = $idf_ref . $identifier[$i] . "=" . $reference[$i] . " AND ";
        }
        $idf_ref = rtrim($idf_ref, " AND ");

        $stmt = $pdo->prepare("UPDATE $tableName SET $statement WHERE $idf_ref");

        if (!$stmt->execute(($values))){
            $stmt = null;
            return false;
        }
        $stmt=null;
        return true;
    }

    public static function update($tableName, $columns, $fields, $values)
    {
        $pdo = Database::getBdd();
        $cols = join("=?, ", $columns).'=?';

        $flds = join(", ", $fields);
        $val = rtrim(str_repeat("?,", count($fields)), ",");

        $stmt = $pdo->prepare("UPDATE $tableName SET $cols WHERE $flds = $val");

        if (!$stmt->execute(($values))){
            $stmt = null;
            return false;
        }

        $stmt = null;
        return true;
    }


    public static function search($tableName, $col_name, $search)
    {
        $pdo = Database::getBdd();
        $stmt = $pdo->prepare("SELECT * FROM $tableName WHERE ($col_name LIKE ?)");
        $stmt->execute(array($search));
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;

        return $res;
    }

    public static function getLastInsertedId() {
        return self::getBdd()->lastInsertId();
    }
}
