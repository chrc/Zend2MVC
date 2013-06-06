<?php

namespace Application\Form;

class FormationForm extends \Zend\Form\Form
{
    public function __construct() {
        parent::__construct("formation");
        
        $this->setAttribute("method", "post");
        
        $element = new \Zend\Form\Element\Text('nom');
        $element->setLabel('Nom');
        $this->add($element);
        
        $element = new \Zend\Form\Element\Text('prix');
        $element->setLabel('Prix');
        $this->add($element);
        
        $element = new \Zend\Form\Element\Submit('submit');
        $element->setValue('Enregistrer');
        $this->add($element);
    }
}