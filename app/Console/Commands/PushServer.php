<?php

namespace App\Console\Commands;

use App\Socket\Pusher;

use Illuminate\Console\Command;

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\Wamp\WampServer;
use Ratchet\WebSocket\WsServer;

use React\Socket\Server as ReactServer;
use React\ZMQ\Context as ReactContext;
use React\EventLoop\Factory as ReactLoop;

class PushServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'push:serve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starting Push Server';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $loop   = ReactLoop::create();;
        $pusher = new Pusher();
        $port = env('WEBSOCKET_PORT', 5555);

        // Listen for the web server to make a ZeroMQ push after an ajax request
        $context = new ReactContext($loop);
        $pull = $context->getSocket(\ZMQ::SOCKET_PULL);
        $pull->bind('tcp://127.0.0.1:' . $port); // Binding to 127.0.0.1 means the only client that can connect is itself
        $pull->on('message', [$pusher, 'broadcastData']);

        // Set up our WebSocket server for clients wanting real-time updates
        $webSock = new ReactServer($loop);
        $webSock->listen(8080, '0.0.0.0'); // Binding to 0.0.0.0 means remotes can connect
        $webServer = new IoServer(
            new HttpServer(
                new WsServer(
                    new WampServer(
                        $pusher
                    )
                )
            ),
            $webSock
        );

        $this->info('Run Pusher Server on port: ' . $port);
        $loop->run();
    }
}
