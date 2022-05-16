<?php

namespace RestApiExample;

use PDO;
use PDOException;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Creates the database, table and user entries for this example to work.
 * @package RestApiExample
 * @author Wolfgang Hochleitner <wolfgang.hochleitner@fh-hagenberg.at>
 * @author Martin Harrer <martin.harrer@fh-hagenberg.at>
 * @version 2022
 */
class CreateDB
{
    /**
     * @var PDO The PDO object.
     */
    private PDO $dbh;

    /**
     * @var Environment Provides a Twig object to display HTML templates.
     */
    private Environment $twig;

    /**
     * @var string[][] An array of users that are to be inserted into the database.
     */
    private array $users;

    /**
     * @var bool Tracks if the schema has been created.
     */
    private bool $schemaCreated;

    /**
     * @var bool Tracks if the table has been created.
     */
    private bool $tableCreated;

    /**
     * @var int Tracks how many users have been created.
     */
    private int $nrOfUsersCreated;

    /**
     * Creates a new object for database initialization. First, an array of users is defined which is later stored in
     * the database. Status variables are then initialized and a database connection is established.
     * @param Environment $twig The Twig object for displaying a response.
     */
    public function __construct(Environment $twig)
    {
        $this->users = [
            [
                "username" => "jdoe",
                "realname" => "John Doe"
            ],
            [
                "username" => "jane789",
                "realname" => "Jane Doe"
            ],
            [
                "username" => "jimmy",
                "realname" => "Jim Doe"
            ]
        ];

        $this->twig = $twig;

        $this->schemaCreated = false;
        $this->tableCreated = false;
        $this->nrOfUsersCreated = 0;

        $this->initDB();
    }

    /**
     * Initializes the database connection.
     * @return void Returns nothing.
     */
    private function initDB(): void
    {
        $charsetAttr = "SET NAMES utf8 COLLATE utf8_general_ci";
        // DSN for Docker
        // $dsn = "mysql:host=db;port=3306";
        // DSN for Vagrant
        $dsn = "mysql:host=localhost;port=3306";
        $mysqlUser = "onlineshop";
        $mysqlPwd = "geheim";
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::MYSQL_ATTR_INIT_COMMAND => $charsetAttr,
            PDO::MYSQL_ATTR_MULTI_STATEMENTS => false
        ];
        $this->dbh = new PDO($dsn, $mysqlUser, $mysqlPwd, $options);
    }

    /**
     * Creates the database schema "rest_api_example" if it does not exist.
     * @return void Returns nothing.
     */
    public function createSchema(): void
    {
        if ($this->dbh) {
            $rowsAffected = $this->dbh->exec("CREATE SCHEMA IF NOT EXISTS rest_api_example DEFAULT CHARACTER SET utf8;");

            if ($rowsAffected > 0) {
                $this->schemaCreated = true;
            }
        }
    }

    /**
     * Creates the table "user". Since a CREATE TABLE statement does not affect rows, the only way to check if the table
     * was already present is to trigger an exception.
     * @return void Returns nothing.
     */
    public function createTable(): void
    {
        if ($this->dbh) {

            $query = "CREATE TABLE rest_api_example.user (id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                   username VARCHAR(100) NOT NULL,
                                   realname VARCHAR(255) NOT NULL,
                                   PRIMARY KEY (id)) ENGINE = InnoDB";
            try {
                $this->dbh->exec($query);
                $this->tableCreated = true;
            } catch (PDOException $exception) {
                // If there's an exception the table was already created. Do nothing.
            }
        }
    }

    /**
     * Add example user accounts to the table "user". First, all entries are queried, then before inserting a new user
     * a check is performed if this username is already present in the table. If this is the case, no new user is
     * inserted.
     * @return void Returns nothing.
     */
    public function addUsers(): void
    {
        $checkQuery = "SELECT username FROM rest_api_example.user";
        $insertQuery = "INSERT INTO rest_api_example.user SET username = :username, realname = :realname";

        if ($this->dbh) {
            $checkStatement = $this->dbh->query($checkQuery);
            $emailRows = $checkStatement->fetchAll(PDO::FETCH_COLUMN);

            foreach ($this->users as $user) {
                if (!in_array($user["username"], $emailRows)) {
                    $statement = $this->dbh->prepare($insertQuery);
                    $params = [":username" => $user["username"], ":realname" => $user["realname"]];
                    $success = $statement->execute($params);
                    if ($success) {
                        $this->nrOfUsersCreated++;
                    }
                }
            }
        }
    }

    /**
     * Displays output (a response) by showing a Twig template.
     * @return void Returns nothing
     * @throws LoaderError Displays a LoaderError if the template file cannot be loaded.
     * @throws RuntimeError Displays a RuntimeError if there is an issue at runtime.
     * @throws SyntaxError Displays a SyntaxError if there is an error in the template.
     */
    public function displayOutput(): void
    {
        $this->twig->display("createdb.html.twig", [
            "schemaCreated" => $this->schemaCreated ? "Yes" : "No",
            "tableCreated" => $this->tableCreated ? "Yes" : "No",
            "nrOfUsersCreated" => $this->nrOfUsersCreated
        ]);
    }
}
