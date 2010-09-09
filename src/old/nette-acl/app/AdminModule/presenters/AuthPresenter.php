<?php

final class Admin_AuthPresenter extends Admin_BasePresenter
{

    /** @persistent */
    public $backlink = '';

    protected function createComponentLoginForm($name)
    {
        $form = new AppForm($this, $name);

        $form->addText('login', 'Email:')
             ->addRule(Form::EMAIL, 'Prosím zadajte registračný email.');

        $form->addPassword('password', 'Password:')
             ->addRule(Form::FILLED, 'Prosím zadajte heslo.');

        $form->addProtection('Prosím odošlite prihlasovacie údaje znova (vypršala platnosť tzv. bezpečnostného tokenu).');
        $form->addSubmit('send', 'Log in!');

        $form->onSubmit[] = array($this, 'loginFormSubmitted');
    }

    public function loginFormSubmitted($form)
    {
        try {
            $user = Environment::getUser();
            $user->authenticate($form['login']->value, $form['password']->value);
            $this->getApplication()->restoreRequest($this->backlink);
            $this->redirect('Default:default');
        }
        catch (AuthenticationException $e) {
            $form->addError($e->getMessage());
        }
    }

}
