<?php namespace MyCompany\Playground;

require_once('vendor/autoload.php');

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutput;

class App {
    private LoggerInterface $logger;
    private string $title;

    public function __construct() {
        $output = new ConsoleOutput(ConsoleOutput::VERBOSITY_VERY_VERBOSE);
        $this->logger = new ConsoleLogger($output);
        $this->title = "App title";
    }

    public function Run(): void {
        $this->logger->info('hello my loggers');
    }

    public function getTitle(): string {
        return $this->title;
    }
}
