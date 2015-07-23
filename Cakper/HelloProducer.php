<?php
namespace Hgtan\Bundle\HelloRabbitMqBundle\Cakper;

use OldSound\RabbitMqBundle\RabbitMq\Producer;

class HelloProducer extends Producer
{
    public function publish($msgBody, $routingKey = '', $additionalProperties = array())
    {
        $msgBody = serialize($msgBody);

        parent::publish($msgBody);
    }
}

?>