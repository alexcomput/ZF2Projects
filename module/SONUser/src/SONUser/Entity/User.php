<?php

namespace SONUser\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Math\Rand,Zend\Crypt\Key\Derivation\Pbkdf2,Zend\Stdlib\Hydrator;

/**
 * User
 * 
 * @ORM\Table(name="sonuser_user")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class User 
{

    /**
     * @var Integer
     * 
     * @ORM\Id
     * @ORM\GeneratedValue("AUTO")
     * @ORM\Column(type="integer", name = "id")
     * 
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255, name = "nome" , nullable = false)
     */
    private $nome;

    /*
     * @var string
     * 
     * @ORM\Column(type="string", length=255, name = "email" , nullable = false)

     */
    private $email;
 
    public function __construct(array $option = array()) 
    {
  
    } 
    public function getId() 
    {
        return $this->id;
    }
 
    public function getNome() 
    {
        return $this->nome;
    }
    public function setNome($nome) 
    {
        $this->nome = $nome;
        return $this;
    }

    public function setId(Integer $id) 
    {
        $this->id = $id;
        return $this;
    }
    public function getEmail() 
    {
        return $this->email;
    }

    public function setEmail($email) 
    {
        $this->email = $email;
        return $this;
    }
 }
