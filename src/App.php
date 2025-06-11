<?php namespace MyCompany\Playground;

require_once('vendor/autoload.php');

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutput;
use PDO;
use Throwable;
use Closure;

class App {
  private LoggerInterface $logger;
  private string $title;
  private $conn;

  public function __construct() {

    $output = new ConsoleOutput(ConsoleOutput::VERBOSITY_VERY_VERBOSE);
    $this->logger = new ConsoleLogger($output);

    set_exception_handler($this->get_ex_handler($this->logger));

    $this->conn = new PDO('mysql:host=db;dbname=playground', 'daniel', '654321');
  }

  /**
   * @param string $username
   * @param string $password
   * @return Closure
   */
  private static function get_ex_handler(LoggerInterface $logger): Closure {
    return function(Throwable $ex) use ($logger) {
      $logger->critical($ex->getMessage());
      // TODO: this won't work always (e.g. if exception thrown in the middle
      // of a page
      header('Location: 500.php');
      die();
    };
  }

  public function Run(): void {
    $this->logger->info('hello my loggers');
  }

  /**
   * @return titles
   */
  public function getTitles(): array {
    $stmt = $this->conn->query('SELECT title FROM titles');
    $result = array();
    while ($row = $stmt->fetch()) {
      array_push($result, $row['title']);
    }
    return $result;
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
    $stmt = $this->conn->prepare('SELECT username, password FROM users WHERE username = ?');
    $stmt = $this->conn->execute([$username]);
    $user = $stmt->fetch();
    $this->logger->info('step by step: ' . $user);
    return password_verify($password, $user['password']);
  }
}
