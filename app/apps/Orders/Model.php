<?php namespace apps\Orders;

use PDO;

class Model extends \Core\Model
{
    public function getOrders($sessUser, $filters = null)
    {
        $_isManager = $sessUser->LoginRoleID == USER_ROLES['MANAGER'];
        $sql = "SELECT 
                        o.OrderID as 'Номер заказа', 
                        DATE_FORMAT(o.OrderDate, '%d.%m.%Y в %H:%i:%s') as 'Дата заказа',
                        s.StateName as 'Статус'," .
            ($_isManager ? "p.PartnerName as 'Партнер',
                        CONCAT(c.ClientSurName, ' ', c.ClientName, ' ', c.ClientMiddleName) as 'Клиент'," : "") .
            "o.OrderCost as 'Сумма заказа',
                        ROUND(o.OrderCost * p.Commission * 0.01, 2) as 'Комиссия партнера'
                    FROM orders as o 
                    JOIN partners as p on p.PartnerID = o.PartnerID 
                    JOIN states as s on s.StateID = o.StateID
                    JOIN clients as c on c.ClientID = o.ClientID";
        $_where = false;
        if (!empty($filters)) {
            if (!empty($filters['fromDatetime'])) {
                $sql .= $_where ? " AND" : " WHERE";
                $strFromDateTime = $filters['fromDatetime']->format('Y-m-d H:i:s');
                $sql .= sprintf(" o.OrderDate > '%s'", $strFromDateTime);
                $_where = true;
            }
            if (!empty($filters['toDatetime'])) {
                $sql .= $_where ? " AND" : " WHERE";
                $strToDateTime = $filters['toDatetime']->format('Y-m-d H:i:s');
                $sql .= sprintf(" o.OrderDate < '%s'", $strToDateTime);
                $_where = true;
            }
            if (!empty($filters['PartnerID'])) {
                $sql .= $_where ? " AND" : " WHERE";
                $sql .= sprintf(" p.PartnerID = '%s'", $filters['PartnerID']);
                $_where = true;
            }
            if (!empty($filters['PartnerName'])) {
                $sql .= $_where ? " AND" : " WHERE";
                $sql .= sprintf(" p.PartnerName = '%s'", $filters['PartnerName']);
                $_where = true;
            }
            if (!empty($filters['PartnerEmail'])) {
                $sql .= $_where ? " AND" : " WHERE";
                $sql .= sprintf(" p.PartnerEmail = '%s'", $filters['PartnerEmail']);
                $_where = true;
            }
            if (!empty($filters['PartnerRequisites'])) {
                $sql .= $_where ? " AND" : " WHERE";
                $sql .= sprintf(" p.PartnerRequisites = '%s'", $filters['PartnerRequisites']);
                $_where = true;
            }
        }

        if (!$_isManager) {
            $sql .= $_where ? " AND" : " WHERE";
            $sql .= " o.PartnerID = :partnerID";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":partnerID", $sessUser->PartnerID);
        } else {
            $stmt = $this->db->prepare($sql);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPartners()
    {
        $sql = "SELECT * FROM partners";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderDetailsValues($OrderID)
    {
        $sql = "SELECT * FROM orderdetails WHERE OrderID = :OrderID";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue('OrderID', $OrderID);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductCostVariants(): array
    {
        $sql = "SELECT 
                    CONCAT(pcs.ProductCostID, ') Материал: ', m.MaterialName, ', Тип: ', pt.PrintTypeName, ', ', pcs.Price) as verboseName, 
                    pcs.ProductCostID, 
                    m.MaterialName, 
                    pt.PrintTypeName,
                    pcs.Price
                FROM productcosts as pcs
                join 
                    (
                      SELECT 
                      pc.ProductID, max(PriceDate) as LastPriceDate
                      FROM productcosts as pc
                      GROUP BY ProductID
                    ) as pc on pc.ProductID = pcs.ProductID and pc.LastPriceDate = pcs.PriceDate
                JOIN products as p on p.ProductID = pcs.ProductID
                JOIN materials as m on m.MaterialID = p.MaterialID
                JOIN printtypes as pt on pt.PrintTypeID = p.PrintTypeID";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getSizes(): array
    {
        $sql = 'SELECT * from sizes';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getPrints(): array
    {
        $sql = 'SELECT * from prints';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getDiscounts(): array
    {
        $sql = 'SELECT * from discounts';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateOrderDetails($obj): bool
    {
        $sql = "UPDATE orderdetails as od
                SET 
                    ProductCostID = :ProductCostID,
                    PrintID = :PrintID,
                    SizeID = :SizeID,
                    DiscountID = :DiscountID,
                    Quantity = :Quantity
                WHERE  od.OrderDetailID = :OrderDetailID";

        $sth = $this->db->prepare($sql);
        return $sth->execute((array)$obj);
    }

    public function addOrderDetail($values): bool
    {
        $sql = "INSERT INTO orderdetails (OrderID, ProductCostID, PrintID, SizeID, DiscountID, Quantity) 
                VALUES (:OrderID, :ProductCostID, :PrintID, :SizeID, :DiscountID, :Quantity)";
        $sth = $this->db->prepare($sql);
        return $sth->execute($values);
    }

    public function deleteOrderDetail($ID): bool
    {
        $sql = "DELETE FROM orderdetails as od WHERE od.OrderDetailID=:OrderDetailID";
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':OrderDetailID', $ID);
        return $sth->execute();
    }
}
