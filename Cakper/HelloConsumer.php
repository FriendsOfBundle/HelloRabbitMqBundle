<?php
namespace Hgtan\Bundle\HelloRabbitMqBundle\Cakper;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class HelloConsumer implements ConsumerInterface
{
    public function execute(AMQPMessage $msg)
    {
        echo "Hello $msg->body!" . PHP_EOL;
    }
}

?>