<?php namespace apps\Handbook;

use PDO;

class Model extends \Core\Model
{
    public function getPrints()
    {
        $sql = "SELECT PrintID as 'ID', PrintName as 'Название принта' FROM prints";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSizes()
    {
        $sql = "SELECT SizeID as 'ID', SizeCodeSym as 'Название размера', SizeCodeNum as 'Размер' FROM sizes";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMaterials()
    {
        $sql = "SELECT MaterialID as 'ID', MaterialName as 'Название материала' FROM materials";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
