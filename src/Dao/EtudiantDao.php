<?php
// src/Dao/EtudiantDao.php
namespace App\Dao;

use PDO;

class EtudiantDao
{
    private $pdo; private $logger;
    public function __construct(PDO $pdo, Logger $logger)
    { $this->pdo = $pdo; $this->logger = $logger; }

    public function countAll(): int
    {
        $stmt = $this->pdo->query('SELECT COUNT(*) AS c FROM etudiant');
        $row = $stmt->fetch();
        return (int)$row['c'];
    }

    public function findAllPaginated(int $page, int $size): array
    {
        $page = max(1, $page); $size = max(1, min(100, $size));
        $offset = ($page - 1) * $size;
        $sql = 'SELECT e.id, e.cne, e.nom, e.prenom, e.email, e.filiere_id, f.code AS filiere_code, f.libelle AS filiere_libelle
                FROM etudiant e JOIN filiere f ON e.filiere_id = f.id
                ORDER BY e.id DESC
                LIMIT :lim OFFSET :off';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':lim', $size, PDO::PARAM_INT);
        $stmt->bindValue(':off', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT e.*, f.code AS filiere_code, f.libelle AS filiere_libelle FROM etudiant e JOIN filiere f ON e.filiere_id=f.id WHERE e.id=?');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(array $data): int
    {
        $sql = 'INSERT INTO etudiant (cne, nom, prenom, email, filiere_id) VALUES (?,?,?,?,?)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $data['cne'], $data['nom'], $data['prenom'], $data['email'], (int)$data['filiere_id']
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $sql = 'UPDATE etudiant SET cne=?, nom=?, prenom=?, email=?, filiere_id=? WHERE id=?';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $data['cne'], $data['nom'], $data['prenom'], $data['email'], (int)$data['filiere_id'], $id
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM etudiant WHERE id=?');
        return $stmt->execute([$id]);
    }
}