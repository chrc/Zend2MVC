<?php

namespace Application\Mapper;

class Formation
{
    /**
     *
     * @var Zend\Db\TableGateway\TableGateway 
     */
    protected $dbTable;
    
    public function __construct(\Zend\Db\TableGateway\TableGateway $dbTable) {
        $this->dbTable = $dbTable;
    }
    
    public function getAll()
    {
        $formations = array();
        
        $resultSet = $this->dbTable->select();
        
        foreach ($resultSet as $result) {
            $f = new \Application\Entity\Formation();
            
            $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
            $hydrator->hydrate((array) $result, $f);
            
            $formations[] = $f;
        }
        
        return $formations;
    }
    
    public function add(\Application\Entity\Formation $formation)
    {
        $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
        $data = $hydrator->extract($formation);
        
        unset($data['stagiaires']);
        unset($data['formateur']);
        
        return $this->dbTable->insert($data);
    }
}
