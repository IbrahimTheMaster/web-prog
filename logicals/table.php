<?php
/**
 * CRUD for Day 4 dataset table: city_places.
 */
if (!isset($_SESSION['login'])) {
    header('Location: login');
    exit;
}

$crudErrors = array();
$crudNotice = '';
$editingId = isset($_SESSION['crud_editing_id']) ? (int) $_SESSION['crud_editing_id'] : 0;
$editRow = null;

$crudForm = array(
    'place_name' => '',
    'district' => '',
    'category' => '',
    'ticket_price' => '',
);

$pdo = null;
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=databaselesson',
        'root',
        '',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    $pdo->query('SET NAMES utf8 COLLATE utf8_general_ci');
} catch (PDOException $e) {
    $crudErrors[] = 'Database connection failed.';
}

if ($pdo && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $cancelEdit = false;
    if (isset($_POST['cancel_edit'])) {
        $editingId = 0;
        unset($_SESSION['crud_editing_id']);
        $cancelEdit = true;
    }
    $action = isset($_POST['action']) ? (string) $_POST['action'] : '';

    if ($cancelEdit) {
        // no-op when cancelled
    } elseif ($action === 'create' || $action === 'update') {
        $crudForm['place_name'] = trim((string) ($_POST['place_name'] ?? ''));
        $crudForm['district'] = trim((string) ($_POST['district'] ?? ''));
        $crudForm['category'] = trim((string) ($_POST['category'] ?? ''));
        $crudForm['ticket_price'] = trim((string) ($_POST['ticket_price'] ?? ''));

        if ($crudForm['place_name'] === '') {
            $crudErrors[] = 'Place name is required.';
        }
        if ($crudForm['district'] === '') {
            $crudErrors[] = 'District is required.';
        }
        if ($crudForm['category'] === '') {
            $crudErrors[] = 'Category is required.';
        }
        if ($crudForm['ticket_price'] === '' || !is_numeric($crudForm['ticket_price'])) {
            $crudErrors[] = 'Ticket price must be numeric.';
        }
        if (strlen($crudForm['place_name']) > 120 || strlen($crudForm['district']) > 80 || strlen($crudForm['category']) > 60) {
            $crudErrors[] = 'One or more fields are too long.';
        }

        if (empty($crudErrors)) {
            if ($action === 'create') {
                $sql = 'INSERT INTO city_places (place_name, district, category, ticket_price)
                        VALUES (:place_name, :district, :category, :ticket_price)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array(
                    ':place_name' => $crudForm['place_name'],
                    ':district' => $crudForm['district'],
                    ':category' => $crudForm['category'],
                    ':ticket_price' => $crudForm['ticket_price'],
                ));
                $crudNotice = 'Place created successfully.';
                $crudForm = array('place_name' => '', 'district' => '', 'category' => '', 'ticket_price' => '');
            } else {
                $id = (int) ($_POST['id'] ?? 0);
                if ($id <= 0) {
                    $crudErrors[] = 'Invalid record id for update.';
                } else {
                    $sql = 'UPDATE city_places
                            SET place_name = :place_name, district = :district, category = :category, ticket_price = :ticket_price
                            WHERE id = :id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array(
                        ':place_name' => $crudForm['place_name'],
                        ':district' => $crudForm['district'],
                        ':category' => $crudForm['category'],
                        ':ticket_price' => $crudForm['ticket_price'],
                        ':id' => $id,
                    ));
                    $crudNotice = 'Place updated successfully.';
                    $editingId = 0;
                    unset($_SESSION['crud_editing_id']);
                }
            }
        }
    } elseif ($action === 'start_edit') {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            $_SESSION['crud_editing_id'] = $id;
            $editingId = $id;
        }
    } elseif ($action === 'cancel_edit') {
        $editingId = 0;
        unset($_SESSION['crud_editing_id']);
    } elseif ($action === 'delete') {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            $stmt = $pdo->prepare('DELETE FROM city_places WHERE id = :id');
            $stmt->execute(array(':id' => $id));
            $crudNotice = 'Place deleted successfully.';
            if ($editingId === $id) {
                $editingId = 0;
            }
        }
    }
}

if ($pdo && $editingId > 0) {
    $stmt = $pdo->prepare('SELECT id, place_name, district, category, ticket_price FROM city_places WHERE id = :id');
    $stmt->execute(array(':id' => $editingId));
    $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($editRow) {
        $_SESSION['crud_editing_id'] = $editingId;
        $crudForm = array(
            'place_name' => (string) $editRow['place_name'],
            'district' => (string) $editRow['district'],
            'category' => (string) $editRow['category'],
            'ticket_price' => (string) $editRow['ticket_price'],
        );
    } else {
        $editingId = 0;
        unset($_SESSION['crud_editing_id']);
    }
}

$crudRows = array();
if ($pdo) {
    $stmt = $pdo->query('SELECT id, place_name, district, category, ticket_price FROM city_places ORDER BY id ASC');
    $crudRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
