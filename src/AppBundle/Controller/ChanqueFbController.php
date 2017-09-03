<?php
/**
 * Created by PhpStorm.
 * User: maze
 * Date: 3/09/17
 * Time: 18:44
 */

namespace AppBundle\Controller;

use juno_okyo\Chatfuel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Class ChanqueFbController
 * @package AppBundle\Controller
 * @Route("/apiFacebook")
 */
class ChanqueFbController extends Controller
{

    /**
     * @Route("/bot/{msg}", name="bot_facebook_repeat")
     */
    public function facebookAction($msg)
    {
        (new Chatfuel())->sendText($msg);
    }

}