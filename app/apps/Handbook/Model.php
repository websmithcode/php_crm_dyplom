<?php namespace apps\Handbook;

use PDO;

class Model extends \Core\Model {
    public function getPrints()
    {
        $sql = "SELECT PrintID as 'ID', PrintName as 'Название принта' FROM prints";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



}
