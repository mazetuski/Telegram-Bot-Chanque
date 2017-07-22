<?php
/**
 * Created by PhpStorm.
 * User: maze
 * Date: 21/05/17
 * Time: 17:05
 */

namespace AppBundle\Command;


use AppBundle\Commands\TiempoCommand;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Chat;
use TelegramBot\Api\Types\Message;

class SymCommand extends ContainerAwareCommand
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('tiempo:send')
            ->setDescription('Envio el tiempo')
            ->setHelp('Este comando envía el tiempo actual');
    }

    /**
     * @see Command
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var TiempoCommand $tiempoCommand */
        $tiempoCommand = $this->getContainer()
            ->get('app.telegram.command.tiempo');
        $botApi = new BotApi($this->getContainer()->getParameter('telegram_bot_api_token'));
        $message = new Message('');
        $chat = new Chat();
        $chat->setId($this->getContainer()->getParameter('chat_id_grupo_bots'));
        $message->setChat($chat);
        $tiempoCommand->execute($botApi, $message);
    }
}