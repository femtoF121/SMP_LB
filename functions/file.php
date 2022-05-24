<?php
function uploadFile($file, $folder, $prefix)
{
    if (empty($file)) {
        return false;
    }
    if ($file['error'] != 0) {
        return false;
    }
    if (is_uploaded_file($file['tmp_name'])) {
        $path_info = pathinfo($file['name']);
        $extension = $path_info['extension'];

        $name = uniqid($prefix) . '.' . $extension;

        $res = move_uploaded_file(
            $file['tmp_name'],
            $_SERVER['DOCUMENT_ROOT'] . '/images/' . $folder . '/' . $name
        );
        if (!$res) {
            return false;
        } else {
            return $folder . '/' . $name;
        }
    }
    return false;
}