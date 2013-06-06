<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Mapper\Formation as FormationMapper;

class FormationController extends AbstractActionController
{
    /**
     *
     * @var \Zend\Http\Request
     */
    protected $request;
    

    public function listAction()
    {
        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        
        $dbTable = new \Zend\Db\TableGateway\TableGateway('formation', $adapter);
        
        $mapper = new FormationMapper($dbTable);
        $formations = $mapper->getAll();
        
        return new ViewModel(array("formations" => $formations));
    }
    
    public function ajouterAction()
    {
        $form = new \Application\Form\FormationForm();
        
        if($this->request->isPost())
        {
            $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $inputFilter = new \Application\InputFilter\FormationAjoutFilter($adapter);
            $form->setInputFilter($inputFilter);
            
            $data = $this->request->getPost();
            $form->setData($data);
            
            if($form->isValid())
            {
                $formation = new \Application\Entity\Formation();
                
                $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
                $hydrator->hydrate((array) $form->getData(), $formation);
                
                $dbTable = new \Zend\Db\TableGateway\TableGateway('formation', $adapter);
                $mapper = new FormationMapper($dbTable);
                $mapper->add($formation);
                
                $this->flashMessenger()->addMessage('Formation ajoutée');
                
                return $this->redirect()->toRoute('home');
                //return;
            }
        }
        
        return new ViewModel(array('form' => $form));
    }
}
