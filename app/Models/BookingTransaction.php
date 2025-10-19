<?php
// app/Models/BookingTransaction.php

class BookingTransaction
{
    private $databaseConnection;

    public function __construct(mysqli $databaseConnection)
    {
        $this->databaseConnection = $databaseConnection;
    }

    public function create(array $data)
    {
        $query = "INSERT INTO booking_transaction 
        (name, phone, email, customer_bank_name, customer_bank_account, customer_bank_number, proof, total_amount, workshop_id, is_paid, quantity, booking_trx_id, user_id, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

        $stmt = $this->databaseConnection->prepare($query);

        if (!$stmt) {
            die("Query prepare gagal: " . $this->databaseConnection->error);
        }

        $stmt->bind_param(
            'sssssssiiiisi',
            $data['name'],                  // s
            $data['phone'],                 // s
            $data['email'],                 // s
            $data['customer_bank_name'],    // s
            $data['customer_bank_account'], // s
            $data['customer_bank_number'],  // s
            $data['proof'],                 // s
            $data['total_amount'],          // i
            $data['workshop_id'],           // i
            $data['is_paid'],               // i
            $data['quantity'],              // i
            $data['booking_trx_id'],        // s
            $data['user_id']                // i
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

    public function allByWorkshop(int $workshopId)
    {
        $query = "SELECT * FROM booking_transaction WHERE workshop_id = ? ORDER BY created_at DESC";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('i', $workshopId);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        $stmt->close();
        return $rows;
    }

    public function all()
    {
        $query = "SELECT bt.*, w.name as workshop_name 
                  FROM booking_transaction bt 
                  JOIN workshop w ON bt.workshop_id = w.id 
                  ORDER BY bt.created_at DESC";

        $result = $this->databaseConnection->query($query);
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function find(int $id)
    {
        $query = "SELECT * FROM booking_transaction WHERE id = ? LIMIT 1";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }

    public function updateIsPaid(int $id, int $isPaid)
    {
        $query = "UPDATE booking_transaction SET is_paid = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->databaseConnection->prepare($query);
        $stmt->bind_param('ii', $isPaid, $id);
        $executed = $stmt->execute();
        $stmt->close();
        return $executed;
    }

    public function allByUserId(int $userId)
    {
        $query = "SELECT 
                bt.*, 
                w.name AS workshop_name, 
                w.slug AS workshop_slug, 
                w.price AS workshop_price,
                w.thumbnail AS workshop_thumbnail,
                w.started_at AS workshop_started_at,
                w.time_at AS workshop_time_at,
                bt.created_at AS booking_created_at
              FROM booking_transaction bt
              JOIN workshop w ON bt.workshop_id = w.id
              WHERE bt.user_id = ? 
              ORDER BY bt.created_at DESC";

        $stmt = $this->databaseConnection->prepare($query);

        if (!$stmt) {
            die("Query prepare gagal: " . $this->databaseConnection->error);
        }

        $stmt->bind_param('i', $userId);

        if (!$stmt->execute()) {
            // optional: debug
            error_log("BookingTransaction allByUserId execute error: " . $stmt->error);
            $stmt->close();
            return [];
        }

        $result = $stmt->get_result();
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        $stmt->close();
        return $rows;
    }
}
