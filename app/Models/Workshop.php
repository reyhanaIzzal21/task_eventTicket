<?php
// app/Models/Workshop.php

class Workshop
{
    private $databaseConnection;

    public function __construct(mysqli $databaseConnection)
    {
        $this->databaseConnection = $databaseConnection;
    }

    public function all()
    {
        $query = "SELECT * FROM workshop ORDER BY started_at DESC";
        $result = $this->databaseConnection->query($query);
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function find(int $id)
    {
        $query = "SELECT * FROM workshop WHERE id = ? LIMIT 1";
        $statement = $this->databaseConnection->prepare($query);
        $statement->bind_param('i', $id);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch_assoc();
        $statement->close();
        return $row ?: null;
    }

    // 🔹 Fungsi untuk membuat slug otomatis dan unik dari name
    private function generateSlug(string $name): string
    {
        $slug = strtolower(trim($name));
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
        $slug = rtrim($slug, '-');

        // Pastikan slug unik di database
        $baseSlug = $slug;
        $i = 1;

        $query = "SELECT COUNT(*) as total FROM workshop WHERE slug = ?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('s', $slug);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        while ($result && $result['total'] > 0) {
            $slug = $baseSlug . '-' . $i++;
            $stmt->bind_param('s', $slug);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
        }

        $stmt->close();
        return $slug;
    }

    public function create(array $data)
    {
        // 🔹 Slug otomatis unik
        $data['slug'] = $this->generateSlug($data['name']);

        $query = "INSERT INTO workshop (name, slug, thumbnail, venue_thumbnail, about, price, started_at, time_at, address, bg_map, is_open, has_started, created_at, updated_at) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param(
            'sssssissssii',
            $data['name'],
            $data['slug'],
            $data['thumbnail'],
            $data['venue_thumbnail'],
            $data['about'],
            $data['price'],
            $data['started_at'],
            $data['time_at'],
            $data['address'],
            $data['bg_map'],
            $data['is_open'],
            $data['has_started']
        );
        $executed = $stmt->execute();
        if ($executed) {
            $insertId = $this->databaseConnection->insert_id;
            $stmt->close();
            return $insertId;
        }
        $stmt->close();
        return false;
    }

    public function update(int $id, array $data)
    {
        // 🔹 Slug otomatis unik saat update juga
        $data['slug'] = $this->generateSlug($data['name']);

        $query = "UPDATE workshop SET 
            name=?, 
            slug=?, 
            thumbnail=?, 
            venue_thumbnail=?, 
            about=?, 
            price=?, 
            started_at=?, 
            time_at=?, 
            address=?, 
            bg_map=?, 
            is_open=?, 
            has_started=?, 
            updated_at=NOW() 
            WHERE id = ?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param(
            'sssssissssiii',
            $data['name'],
            $data['slug'],
            $data['thumbnail'],
            $data['venue_thumbnail'],
            $data['about'],
            $data['price'],
            $data['started_at'],
            $data['time_at'],
            $data['address'],
            $data['bg_map'],
            $data['is_open'],
            $data['has_started'],
            $id
        );
        $executed = $stmt->execute();
        $stmt->close();
        return $executed;
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM workshop WHERE id = ?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('i', $id);
        $executed = $stmt->execute();
        $stmt->close();
        return $executed;
    }

    public function findBySlug(string $slug)
    {
        $query = "SELECT * FROM workshop WHERE slug = ? LIMIT 1";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('s', $slug);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }
}
