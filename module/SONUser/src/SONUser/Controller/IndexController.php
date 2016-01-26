<?php

namespace SONUser\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    public function registerAction() {
        $request = $this->getRequest();
        $result = array();
        try {
            if ($request->isPost()) {
                $nome = $request->getPost("nome");
                $cpf = $request->getPost("cpf");
                $email = $request->getPost("email");
                $password = $request->getPost("password");
                //$salario = $request->getPost("salario");

                $user = new \SONUser\Entity\User();
                $user->setEmail($email);
                $user->setNome($nome);
                $user->setPassword($password);
                $user->setSalt($cpf);

                $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
                $em->persist($user);
                $em->flush();

                $result["resp"] = $user->getNome(). ", enviado corretamente! ".$user->getPassword();
            }
        } catch (Exception $e) {
            echo "Erro $e";
        }
        return new ViewModel($result);

// return new ViewModel();
    }

    public function listarAction() {
        
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        
        $lista = $em->getRepository("SONUser\Entity\User")->findAll();
        return new ViewModel(array('lista' => $lista));
    }

}
