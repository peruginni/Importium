<?php

final class Admin_DefaultPresenter extends Admin_BasePresenter
{
    public function startup()
    {
        parent::startup();
        $user = Environment::getUser();

        if (!$user->isAuthenticated()) {
            if ($user->getSignOutReason() === User::INACTIVITY) {
                $this->flashMessage('Uplynula doba neaktivity! Systém vás z bezpečnostných dôvodov odhlásil.', 'warning');
            }

            $backlink = $this->getApplication()->storeRequest();
            $this->redirect('Auth:login', array('backlink' => $backlink));
        }
        else {
            if (!$user->isAllowed($this->reflection->name, $this->getAction())) {
                $this->flashMessage('Na vstup do tejto sekcie nemáte dostatočné oprávnenia!', 'warning');
                $this->redirect('Auth:login');
            }
        }
    }

    public function actionLogout()
    {
        Environment::getUser()->signOut();
        $this->flashMessage('Práve ste sa odlásili z administrácie.');
        $this->redirect('Auth:login');
    }
}
