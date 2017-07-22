<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hucha
 *
 * @ORM\Table(name="hucha")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HuchaRepository")
 */
class Hucha
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="chatId", type="integer", unique=true)
     */
    private $chatId;

    /**
     * @var float
     *
     * @ORM\Column(name="saldo", type="float")
     */
    private $saldo;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set chatId
     *
     * @param string $chatId
     *
     * @return Hucha
     */
    public function setChatId($chatId)
    {
        $this->chatId = $chatId;

        return $this;
    }

    /**
     * Get chatId
     *
     * @return string
     */
    public function getChatId()
    {
        return $this->chatId;
    }

    /**
     * Set saldo
     *
     * @param float $saldo
     *
     * @return Hucha
     */
    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;

        return $this;
    }

    /**
     * Get saldo
     *
     * @return float
     */
    public function getSaldo()
    {
        return $this->saldo;
    }
}

