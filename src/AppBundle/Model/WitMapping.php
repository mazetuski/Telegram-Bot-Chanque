<?php

namespace AppBundle\Model;

use \Tgallice\Wit\ActionMapping;
use Tgallice\Wit\Model\Context;

class WitMapping extends ActionMapping
{

    /**
     * @param string $sessionId
     * @param string $actionName
     * @param Context $context
     * @param array $entities
     *
     * @return Context
     */
    public function action($sessionId, $actionName, Context $context, array $entities = [])
    {
        foreach($entities as $entity) {
            $value = $entity[0]['value'];
            if ($value != null && $value != "") {
                $context->add('message', $value);
            }
        }
        return $context;
    }

    /**
     * @param string $sessionId
     * @param string $message
     * @param Context $context
     * @param array $entities
     */
    public function say($sessionId, $message, Context $context, array $entities = [])
    {
        return $context;
        //echo $step->getMessage();
        // TODO: Implement say() method.
    }

    /**
     * @param string $sessionId
     * @param Context $context
     * @param \Exception|string $error
     * @param array $stepData
     */
    public function error($sessionId, Context $context, $error = 'Unknown Error', array $stepData = [])
    {
        return $context;
        // TODO: Implement error() method.
    }

    /**
     * @param string $sessionId
     * @param Context $context
     * @param array $entities
     *
     * @return Context
     */
    public function merge($sessionId, Context $context, array $entities = [])
    {
        return $context;
        //die("M");
        // TODO: Implement merge() method.
    }

    /**
     * @param string $sessionId
     * @param Context $context
     */
    public function stop($sessionId, Context $context)
    {
        return $context;
        //die("S");
        // TODO: Implement stop() method.
    }
}