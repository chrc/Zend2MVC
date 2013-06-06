<?php

namespace Application\InputFilter;

class FormationAjoutFilter extends \Zend\InputFilter\InputFilter
{
    public function __construct($adapter) {
        
        $input = new \Zend\InputFilter\Input('nom');
        $input->isRequired();
        
        $validator = new \Zend\Validator\StringLength();
        $validator->setMax(255);
        $validator->setMessage('Le nom est trop long',  \Zend\Validator\StringLength::TOO_LONG);
        $input->getValidatorChain()->addValidator($validator);
        
        $this->add($input);
        
        $validator = new \Zend\Validator\Db\NoRecordExists(array(
            'adapter' => $adapter,
            'schema' => 'formation_zend',
            'table' => 'formation',
            'field' => 'nom'
        ));
        $input->getValidatorChain()->addValidator($validator);
        
        $filter = new \Zend\Filter\StringTrim();
        $input->getFilterChain()->attach($filter);
        
        $this->add($input);
    }
}