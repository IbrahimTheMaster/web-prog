<?php
/**
 * Gallery list + logged-in upload handler (Day 4).
 */
$galleryDir = __DIR__ . '/../images/gallery';
$uploadsDir = __DIR__ . '/../images/uploads';
$allowedExt = array('jpg', 'jpeg', 'png', 'gif', 'webp');
$maxUploadBytes = 3 * 1024 * 1024;
$uploadErrors = array();
$uploadSuccess = '';
$uploadHistory = array();

if (!is_dir($uploadsDir)) {
    mkdir($uploadsDir, 0775, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_image'])) {
    if (!isset($_SESSION['login'])) {
        $uploadErrors[] = 'You must be logged in to upload images.';
    } elseif (!isset($_FILES['image_file']) || $_FILES['image_file']['error'] !== UPLOAD_ERR_OK) {
        $uploadErrors[] = 'Please choose an image file to upload.';
    } else {
        $tmpName = $_FILES['image_file']['tmp_name'];
        $originalName = (string) $_FILES['image_file']['name'];
        $size = (int) $_FILES['image_file']['size'];
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExt, true)) {
            $uploadErrors[] = 'Allowed formats: jpg, jpeg, png, gif, webp.';
        } elseif ($size <= 0 || $size > $maxUploadBytes) {
            $uploadErrors[] = 'Maximum upload size is 3 MB.';
        } elseif (!is_uploaded_file($tmpName)) {
            $uploadErrors[] = 'Invalid upload source.';
        } else {
            $finfo = @finfo_open(FILEINFO_MIME_TYPE);
            $mime = $finfo ? (string) finfo_file($finfo, $tmpName) : '';
            if ($finfo) {
                finfo_close($finfo);
            }
            $allowedMimes = array('image/jpeg', 'image/png', 'image/gif', 'image/webp');
            if ($mime !== '' && !in_array($mime, $allowedMimes, true)) {
                $uploadErrors[] = 'Uploaded file is not a valid image.';
            }
        }

        if (empty($uploadErrors)) {
            $safeBase = preg_replace('/[^a-zA-Z0-9_-]/', '-', pathinfo($originalName, PATHINFO_FILENAME));
            $safeBase = trim((string) $safeBase, '-');
            if ($safeBase === '') {
                $safeBase = 'upload';
            }
            $finalName = $safeBase . '-' . date('YmdHis') . '-' . bin2hex(random_bytes(2)) . '.' . $ext;
            $targetPath = $uploadsDir . '/' . $finalName;
            if (move_uploaded_file($tmpName, $targetPath)) {
                $uploadSuccess = 'Upload successful: ' . $finalName;
                try {
                    $dbh = new PDO(
                        'mysql:host=localhost;dbname=databaselesson',
                        'root',
                        '',
                        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
                    );
                    $dbh->query('SET NAMES utf8 COLLATE utf8_general_ci');
                    $stmt = $dbh->prepare('INSERT INTO image_uploads (file_name, uploaded_by) VALUES (:file_name, :uploaded_by)');
                    $stmt->execute(array(
                        ':file_name' => $finalName,
                        ':uploaded_by' => (string) $_SESSION['login'],
                    ));
                } catch (PDOException $e) {
                    // Upload still succeeds even if metadata table is not present yet.
                }
            } else {
                $uploadErrors[] = 'Upload failed while saving the file.';
            }
        }
    }
}

$collectImages = function ($dir) use ($allowedExt) {
    $out = array();
    if (!is_dir($dir)) {
        return $out;
    }
    foreach (scandir($dir) as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (in_array($ext, $allowedExt, true)) {
            $out[] = $file;
        }
    }
    sort($out, SORT_NATURAL | SORT_FLAG_CASE);
    return $out;
};

$galleryImages = $collectImages($galleryDir);
$uploadImages = $collectImages($uploadsDir);

try {
    $dbh = new PDO(
        'mysql:host=localhost;dbname=databaselesson',
        'root',
        '',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    $dbh->query('SET NAMES utf8 COLLATE utf8_general_ci');
    $stmt = $dbh->query('SELECT file_name, uploaded_by, uploaded_at FROM image_uploads ORDER BY uploaded_at DESC');
    $uploadHistory = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $uploadHistory = array();
}
