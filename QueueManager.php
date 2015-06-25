<?php
/**
 * (c) Artyom Kozhemyakin <xenus.t@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arko\QueueManager;


use Doctrine\Common\Collections\ArrayCollection;

class QueueManager implements QueueManagerInterface {
    /**
     * @var ArrayCollection|ArrayCollection[]
     */
    private $queues;

    function __construct()
    {
        $this->queues = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function add(callable $callable, $queueName = 'default')
    {
        $queue = $this->getQueue($queueName);
        $queue->add($callable);
    }

    /**
     * {@inheritdoc}
     */
    public function process($queueName = 'default')
    {
        $queue = $this->getQueue($queueName);
        if (count($queue) > 0) {
            $this->clearQueue($queueName);

            /** @var callable $callable */
            foreach ($queue as $callable) {
                $callable();
            }
        }
    }

    private function getQueue($queueName) {
        if (false === $this->queues->containsKey($queueName)) {
            $this->queues[$queueName] = new ArrayCollection();
        }
        return $this->queues[$queueName];
    }

    private function clearQueue($queueName) {
        if ($this->queues->containsKey($queueName)) {
            $this->queues[$queueName] = new ArrayCollection();
        }
    }
}
