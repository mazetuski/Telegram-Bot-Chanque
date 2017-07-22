<?php
namespace AppBundle\Commands;

use AppBundle\Entity\Torpe;
use AppBundle\Services\TorpeHelper;
use BoShurik\TelegramBotBundle\Telegram\Command\AbstractCommand;
use BoShurik\TelegramBotBundle\Telegram\Command\PublicCommandInterface;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Message;

class TorpeCommand extends AbstractCommand implements PublicCommandInterface
{
    /**
     * @var TorpeHelper
     */
    private $torpeHelper;

    public function __construct(TorpeHelper $torpeHelper)
    {

        $this->torpeHelper = $torpeHelper;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return '/torpe';
    }

    /**
     * @inheritDoc
     */
    public function getDescription()
    {
        return 'Te enseño mis caidas';
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BotApi $api, Message $message)
    {

        $option = $message->getText();
        $options = explode('/torpe ', $option);

        if (count($options) > 1)
            $option = $options[1];
        else
            $option = null;

        $torpe = null;

        /** @var Torpe $torpe */
        if ($option != null && is_numeric($option))
            $torpe = $this->torpeHelper->getGifById($option);

        if ($option == null || $torpe == null)
            $torpe = $this->torpeHelper->getRandGif();

        $text = $torpe->getNombre();
        $api->sendVideo($message->getChat()->getId(), $torpe->getUrl(), 'markdown');
        $api->sendMessage($message->getChat()->getId(), $text, 'markdown');
    }
}