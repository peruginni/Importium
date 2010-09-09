<?php

class Proj_Security_Acl extends Permission
{
    public function __construct()
    {
        // roles
        $this->addRole('guest');
        $this->addRole('registered', 'guest');
        $this->addRole('editor', 'registered');
        $this->addRole('admin');

        // resources
        $this->addResource('Admin_DefaultPresenter');
        $this->addResource('Admin_PagePresenter');
        $this->addResource('Admin_UserPresenter');

        // privileges
        $this->allow('registered', 'Admin_DefaultPresenter', Permission::ALL);
        $this->allow('editor', 'Admin_PagePresenter', Permission::ALL);
        $this->allow('admin', Permission::ALL, Permission::ALL);
    }
}
