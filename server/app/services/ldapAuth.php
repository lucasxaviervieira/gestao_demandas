<?php


class LdapAuth
{
    private $ldap_server = 'ldap://192.168.1.4';
    private $ldap_port = '389';
    private $ldap_dn = 'aguasjve\\';

    public function login($username, $password)
    {

        $ldap_connection = ldap_connect($this->ldap_server, $this->ldap_port);

        if (!$ldap_connection) {
            throw new Exception("Não foi possível se conectar ao servidor LDAP.");
        }

        ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap_connection, LDAP_OPT_REFERRALS, 0);

        if (ldap_bind($ldap_connection, $this->ldap_dn . $username, $password)) {
            return true;
        } else {
            return false;
        }
    }
}