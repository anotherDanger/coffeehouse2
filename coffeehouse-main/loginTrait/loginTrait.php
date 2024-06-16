<?php 

// Interface untuk Login
interface LoginInterface {
    public function getLogin($data);
}

// Trait untuk mengakses tabel dalam database
trait TableAccessTrait {
    protected $table;

    public function setTable($table) {
        $this->table = $table;
    }
}

?>