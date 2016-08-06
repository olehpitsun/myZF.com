<?php

class Application_Form_User extends Zend_Form
{
    public function __construct()
    {
        $this->setName('form_user');
        parent::__construct();



        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Користувач')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Пароль')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Пошта')
            ->setRequired(true)
            ->addValidator('EmailAddress');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Долати');

        $this->addElements(array($username, $password, $email, $submit));
    }
}