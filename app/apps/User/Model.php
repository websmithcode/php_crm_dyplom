<?php namespace apps\User;

use PDO;

class Model extends \Core\Model
{

    public function checkUser($login, $password)
    {
        $sql = "SELECT LoginID FROM logins WHERE LoginName = :login AND LoginPassword = :password";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

}
