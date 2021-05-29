<?php

class UserModel extends Model
{

    public function checkUser($login, $password)
    {
        $sql = "SELECT `LoginID`, `LoginName`, `LoginRoleID`, `PartnerID` FROM logins WHERE LoginName = :login AND LoginPassword = :password";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($res)){
            return $res;
        } else {
            return false;
        }
    }


}
