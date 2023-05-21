<?php

namespace RestApiExample;

use PDO;

/**
 * A simple REST API example for listing and creating users.
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @version 2023
 */
class UserManager
{
    /**
     * @var PDO The PDO object.
     */
    private PDO $dbh;

    /**
     * @var string Defines the content type that this class unterstands.
     */
    private string $contentType;

    /**
     * Creates a new user manager that lists and creates stored users.
     */
    public function __construct()
    {
        $this->initDB();
        $this->contentType = "application/json";
    }

    /**
     * Initializes the database connection. Connects to the database "rest_api_example".
     * @return void Returns nothing.
     */
    private function initDB(): void
    {
        $charsetAttr = "SET NAMES utf8 COLLATE utf8_general_ci";
        // DSN for Docker
        $dsn = "mysql:host=db;port=3306;dbname=rest_api_example";
        $mysqlUser = "onlineshop";
        $mysqlPwd = "geheim";
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => $charsetAttr,
            PDO::MYSQL_ATTR_MULTI_STATEMENTS => false
        ];
        $this->dbh = new PDO($dsn, $mysqlUser, $mysqlPwd, $options);
    }

    /**
     * Returns a JSON representation of all the stored users in a system.
     * @return void Returns nothing because it generates JSON output.
     */
    public function listUsers(): void
    {
        $query = "SELECT * FROM rest_api_example.user";
        $users = [];
        $link = "/users";

        if ($this->dbh) {
            $statement = $this->dbh->query($query);
            $users = $statement->fetchAll();
        }

        $jsonResponse = [];
        $jsonResponse["size"] = count($users);
        $jsonResponse["link"] = $link;

        foreach ($users as $user) {
            $newUser = $user;
            $newUser["link"] = $link . "?id=" . $user["id"];
            $jsonResponse["users"][] = $newUser;
        }

        // Show the successful response. Even if 0 users are in the system, there's an output.
        $this->showResponse(200, $jsonResponse);
    }

    /**
     * Lists a single user with a given ID and returns a JSON representation.
     * @param int $id The ID of the desired user.
     * @return void Returns nothing because it generates JSON output.
     */
    public function listUser(int $id): void
    {
        $query = "SELECT * FROM rest_api_example.user WHERE id = :id";
        $users = [];
        $link = "/users";

        // Select and retrieve this one user.
        if ($this->dbh) {
            $statement = $this->dbh->prepare($query);
            $params = [":id" => $id];
            $statement->execute($params);
            $users = $statement->fetchAll();
        }

        // If there's exactly one user that has been retrieved, generate output. Otherwise, generate a 404 response.
        if (count($users) === 1) {
            $jsonResponse = $users[0];
            $jsonResponse["link"] = $link . "?id=" . $id;
            $this->showResponse(200, $jsonResponse);
        } else {
            $this->showResponse(404);
        }
    }

    /**
     * Add a new user to the system.
     * @return void Returns nothing because it generates JSON output.
     */
    public function addUser(): void
    {
        $success = false;
        $query = "INSERT into rest_api_example.user SET username = :username, realname = :realname";

        if ($this->dbh) {
            $statement = $this->dbh->prepare($query);
            $params = [":username" => $_POST["username"], ":realname" => $_POST["realname"]];
            $success = $statement->execute($params);
        }

        // If adding the user was successful, show 201 otherwise an error 500 because something internally went wrong.
        if ($success) {
            // This could also return the entry of the new user here if necessary
            $this->showResponse(201);
        } else {
            $this->showResponse(500);
        }
    }

    /**
     * Generates a response with a given status code and, if provided, with the necessary content. The content has to be
     * provided as an associative array and is transformed into the data format here. This example stays with JSON but
     * there could be other formats as well.
     * @param int $statusCode The HTTP/REST status code to be returned.
     * @param array|null $content The content that is transformed into the desired output format.
     * @return void Returns nothing because it generates JSON output.
     */
    private function showResponse(int $statusCode, ?array $content = null): void
    {
        // If the request's Accept header contains our content type
        if (str_contains($_SERVER["HTTP_ACCEPT"], $this->contentType)) {
            http_response_code($statusCode);
            header("Content-Type: " . $this->contentType);
            if (isset($content)) {
                echo json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            }
        } else {
            http_response_code(406);
        }
    }
}
