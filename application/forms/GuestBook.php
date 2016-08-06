<?php

class Form_GuestBook extends Zend_Form
{
    public function init()
    {
        $this->setName('index');

        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Ім\'я користувача')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('class', 'validate[required,length[0,100]] text-input form-control');

        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Ел. пошта')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('class', 'validate[required,custom[email]] text-input form-control');

        $website = new Zend_Form_Element_Text('website');
        $website->setLabel('сайт')
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('class', 'form-control');

        $text = new Zend_Form_Element_Textarea('text');
        $text->setOptions(array('cols' => '70', 'rows' => '10'));
        $text->setLabel('текст')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('class', 'validate[required,length[0,400]] text-input form-control');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('class', 'btn btn-primary')
                ->setLabel('Додати');

        $this->addElements(array( $username, $email, $website, $text, $submit));
    }
}

