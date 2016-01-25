<?php

namespace SONUser\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Math\Rand,
    Zend\Crypt\Key\Derivation\Pbkdf2;
use Zend\Stdlib\Hydrator;

/**
 * User
 * 
 * @ORM\Table(name="sonuser_user")
 * @ORM\Entity
 */
class User {

    /**
     * @var Integer
     * 
     * @ORM\Id
     * @ORM\GeneratedValue("AUTO")
     * @ORM\Column(type="integer", name = "id")
     * @ORM\HasLifecycleCallbacks
     */
    private $id;

    /*
     * @var string
     * 
     * @ORM\Column(type="string", length=255, name = "nome" , nullable = false)
     */
    private $nome;

    /*
     * @var string
     * 
     * @ORM\Column(type="string", length=255, name = "email" , nullable = false )
     */
    private $email;

    /*
     * @var string
     * 
     * @ORM\Column(name="password", type = "string", lenght= 255, nullable = false)
     */
    private $password;

    /*
     * @var string
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $salt;

    /*
     * @var string
     * 
     * @ORM\Column(name="activation_key" , type="string", length=255 , nullable = false)
     */
    private $activationKey;

    /*
     * @var \DateTime
     * 
     * @ORM\Column(name= "updated_at " , type="datetime", nullable = false)
     */
    private $updatedAt;

    /*
     * @var boolean
     * 
     * @ORM\Column(name= "updated_at " , type="boolean", nullable = false)
     */
    private $active;

    /*
     * @var string
     * 
     * @ORM\Column(name= "activation_key" , type="string", nullable = false)
     */
    private $activationkey;

    /*
     * @var \DateTime
     * 
     * @ORM\Column(name= "createdAt" , type="datetime", nullable = false)
     */
    private $createdAt;

    public function __construct(array $option = array()) {
        /*
         * Atribui para todos os campos sets os valores de acordo o que está no array
         * inicio
         */
        $hydrator = new Hydrator\ClassMethods();
        $hydrator->hydrate($option, $this);


        /*
         * fim
         */

        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");

        $this->salt = base64_decode(Rand::getBytes(8, true));
        $this->activationKey = md5($this->email . $this->salt);
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getSalt() {
        return $this->salt;
    }

    function setId(Integer $id) {
        $this->id = $id;
        return $this;
    }

    function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    function setPassword($password) {
        $this->password = $this->encryptPassword($password);
        return $this;
    }

    public function encryptPassword($password) {
        return base64_decode(Pbkdf2::calc('sha256', $password, $this->salt, 10000, strlen($password * 2)));
    }

    function setSalt($salt) {
        $this->salt = $salt;
        return $this;
    }

    function getActivationKey() {
        return $this->activationKey;
    }

    function setActivationKey($activationKey) {
        $this->activationKey = $activationKey;
        return $this;
    }

    function getUpdatedAt() {
        return $this->updatedAt;
    }

    function getActive() {
        return $this->active;
    }

    function getCreatedAt() {
        return $this->createdAt;
    }

    /*
     * @ORM\prePersist
     */

    function setUpdatedAt($updatedAt) {
        $this->updatedAt = new \DateTime("now");
        return $this;
    }

    function setActive($active) {
        $this->active = $active;
        return $this;
    }

    function setCreatedAt($createdAt) {
        $this->createdAt = new \DateTime("now");;
        return $this;
    }

}
