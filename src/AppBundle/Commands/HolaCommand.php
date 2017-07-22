<?php
namespace AppBundle\Commands;

use BoShurik\TelegramBotBundle\Telegram\Command\AbstractCommand;
use BoShurik\TelegramBotBundle\Telegram\Command\PublicCommandInterface;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Message;

class HolaCommand extends AbstractCommand implements PublicCommandInterface
{

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return '/hola';
    }

    /**
     * @inheritDoc
     */
    public function getDescription()
    {
        return 'Te saludo';
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BotApi $api, Message $message)
    {
        $option = $message->getText();
        $options = explode('/hola ', $option);

        if(count($options)>1)
            $option = $options[1];
        else
            $option = null;

        if(strtoupper($option) == 'DAW')
            $text = "Hola gente de 2ºDAW!";
        else
            $text = "Hola!, dame una salchicha";
        $api->sendMessage($message->getChat()->getId(), $text, 'markdown');
    }
}