<?php

namespace AppBundle\EventListener;

use AppBundle\Model\WitMapping;
use TelegramBot\Api\BotApi;
use BoShurik\TelegramBotBundle\Telegram\Command\CommandPool;
use BoShurik\TelegramBotBundle\Event\Telegram\UpdateEvent;
use Tgallice\Wit\Client;
use Tgallice\Wit\Conversation;
use Tgallice\Wit\ConverseApi;
use Tgallice\Wit\Model\Context;

class CommandListener
{
    /**
     * @var BotApi
     */
    private $api;

    /**
     * @var CommandPool
     */
    private $commandPool;

    public function __construct(BotApi $api, CommandPool $commandPool)
    {
        $this->api = $api;
        $this->commandPool = $commandPool;
    }

    /**
     * @param UpdateEvent $event
     */
    public function onUpdate(UpdateEvent $event)
    {
        $message = $event->getUpdate()->getMessage()->getText();
        $client = new Client('MNBSKBS3TLUDK4DACD6IW777VUREIRWC');
        $api = new ConverseApi($client);
        $actionMapping = new WitMapping();
        $conversation = new Conversation($api, $actionMapping);
        $sessionId = 'user-' . time();
        $context = new Context();
        /** @var Context $context */
        $context = $conversation->converse($sessionId, $message, $context);
        $messageText = $context->get('message');
        $firstLetter = substr($messageText, 0, 1);
        if ($messageText != null && $firstLetter != '/' && $messageText != "")
            return $this->api->sendMessage($event->getUpdate()->getMessage()->getChat()->getId(), $messageText, 'markdown');
        elseif($messageText != null && $messageText != ""){
            foreach ($this->commandPool->getCommands() as $command) {

                if (!$message = $event->getUpdate()->getMessage()) {
                    continue;
                }

                $message->setText($messageText);

                if (!$command->isApplicable($message)) {
                    continue;
                }

                $command->execute($this->api, $message);
                $event->setProcessed();

                return true;
            }
        }

        foreach ($this->commandPool->getCommands() as $command) {
            if (!$message = $event->getUpdate()->getMessage()) {
                continue;
            }
            if (!$command->isApplicable($message)) {
                continue;
            }

            $command->execute($this->api, $message);
            $event->setProcessed();

            break;
        }
    }
}