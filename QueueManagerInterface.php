<?php
/**
 * (c) Artyom Kozhemyakin <xenus.t@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arko\QueueManager;


interface QueueManagerInterface {
    /**
     * Adds callable object to the queue
     *
     * @param callable $callable
     * @param $queueName
     * @return mixed
     */
    public function add(callable $callable, $queueName = 'default');

    /**
     * Processes the queue with the specified name
     *
     * @param string $queueName The name of the queue
     */
    public function process($queueName = 'default');
}
