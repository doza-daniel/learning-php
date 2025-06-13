<?php namespace MyCompany\Playground;

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
    $q = 'SELECT id, username, password FROM users WHERE username = :username';
    $stmt = $this->conn->prepare($q);
    $success = $stmt->execute(array('username' => $username));
    if (!$success) {
      return false;
    }
    $user = $stmt->fetch();
    if (password_verify($password, $user['password'])) {
      $_SESSION['username'] = $user['username'];
      $_SESSION['userId'] = $user['id'];
      return true;
    }
    return false;
  }

  public function tryRegister(): bool {
    if (!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['confirm-password'])) {
      return false;
    }

    if ($_POST['password'] !== $_POST['confirm-password']) {
      return false;
    }

    return $this->register($_POST['username'], $_POST['password']);
  }

  private function register(string $username, string $password): bool {
    $q = 'INSERT INTO users (username, password) VALUES (:username, :password)';
    $stmt = $this->conn->prepare($q);
    $success = $stmt->execute(
      array(
        'username' => $username,
        'password' => password_hash($password, PASSWORD_BCRYPT),
      )
    );
    if (!$success) {
      return false;
    }
    $_SESSION['username'] = $username;
    $_SESSION['userId'] = $this->conn->lastInsertId();
    return true;
  }

  public function tryCreatePost(): bool {
    if (!isset($_POST['title']) || !isset($_POST['body'])) {
      return false;
    }

    return $this->createPost($_POST['title'], $_POST['body']);
  }

  private function createPost(string $title, string $body): bool {
    $q =
<<<'EOF'
INSERT INTO posts (title, body, poster_id, created_at)
  VALUES
  (:title, :body, :posterId, FROM_UNIXTIME(:createdAt))
EOF;

    $stmt = $this->conn->prepare($q);
    return $stmt->execute(
      array(
        'title' => $title,
        'body' => $body,
        'posterId' => $_SESSION['userId'],
        'createdAt' => time(),
      )
    );
  }
}
