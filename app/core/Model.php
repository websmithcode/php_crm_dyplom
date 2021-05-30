<?php namespace Core;

use DB;
use PDO;

class Model
{
    protected ?PDO $db = null;

    public function __construct()
    {
        $this->db = DB::connToDB();
    }

    public function getSessUser(): object|bool
    {
        if (empty($_SESSION['user'])){
            return false;
        }
        $sql = "SELECT LoginID, LoginName, LoginRoleID, PartnerID FROM logins WHERE LoginID = :LoginID";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":LoginID", $_SESSION['user'], PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}