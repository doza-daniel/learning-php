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

    public function isLoggedIn(): bool {
      return isset($_SESSION['username']);
    }

    public function tryLogin(): bool {
      if (!isset($_POST['username']) || !isset($_POST['password'])) {
        return false;
      }

      return $this->login($_POST['username'], $_POST['password']);
    }

    /**
     * @param string $username
     * @param string $password
     */
    private function login($username, $password): bool {
      return false;
    }
}
