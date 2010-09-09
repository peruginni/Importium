<?php

class UserModel extends BaseModel
{
    public static function getByEmail($email)
    {
        $row = dibi::select('*')
          ->from('users')
          ->where('email=%s', $email)
          ->fetch();

        return ($row) ? $row : NULL;
    }
}
