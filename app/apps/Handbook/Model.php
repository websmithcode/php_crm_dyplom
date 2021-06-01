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

    public function getPartners()
    {
        $sql = "SELECT 
                    PartnerID as 'ID',
                    PartnerName as 'Имя партнера', 
                    Commission as 'Комиссия партнера', 
                    PartnerEmail as 'Email партнера', 
                    PartnerRequisites as 'Реквизиты партнера' 
                FROM partners";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPrint($values): bool
    {
        $sql = "INSERT INTO prints (PrintName) 
                VALUES (:PrintName)";
        $sth = $this->db->prepare($sql);
        return $sth->execute($values);
    }

    public function addSize($values): bool
    {
        $sql = "INSERT INTO sizes (SizeCodeSym, SizeCodeNum) 
                VALUES (:SizeCodeSym, :SizeCodeNum)";
        $sth = $this->db->prepare($sql);
        return $sth->execute($values);
    }

    public function addMaterial($values): bool
    {
        $sql = "INSERT INTO materials (MaterialName) 
                VALUES (:MaterialName)";
        $sth = $this->db->prepare($sql);
        return $sth->execute($values);
    }


    public function addPartner($values): bool
    {
        $sql = "INSERT INTO partners (PartnerName, Commission, PartnerEmail, PartnerRequisites) 
                VALUES (:PartnerName, :Commission, :PartnerEmail, :PartnerRequisites)";
        $sth = $this->db->prepare($sql);
        return $sth->execute($values);
    }
}
