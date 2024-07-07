<?php 

    require_once realpath(__DIR__ . "/vendor/autoload.php");
    use Dotenv\Dotenv;
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    
    $dsn = $_ENV["DSN"];
    $dbusername = $_ENV["DBUSERNAME"];
    $dbpassword = $_ENV["DBPASSWORD"];
    try{
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    /*
    POST:
    $pdo -> The vairable $pdo
    $puzzle -> The puzzle JSON
    $solution -> The puzzle solution JSON
    */
    function postData($pdo, $puzzle, $solution) {try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "INSERT INTO Puzzles (Puzzle, Solution) VALUES ('$puzzle', '$solution');";
        $stmt = $pdo->prepare($query);


        $stmt->execute();
        } catch (PDOException $e) {
            echo "Connection failed " . $e->getMessage();
        }
    }   
    /*
    GET:
    $pdo -> The variable $pdo
    $date -> The date in YYYY-MM-DD format
    */
    function getData($pdo, $date) {try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM Puzzles WHERE Date LIKE '$date%';";
        $stmt = $pdo->prepare($query);

        $stmt->execute();

        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        return $results;

        } catch (PDOException $e) {
            echo "Connection failed " . $e->getMessage();
        }
    
    }   