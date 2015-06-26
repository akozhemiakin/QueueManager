QueueManagerBundle
==================

## Installation

Install it using composer:

``` bash
composer.phar require arko/queue-manager "dev-master"
```

## How to use

Generally speaking, this component is designed to be used in a singleton style. Supposed that the QueueManager 
(or any class implementing the QueueManagerInterface) instance will be created once and retrieved later using some DIC
 like Symfony or Pimple. However, it`s up to you how to use it.

You can create an instance of the queue manager like this:

``` php
$queueManager = new Arko\QueueManager\QueueManager();
```

From now you can use it to add different actions to the named queues:

``` php
$queueManager->add(function() {
    // Do something here
}, 'queue_name');

// ...

$queueManager->add(function() {
    // Do something else, maybe somewhere else.
}, 'queue_name');
```
As a first argument to the queue manager add method you can provide any php callable.

Later you will be able to process the queue like this:

``` php
$queueManager->process('queue_name');
```

After the queue is processed, it will be cleared. Generally speaking, it will be cleared just before the queue is 
processed. So, nested queues should work just fine.