<?php
namespace AppBundle\Commands;

use AppBundle\Services\TiempoHelper;
use BoShurik\TelegramBotBundle\Telegram\Command\AbstractCommand;
use BoShurik\TelegramBotBundle\Telegram\Command\PublicCommandInterface;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Message;

class TiempoCommand extends AbstractCommand implements PublicCommandInterface
{

    /**
     * @var TiempoHelper
     */
    private $tiempoHelper;

    public function __construct(TiempoHelper $tiempoHelper)
    {

        $this->tiempoHelper = $tiempoHelper;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return '/tiempo';
    }

    /**
     * @inheritDoc
     */
    public function getDescription()
    {
        return 'Te informo sobre el tiempo';
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BotApi $api, Message $message)
    {
        $apiTiempo = 'c9b2ced402b6c3c63ac31f6dd128168e';
        $url = 'http://api.openweathermap.org/data/2.5/forecast?q=Cordoba,Es&units=metric&appid=' . $apiTiempo . '&lang=es';
        $url2 = 'http://api.openweathermap.org/data/2.5/weather?q=Cordoba,Es&units=metric&appid=' . $apiTiempo . '&lang=es';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')); // Assuming you're requesting JSON
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $data = json_decode($response);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url2);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')); // Assuming you're requesting JSON
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $responseDay = curl_exec($ch);
        $dataDay = json_decode($responseDay);

        $grados = $dataDay->main->temp;
//        $gradosMax = $dataDay->list[0]->temp->max;
//        $gradosMin = $dataDay->list[0]->temp->min;

        $tiempo = $dataDay->weather[0]->main;
        $viento = $dataDay->wind->speed . ' km/h';
        $humedad = $dataDay->main->humidity;
        $tiempoNowDesc = $dataDay->weather[0]->description;
        $tiempo = $this->tiempoHelper->getTiempo($tiempo);
        $text = "Temperatura actual " . $grados . "ºC.\n";
        $text .= "Humedad actual " . $humedad . "% y un viento de ". $viento .".\n";
        $text .= "Clima: " . $tiempoNowDesc . $tiempo. "\n";
        $contador = 0;
        foreach ($data->list as $dataWeather){
            if($contador>2)
                break;
            if($contador<=0) {
                $contador++;
                continue;
            }
                $gradosNow = $dataWeather->main->temp;
                $vientoNow = $dataWeather->wind->speed . ' km/h';
                $tiempoNow = $dataWeather->weather[0]->main;
                $humedadNow = $dataWeather->main->humidity;
                $tiempoDesc = $dataWeather->weather[0]->description;
                $horaNow = $dataWeather->dt_txt;
                $horaNow = explode(' ', $horaNow)[1];
                $tiempoNow = $this->tiempoHelper->getTiempo($tiempoNow);
                $text .= "A las " . $horaNow . ": " . $gradosNow . "ºC con un viento de "
                    . $vientoNow . ", una humedad de " . $humedadNow . " y " . $tiempoDesc . $tiempoNow . "\n";
            $contador++;
        }

        $api->sendMessage($message->getChat()->getId(), $text, 'markdown');
    }
}