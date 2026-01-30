<?php

namespace App\Controllers;

use App\Database;
use PDO;

class HomeController {

    private $db;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
            header('Location: index.php?route=login');
            exit;
        }

        $this->db = Database::getInstance()->getConnection();
    }

    public function index() {
        $stmt = $this->db->query("SELECT * FROM actor ORDER BY last_update DESC");
        $actors = $stmt->fetchAll();
        require_once __DIR__ . '/../../views/home.php';
    }

    public function create() {
        require_once __DIR__ . '/../../views/actor_form.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];

            $stmt = $this->db->prepare("INSERT INTO actor (first_name, last_name) VALUES (:fn, :ln)");
            $stmt->execute([':fn' => $firstName, ':ln' => $lastName]);

            header('Location: index.php?route=home');
        }
    }

    public function edit($id) {
        if (!$id) { header('Location: index.php?route=home'); exit; }

        $stmt = $this->db->prepare("SELECT * FROM actor WHERE actor_id = :id");
        $stmt->execute([':id' => $id]);
        $actor = $stmt->fetch();

        if (!$actor) { header('Location: index.php?route=home'); exit; }

        require_once __DIR__ . '/../../views/actor_form.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['actor_id'];
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];

            $stmt = $this->db->prepare("UPDATE actor SET first_name = :fn, last_name = :ln WHERE actor_id = :id");
            $stmt->execute([':fn' => $firstName, ':ln' => $lastName, ':id' => $id]);

            header('Location: index.php?route=home');
        }
    }

    public function delete($id) {
        if ($id) {
            try {
                $stmt = $this->db->prepare("DELETE FROM actor WHERE actor_id = :id");
                $stmt->execute([':id' => $id]);
            } catch (\Exception $e) {

            }
        }
        header('Location: index.php?route=home');
    }
}