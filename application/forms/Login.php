<?php

class Form_Login extends Zend_Form
{

    public function __construct()
    {

        $this->setName('login');
        parent::__construct();

        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('логін')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('class', 'validate[required,length[0,100]] text-input form-control')
            ->addValidator('NotEmpty', true);

        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('пароль')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('class', 'validate[required,length[0,100]] text-input form-control')
            ->addValidator('NotEmpty', true   );




        $submit = new Zend_Form_Element_Submit('login');
        $submit->setAttrib('class', 'btn btn-primary');

        $submit->setLabel('Увійти');

        $this->addElements(array($username, $password, $submit));

        $this->setMethod('post');
    }
}
?>
