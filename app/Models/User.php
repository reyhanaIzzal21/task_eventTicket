<?php

class User
{
    private $databaseConnection;

    public function __construct(mysqli $databaseConnection)
    {
        $this->databaseConnection = $databaseConnection;
    }

    public function findByEmail(string $email)
    {
        $query = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $statement = $this->databaseConnection->prepare($query);
        if (!$statement) {
            return null;
        }
        $statement->bind_param('s', $email);
        $statement->execute();
        $result = $statement->get_result();
        $userRecord = $result->fetch_assoc();
        $statement->close();
        return $userRecord ?: null;
    }

    public function create(array $userData)
    {
        $query = "INSERT INTO users (name, occupation, email, password, created_at, updated_at)
              VALUES (?, ?, ?, ?, NOW(), NOW())";
        $statement = $this->databaseConnection->prepare($query);

        if (!$statement) {
            return false;
        }

        $statement->bind_param(
            'ssss',
            $userData['name'],
            $userData['occupation'],
            $userData['email'],
            $userData['password'] // already hashed
        );

        $executed = $statement->execute();

        if ($executed) {
            $insertedId = $this->databaseConnection->insert_id;
            $statement->close();
            return $insertedId;
        } else {
            $statement->close();
            return false;
        }
    }
}
