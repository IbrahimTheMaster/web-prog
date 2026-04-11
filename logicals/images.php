<?php
/**
 * Build read-only gallery lists from curated folder and uploads folder (Day 3).
 */
$galleryDir = __DIR__ . '/../images/gallery';
$uploadsDir = __DIR__ . '/../images/uploads';
$allowedExt = array('jpg', 'jpeg', 'png', 'gif', 'webp');

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
