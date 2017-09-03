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
class TiempoHelper
{

    /**
     * Función que traduce el tiempo.
     * @param $chatId
     * @return Hucha
     */
    public function getTiempo($tiempo)
    {
        switch ($tiempo){
            case 'Clear':
                return ', hace un dia estupendo!, vamos de paseooo!';
            case 'Clouds':
                return ', hay nubes pero no es excusa para que no vayamos al parque...';
            case 'scattered clouds':
                return 'Nubes dispersas';
            case 'Extreme':
                return ', hoy mejor que papa no vaya a trabajar...';
            case 'Drizzle':
                return ', si escampa la llovizna me podrías sacar un rato...';
            case 'Rain':
                return ', esta lloviendo y yo aqui aburrido...';
            case 'Thunderstorm':
                return ', hay tormenta!, yo me quedo en mi camita...';
            case 'Snow':
                return ', ¿esta nevando?, vamos a jugaaaaaaaaar!!';
            case 'Atmosphere':
                return ', no hace buen tiempo para el coche, así no vamos a galicia!';
            default:
                return $tiempo;
        }
    }

}