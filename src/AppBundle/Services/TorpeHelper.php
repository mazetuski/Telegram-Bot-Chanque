<?php

namespace AppBundle\Services;

use AppBundle\Entity\Torpe;
use AppBundle\Repository\TorpeRepository;
use Doctrine\ORM\EntityManager;

/**
 * Created by PhpStorm.
 * User: maze
 * Date: 8/05/17
 * Time: 18:49
 */
class TorpeHelper
{
    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    /**
     * Función que devuelve un Torpe aleatorio
     * @return mixed
     */
    public function getRandGif()
    {
        /** @var TorpeRepository $repositoryTorpe */
        $repositoryTorpe = $this->em->getRepository('AppBundle:Torpe');
        /** @var Torpe $torpe */
        $torpe = $repositoryTorpe->findAll();
        return $torpe[array_rand($torpe, 1)];
    }

    /**
     * Función que devuelve un Torpe aleatorio
     * @return mixed
     */
    public function getGifById($id)
    {
        /** @var TorpeRepository $repositoryTorpe */
        $repositoryTorpe = $this->em->getRepository('AppBundle:Torpe');
        /** @var Torpe $torpe */
        $torpe = $repositoryTorpe->findOneById($id);
        return $torpe;
    }

}