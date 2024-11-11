<?php
session_start();

// Set the timeout duration (in seconds)
$timeout_duration = 600; // 10 minutes

// Check if the user has been inactive for too long
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    // Last request was more than 10 minutes ago, destroy session
    session_unset();     // Unset session variables
    session_destroy();   // Destroy session data
    header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page
    exit;
}
// Update last activity time stamp
$_SESSION['LAST_ACTIVITY'] = time();

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
                /* Root Colors */
                :root {
                    --primary: #6C63FF;
                    --secondary: #FFC107;
                    --bg-light: #f3f4f6;
                    --bg-dark: #fff;
                    --text-dark: #333;
                    --text-light: #888;
                }

                /* Global Styles */
                body {
                    font-family: Arial, sans-serif;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                    margin: 0;
                    background-color: var(--bg-light);
                }

                /* Authentication Container */
                .auth-container {
                    background: var(--bg-dark);
                    padding: 30px 40px;
                    border-radius: 12px;
                    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
                    text-align: center;
                    width: 450px;
                    max-width: 100%;
                }

                .auth-container h2 {
                    color: var(--primary);
                    font-weight: bold;
                    margin-bottom: 20px;
                    font-size: 1.5em;
                }

                /* Input and Button Styles */
                input[type="password"],
                button {
                    padding: 12px 16px;
                    width: 100%;
                    border-radius: 6px;
                    border: 1px solid #ddd;
                    font-size: 1em;
                    margin-top: 12px;
                }

                button {
                    background-color: var(--primary);
                    color: #fff;
                    border: none;
                    cursor: pointer;
                    font-weight: bold;
                    transition: background-color 0.3s ease;
                }

                button:hover {
                    background-color: #5752d6;
                }

                /* Error Message */
                .error {
                    color: #d9534f;
                    font-size: 0.9em;
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
                    /* Edit Container */
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
                        padding: 30px;
                        border-radius: 12px;
                        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
                        width: 600px;
                        max-width: 100%;
                    }

                    .edit-container h2 {
                        color: #333;
                        font-weight: bold;
                        font-size: 1.6em;
                        margin-bottom: 20px;
                        text-align: center;
                    }

                    input[type="text"],
                    textarea,
                    button {
                        width: 100%;
                        padding: 12px;
                        margin-top: 12px;
                        border-radius: 6px;
                        border: 1px solid #ddd;
                        font-size: 1em;
                    }

                    button {
                        background-color: #007bff;
                        color: #fff;
                        cursor: pointer;
                        font-weight: bold;
                        transition: background-color 0.3s ease;
                    }

                    button:hover {
                        background-color: #0056b3;
                    }

                    label {
                        font-weight: bold;
                        margin-top: 15px;
                        display: block;
                        color: #666;
                        font-size: 0.9em;
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
?>