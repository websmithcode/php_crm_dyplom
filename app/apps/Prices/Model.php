<?php namespace apps\Prices;

use PDO;

class Model extends \Core\Model
{
    public function getPrices($filters = null)
    {
        $sql = "SELECT 
                    pc.ProductID as 'ID',
                    DATE_FORMAT(pc.PriceDate, '%d.%m.%Y в %H:%i:%s') as 'Дата', 
                    m.MaterialName as 'Материал',
                    pt.PrintTypeName as 'Тип принта',
                    pc.Price as 'Цена'       
                FROM productcosts as pc 
                JOIN products as p on p.ProductID = pc.ProductID
                JOIN materials as m on m.MaterialID = p.MaterialID
                JOIN printtypes as pt on pt.PrintTypeID = p.PrintTypeID
                ";

        $_where = false;
        if (!empty($filters)) {
            if (!empty($filters['fromDatetime'])) {
                $sql .= $_where ? " AND" : " WHERE";
                $strFromDateTime = $filters['fromDatetime']->format('Y-m-d H:i:s');
                $sql .= sprintf(" pc.PriceDate > '%s'", $strFromDateTime);
                $_where = true;
            }
            if (!empty($filters['toDatetime'])) {
                $sql .= $_where ? " AND" : " WHERE";
                $strToDateTime = $filters['toDatetime']->format('Y-m-d H:i:s');
                $sql .= sprintf(" pc.PriceDate < '%s'", $strToDateTime);
            }
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getMaterials(): array
    {
        $sql = 'SELECT * from materials';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getPrintTypes(): array
    {
        $sql = 'SELECT * from printtypes';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getProducts(): array
    {
        $sql = '
            SELECT p.ProductID, m.MaterialName, pt.PrintTypeName
            FROM products as p
            JOIN materials as m on m.MaterialID = p.MaterialID
            JOIN printtypes as pt on pt.PrintTypeID = p.PrintTypeID
            ';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function addPrice($values): bool
    {
        $sql = "INSERT INTO productcosts (Price, ProductID) 
                VALUES (:Price, :ProductID )";
        $sth = $this->db->prepare($sql);
        return $sth->execute($values);
    }
}
