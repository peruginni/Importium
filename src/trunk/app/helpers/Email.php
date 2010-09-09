<?php

namespace CMS;

class Email
{
    /**
     * Kontrola e-mailové adresy
     * @param string e-mailová adresa
     * @return bool syntaktická správnost adresy
     * @copyright Jakub Vrána, http://php.vrana.cz/
     */
    public static function isValidFormat($email) {
        $atom = '[-a-z0-9!#$%&\'*+/=?^_`{|}~]'; // znaky tvořící uživatelské jméno
        $domain = '[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])'; // jedna komponenta domény
        return (bool) eregi("^$atom+(\\.$atom+)*@($domain?\\.)+$domain\$", $email);
    }
}