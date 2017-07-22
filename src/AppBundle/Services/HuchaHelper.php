<?php

namespace AppBundle\Services;

use AppBundle\Entity\Hucha;
use AppBundle\Repository\HuchaRepository;
use Doctrine\ORM\EntityManager;

/**
 * Created by PhpStorm.
 * User: maze
 * Date: 8/05/17
 * Time: 18:49
 */
class HuchaHelper
{
    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    /**
     * Función que devuelve una hucha por chatId, y la cre si no existe.
     * @param $chatId
     * @return Hucha
     */
    public function getHuchaByChat($chatId)
    {
        /** @var HuchaRepository $repositoryHucha */
        $repositoryHucha = $this->em->getRepository('AppBundle:Hucha');
        $hucha = $repositoryHucha->findOneByChatId($chatId);
        if ($hucha == null) {
            $hucha = new Hucha();
            $hucha->setChatId($chatId);
            $hucha->setSaldo(0);
            $this->em->persist($hucha);
            $this->em->flush();
        }

        return $hucha;
    }

    /**
     * Función que añade un saldo a una hucha y luego muestra el saldo
     * @param $chatId
     * @param $saldo
     */
    public function addSaldo(Hucha $hucha, $saldo)
    {
            $hucha->setSaldo($hucha->getSaldo() + $saldo);
            $this->em->persist($hucha);
            $this->em->flush();
    }

    /**
     * Función que devuelve el saldo de una hucha
     * @param $chatId
     * @return float|null
     */
    public function getSaldo($chatId)
    {
        /** @var HuchaRepository $repositoryHucha */
        $repositoryHucha = $this->em->getRepository('AppBundle:Hucha');
        /** @var Hucha $hucha */
        $hucha = $repositoryHucha->findOneByChatId($chatId);
        if ($hucha == null) return null;
        return $hucha->getSaldo();
    }

}