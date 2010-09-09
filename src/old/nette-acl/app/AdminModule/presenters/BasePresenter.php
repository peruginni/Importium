<?php

abstract class Admin_BasePresenter extends BasePresenter
{
    protected function beforeRender()
    {
        $user = Environment::getUser();
        $this->template->user = ($user->isAuthenticated()) ? $user->getIdentity() : NULL;
    }
}
