<?php 

// Interface untuk Login
interface LoginInterface {
    public function getLogin($data);
}


trait TableAccessTrait {
    protected $table;

    public function setTable($table) {
        $this->table = $table;
    }
}

?>