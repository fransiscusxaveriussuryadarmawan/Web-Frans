<?php
session_start();

// Define the admin password (replace with a secure password)
define('ADMIN_PASSWORD', 'Mesch454*');

// Check if the password has already been verified
if (!isset($_SESSION['authenticated'])) {
    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password'])) {
        if ($_POST['password'] === ADMIN_PASSWORD) {
            $_SESSION['authenticated'] = true; // Set session flag to authenticated
        } else {
            $error = "Password salah. Coba lagi.";
        }
    }

    // Show the password form if not authenticated
    if (!isset($_SESSION['authenticated'])) {
?>

        <!DOCTYPE html>
        <html lang="id">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Authorize Access</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                    background-color: #f0f0f0;
                }

                .auth-container {
                    background: #fff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    text-align: center;
                }

                input[type="password"],
                button {
                    padding: 10px;
                    width: 100%;
                    margin-top: 10px;
                    border-radius: 5px;
                    border: 1px solid #ddd;
                }

                button {
                    background-color: #28a745;
                    color: #fff;
                    cursor: pointer;
                }

                button:hover {
                    background-color: #218838;
                }

                .error {
                    color: #ff0000;
                    margin-top: 10px;
                }
            </style>
        </head>

        <body>
            <div class="auth-container">
                <h2>Masukkan Password Admin</h2>
                <form method="POST">
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">Authorize</button>
                </form>
                <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
            </div>
        </body>

        </html>

        <?php
        exit; // Stop further execution if not authenticated
    }
}

// If authenticated, proceed with edit functionality
require_once 'config.php';

function getPaste($id, $conn)
{
    $stmt = $conn->prepare("SELECT * FROM content_simpan WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (preg_match('/^[a-f0-9]{32}$/', $id)) {
        $paste = getPaste($id, $conn);

        if ($paste) {
        ?>

            <!DOCTYPE html>
            <html lang="id">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Edit Paste</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        height: 100vh;
                        background-color: #f0f0f0;
                    }

                    .edit-container {
                        background: #fff;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                        width: 400px;
                        text-align: center;
                    }

                    input[type="text"],
                    textarea,
                    button {
                        width: 100%;
                        padding: 10px;
                        margin-top: 10px;
                        border-radius: 5px;
                        border: 1px solid #ddd;
                    }

                    button {
                        background-color: #007bff;
                        color: #fff;
                        cursor: pointer;
                    }

                    button:hover {
                        background-color: #0056b3;
                    }
                </style>
            </head>

            <body>
                <div class="edit-container">
                    <h2>Edit Paste</h2>
                    <form action="update_paste.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                        <label for="title">Judul:</label>
                        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($paste['title']); ?>" required>

                        <label for="content">Konten:</label>
                        <textarea id="content" name="content" rows="10" required><?php echo htmlspecialchars($paste['content']); ?></textarea>

                        <button type="submit">Simpan Perubahan</button>
                    </form>
                </div>
            </body>

            </html>

<?php
        } else {
            echo "Paste tidak ditemukan.";
        }
    } else {
        echo "ID tidak valid.";
    }
} else {
    echo "ID tidak disediakan.";
}
