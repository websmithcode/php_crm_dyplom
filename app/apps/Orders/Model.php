<?php namespace apps\Orders;

use PDO;

class Model extends \Core\Model
{
    public function getOrders($filters = null)
    {
        $_isManager = $_SESSION['user']['LoginRoleID'] == USER_ROLES['MANAGER'];
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
            $stmt->bindValue(":partnerID", $_SESSION['user']['PartnerID']);
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


}
