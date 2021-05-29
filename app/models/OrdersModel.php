<?php

class OrdersModel extends Model
{
    public function getOrders($filters = null)
    {
        $sql = "SELECT 
                        o.OrderID as 'Номер заказа', 
                        DATE_FORMAT(o.OrderDate, '%d.%m.%Y в %H:%i:%s') as 'Дата заказа',
                        s.StateName as 'Статус',
                        p.PartnerName as 'Партнер',
                        CONCAT(c.ClientSurName, ' ', c.ClientName, ' ', c.ClientMiddleName) as 'Клиент',
                        o.OrderCost as 'Сумма заказа',
                        ROUND(o.OrderCost * p.Commission * 0.01, 2) as 'Комиссия партнера'
                    FROM orders as o 
                    JOIN partners as p on p.PartnerID = o.PartnerID 
                    JOIN states as s on s.StateID = o.StateID
                    JOIN clients as c on c.ClientID = o.ClientID";
        if (!empty($filters)){
            if (!empty($filters['fromDatetime'])){
                $strFromDateTime = $filters['fromDatetime']->format('Y-m-d H:i:s');
                $sql .= sprintf(" WHERE o.OrderDate > '%s'", $strFromDateTime);
            }
            if (!empty($filters['toDatetime'])){
                $strToDateTime = $filters['toDatetime']->format('Y-m-d H:i:s');
                $sql .= sprintf(" WHERE o.OrderDate < '%s'", $strToDateTime);
            }
        }
        if ($_SESSION['user']['LoginRoleID'] == 2) {
            $sql .= " WHERE o.PartnerID = :partnerID";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":partnerID", $_SESSION['user']['PartnerID']);
        } else {
            $stmt = $this->db->prepare($sql);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
