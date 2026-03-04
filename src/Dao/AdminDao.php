<?php
namespace App\Dao;

use PDO;

class AdminDao
{
    private $pdo;
    private $logger;

    public function __construct(PDO $pdo, Logger $logger)
    {
        $this->pdo = $pdo;
        $this->logger = $logger;
    }

    // Hadi hiya la fonction li kay9elleb biha Auth.php 3la l'admin
    public function findByUsername(string $username): ?array
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM admin WHERE username = :username LIMIT 1');
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $user ?: null;
        } catch (\PDOException $e) {
            $this->logger->error("Erreur findByUsername : " . $e->getMessage());
            return null;
        }
    }
}