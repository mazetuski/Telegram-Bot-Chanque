<?php
namespace AppBundle\Commands;

use AppBundle\Services\HuchaHelper;
use BoShurik\TelegramBotBundle\Telegram\Command\AbstractCommand;
use BoShurik\TelegramBotBundle\Telegram\Command\PublicCommandInterface;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Message;

class HuchaCommand extends AbstractCommand implements PublicCommandInterface
{

    /**
     * @var HuchaHelper
     */
    private $huchaHelper;

    public function __construct(HuchaHelper $huchaHelper)
    {

        $this->huchaHelper = $huchaHelper;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return '/hucha';
    }

    /**
     * @inheritDoc
     */
    public function getDescription()
    {
        return 'Guardo tus ahorros, gastatelo en salchichas!!';
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BotApi $api, Message $message)
    {
        $chat = $message->getChat()->getId();
        $option = $message->getText();
        $options = explode('/hucha ', $option);

        if(count($options)>1)
            $option = $options[1];
        else
            $option = null;

        $hucha = $this->huchaHelper->getHuchaByChat($chat);
        if ($option == null && !is_numeric($option))
            $saldo = $this->huchaHelper->getSaldo($chat);
        else {
            $this->huchaHelper->addSaldo($hucha, $option);
            $saldo = $this->huchaHelper->getSaldo($chat);
        }
        $text = 'El saldo actual de tu hucha es '.$saldo.' €';
        if($saldo<30)
            $text.=', esta noche me tendré que conformar con una ensaladita :(';
        elseif($saldo >= 100 && $saldo<200)
            $text.=', Ala cuanto dinero!, ¿Me compras un juguete?';
        elseif($saldo >=200)
            $text.=', ya me puedes una cama nueva!';
        $api->sendMessage($message->getChat()->getId(), $text, 'markdown');
    }
}