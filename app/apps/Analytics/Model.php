<?php namespace apps\Analytics;

use PDO;

class Model extends \Core\Model
{

    public function getPartnerCommissions($sessUser, $filters = null): array
    {
        $_isManager = $sessUser->LoginRoleID == USER_ROLES['MANAGER'];
        $sql = "SELECT ".
                    ($_isManager ? "pc.PartnerID as 'ID партнера' , p.PartnerName as 'Имя партнера' , " : "") .
                    "
                    p.Commission as '% комиссии',
                    pc.CommissionSumma as 'Сумма комиссии',
                    DATE_FORMAT(pc.CommisionDate, '%d.%m.%Y в %H:%i:%s') as 'Дата начисления комиссии',
                    o.OrderID as 'ID заказа',
                    DATE_FORMAT(o.OrderDate, '%d.%m.%Y в %H:%i:%s') as 'Дата заказа',
                    o.OrderCost as 'Сумма заказа'
            FROM partnercommissions as pc
            JOIN orders as o on o.OrderID = pc.OrderID
            JOIN partners as p on p.PartnerID = pc.PartnerID";
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
        if (!$_isManager) {
            $sql .= " WHERE pc.PartnerID = :PartnerID";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':PartnerID', $_SESSION['user']);
        } else {
            $stmt = $this->db->prepare($sql);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
