<?php namespace apps\Analytics;

use PDO;

class Model extends \Core\Model
{

    public function getPartnerCommissions($filters = null)
    {
        $sql = "SELECT 
                    DATE_FORMAT(o.OrderDate, '%d.%m.%Y в %H:%i:%s') as 'Дата заказа',
                    DATE_FORMAT(pc.CommisionDate, '%d.%m.%Y в %H:%i:%s') as 'Дата начисления комиссии',
                    o.OrderCost as 'Сумма заказа',
                    pc.CommissionSumma as 'Сумма комиссии'
                FROM partnercommissions as pc
                JOIN orders as o on o.OrderID = pc.OrderID
                WHERE pc.PartnerID = :PartnerID";
        if (!empty($filters)) {
            if (!empty($filters['fromDatetimeOrder'])) {
                $strFromDateTime = $filters['fromDatetimeOrder']->format('Y-m-d H:i:s');
                $sql .= sprintf(" AND o.OrderDate > '%s'", $strFromDateTime);
            }
            if (!empty($filters['toDatetimeOrder'])) {
                $strToDateTime = $filters['toDatetimeOrder']->format('Y-m-d H:i:s');
                $sql .= sprintf(" AND o.OrderDate < '%s'", $strToDateTime);
            }
            if (!empty($filters['fromDatetimeAccrual'])) {
                $strFromDateTime = $filters['fromDatetimeAccrual']->format('Y-m-d H:i:s');
                $sql .= sprintf(" AND pc.CommisionDate > '%s'", $strFromDateTime);
            }
            if (!empty($filters['toDatetimeAccrual'])) {
                $strToDateTime = $filters['toDatetimeAccrual']->format('Y-m-d H:i:s');
                $sql .= sprintf(" AND pc.CommisionDate < '%s'", $strToDateTime);
            }
        }
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':PartnerID', $_SESSION['user']['PartnerID']);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
