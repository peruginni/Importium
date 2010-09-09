<?php

class Proj_Security_Authenticator extends Object implements IAuthenticator
{
    public function authenticate(array $credentials)
    {
        $login = $credentials[self::USERNAME];
        $row = UserModel::getByEmail($login);

        if (!$row) {
            throw new AuthenticationException("Užívateľ s registračným emailom '$login' sa nenašiel!", self::IDENTITY_NOT_FOUND);
        }

        $config = Environment::getConfig('security');
        $password =  sha1($credentials[self::PASSWORD] . $config->salt);

        if ($row->password !== $password) {
            throw new AuthenticationException("Zadali ste nesprávne heslo!", self::INVALID_CREDENTIAL);
        }

        return new Identity($row->name, $row->role);
    }
}
