<?php

class OrdersModel extends Model
{
    public function getOrders()
    {
        $sql = "SELECT 
                        o.OrderID as 'Номер заказа', 
                        o.OrderDate as 'Дата заказа',
                        s.StateName as 'Статус',
                        p.PartnerName as 'Партнер',
                        CONCAT(c.ClientSurName, ' ', c.ClientName, ' ', c.ClientMiddleName) as 'Клиент',
                        o.OrderCost as 'Сумма заказа',
                        ROUND(o.OrderCost * p.Commission * 0.01, 2) as 'Комиссия партнера'
                    FROM orders as o 
                    JOIN partners as p on p.PartnerID = o.PartnerID 
                    JOIN states as s on s.StateID = o.StateID
                    JOIN clients as c on c.ClientID = o.ClientID";
        if ($_SESSION['user']['LoginRoleID'] == 2) {
            $sql .= "WHERE o.PartnerID = :partnerID";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":partnerID", $_SESSION['user']['PartnerID']);
        } else {
            $stmt = $this->db->prepare($sql);
        }
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }


}
