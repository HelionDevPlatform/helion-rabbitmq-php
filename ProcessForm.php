<?php
/* ============================================================================
 (c) Copyright 2014 Hewlett-Packard Development Company, L.P.
Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights to
use, copy, modify, merge,publish, distribute, sublicense, and/or sell copies of
the Software, and to permit persons to whom the Software is furnished to do so,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
============================================================================ */

require('vendor/autoload.php');
// If you are having issues with your RabbitMQ app, enable AMQP_DEBUG to print
// debugging info to the page.
//define('AMQP_DEBUG', true);

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

echo "\n Here's your message: \n";

// Parse the environment variable for the RabbitMQ URL and use the array that's
// returned to connect.
$url = parse_url(getenv('RABBITMQ_URL'));
$conn = new AMQPConnection($url['host'], $url['port'], $url['user'], $url['pass'], substr($url['path'], 1));
$ch = $conn->channel();

// Create a queue
$queue = 'basic_get_queue';
$ch->queue_declare($queue, false, true, false, false);

// Create an exchange
$exchange = 'amq.direct';
$ch->exchange_declare($exchange, 'direct', true, true, false);
$ch->queue_bind($queue, $exchange);

// Publish the user's message
$msg_body = $_POST["message"];
$msg = new AMQPMessage($msg_body, array('content_type' => 'text/plain', 'delivery_mode' => 2));
$ch->basic_publish($msg, $exchange);

// Retrieve the message that was sent
$retrived_msg = $ch->basic_get($queue);
$msgContents = $retrived_msg->body;
echo htmlspecialchars($msgContents);
$ch->basic_ack($retrived_msg->delivery_info['delivery_tag']);

$ch->close();
$conn->close();
