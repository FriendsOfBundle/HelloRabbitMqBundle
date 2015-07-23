<?php

namespace Hgtan\Bundle\HelloRabbitMqBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}", name="rabbitmq")
     * @Template()
     */
    public function indexAction($name)
    {
        $this
            ->get('old_sound_rabbit_mq.hello_world_producer')
            ->publish($name);
        return array('name' => $name);
    }
}
