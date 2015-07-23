# HelloRabbitMqBundle

[![Latest Stable Version](https://poser.pugx.org/hgtan/rabbitmq-bundle/v/stable)](https://packagist.org/packages/hgtan/rabbitmq-bundle)
[![Total Downloads](https://poser.pugx.org/hgtan/rabbitmq-bundle/downloads)](https://packagist.org/packages/hgtan/rabbitmq-bundle)
[![Latest Unstable Version](https://poser.pugx.org/hgtan/rabbitmq-bundle/v/unstable)](https://packagist.org/packages/hgtan/rabbitmq-bundle)
[![License](https://poser.pugx.org/hgtan/rabbitmq-bundle/license)](https://packagist.org/packages/hgtan/rabbitmq-bundle)

[![Build Status](https://img.shields.io/travis/FriendsOfBundle/HelloRabbitMqBundle.svg?style=flat-square)](https://travis-ci.org/FriendsOfBundle/HelloRabbitMqBundle)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/FriendsOfBundle/HelloRabbitMqBundle.svg?style=flat-square)](https://scrutinizer-ci.com/g/FriendsOfBundle/HelloRabbitMqBundle/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/FriendsOfBundle/HelloRabbitMqBundle.svg?style=flat-square)](https://scrutinizer-ci.com/g/FriendsOfBundle/HelloRabbitMqBundle)
[![HHVM Status](https://img.shields.io/hhvm/hgtan/rabbitmq-bundle.svg?style=flat-square)](http://hhvm.h4cc.de/package/hgtan/rabbitmq-bundle)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/168c5baf-3f6d-44bf-91d0-48ab28322ca2/big.png)](https://insight.sensiolabs.com/projects/168c5baf-3f6d-44bf-91d0-48ab28322ca2)

Messaging in your application via RabbitMQ using the php-amqplib library and the following bundle:
* [RabbitMqBundle](https://github.com/videlalvaro/RabbitMqBundle)

Installation
------------

### Step 1: Using Composer

composer.json
```
    php composer.phar require hgtan/rabbitmq-bundle:dev-master
```

### Step 2 : Register the bundle

Then register the bundle with your kernel:

```
    <?php

    // in AppKernel::registerBundles()
    $bundles = array(
        // ...
        new Hgtan\Bundle\HelloRabbitMqBundle\HgtanHelloRabbitMqBundle(),
        // ...
    );
```

### Step 3 : Configure the bundle
```
    # app/config/config.yml
    old_sound_rabbit_mq:
        connections:
            default:
                host:     'localhost'
                port:     5672
                user:     'guest'
                password: 'guest'
                vhost:    '/'
                lazy:     false
                #connection_timeout: 3
                #read_write_timeout: 3

                # requires php-amqplib v2.4.1+ and PHP5.4+
                #keepalive: false

                # requires php-amqplib v2.4.1+
                #heartbeat: 0
        producers:
            hello_world:
                connection:       default
                exchange_options: {name: 'hello', type: direct}
                class:            Hgtan\Bundle\HelloRabbitMqBundle\Cakper\HelloProducer
        consumers:
            hello_world:
                connection:       default
                exchange_options: {name: 'hello', type: direct}
                queue_options:    {name: 'hello'}
                callback:         hello_world_service
```

Import HelloRabbitMqBundle routing files
```
    # app/config/routing.yml
    hgtan_hello_rabbit_mq:
        resource: "@HgtanHelloRabbitMqBundle/Controller/"
        type:     annotation
        prefix:   /
```

### Step 4 : Example
```
    #RabbitMQ Management
    http://localhost:15672/#/

    $ php app/console server:run

    $ php app/console rabbitmq:consumer hello_world

    # Limit number of messages
    $ php app/console rabbitmq:consumer hello_world -m 10

    http://127.0.0.1:8000/hello/rabbitmq

```