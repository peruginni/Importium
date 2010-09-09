<?php

abstract class Admin_SecuredPresenter extends Admin_BasePresenter
{
    public function startup()
    {
        parent::startup();
        $user = Environment::getUser();

        if (!$user->isAuthenticated()) {
            if ($user->getSignOutReason() === User::INACTIVITY) {
                $this->flashMessage('Uplynula doba neaktivity! Systém vás z bezpečnostných dôvodov odhlásil.', 'warning');
            }

            $this->flashMessage('Na vstup do ADMIN sekcie sa musíte prihlásiť!', 'warning');
            $backlink = $this->getApplication()->storeRequest();
            $this->redirect('Auth:login', array('backlink' => $backlink));
        }
        else {
            if (!$user->isAllowed($this->reflection->name, $this->getAction())) {
                $this->flashMessage('Pokúsili ste sa vstúpiť do sekcie, na ktorú nemáte dostatočné oprávnenia! Vstup vám bol odopretý.', 'warning');
                $this->redirect('Default:');
            }
        }
    }
}
