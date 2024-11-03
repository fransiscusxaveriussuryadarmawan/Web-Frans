<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    echo "Unauthorized access. Please authenticate first.";
    exit;
}

require_once 'config.php';

function updatePaste($id, $title, $content, $conn)
{
    $stmt = $conn->prepare("UPDATE content_simpan SET title = ?, content = ?, last_updated = NOW() WHERE id = ?");
    $stmt->bind_param("sss", $title, $content, $id);
    return $stmt->execute();
}

if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['content'])) {
    $id = $_POST['id'];
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');

    if (preg_match('/^[a-f0-9]{32}$/', $id)) {
        if (updatePaste($id, $title, $content, $conn)) {
            header("Location: paste.php?id=$id&message=Update successful");
            exit;
        } else {
            echo "Failed to update paste.";
        }
    } else {
        echo "Invalid ID format.";
    }
} else {
    echo "Required data missing.";
}
