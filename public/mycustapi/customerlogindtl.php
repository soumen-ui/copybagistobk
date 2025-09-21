<?php
// Allow requests from frontend
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Database config
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "copybagistobk";

// Connect to DB
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}

// Read request
$data = json_decode(file_get_contents("php://input"), true);
$action = isset($_GET['action']) ? $_GET['action'] : null;

// Helper: Hash password
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

// Helper: Generate random token
function generateToken() {
    return bin2hex(random_bytes(32));
}

/* ---------------- SIGNUP ---------------- */
if ($action === "signup") {
    $firstName = $data['first_name'] ?? null;
    $lastName  = $data['last_name'] ?? null;
    $email     = $data['email'] ?? null;
    $password  = $data['password'] ?? null;

    if (!$firstName || !$lastName || !$email || !$password) {
        echo json_encode(["success" => false, "message" => "Missing required fields"]);
        exit();
    }

    $check = $conn->prepare("SELECT id FROM customers WHERE email=?");
    $check->bind_param("s", $email);
    $check->execute();
    $res = $check->get_result();
    if ($res->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Email already exists"]);
        exit();
    }

    $hashed = hashPassword($password);
    $token  = generateToken();

    $stmt = $conn->prepare("INSERT INTO customers (first_name,last_name,email,password,api_token,is_verified,created_at,updated_at) VALUES (?,?,?,?,?,1,NOW(),NOW())");
    $stmt->bind_param("sssss", $firstName, $lastName, $email, $hashed, $token);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Signup successful", "token" => $token]);
    } else {
        echo json_encode(["success" => false, "message" => "Signup failed"]);
    }
    exit();
}

/* ---------------- LOGIN ---------------- */
if ($action === "login") {
    $email    = $data['email'] ?? null;
    $password = $data['password'] ?? null;

    if (!$email || !$password) {
        echo json_encode(["success" => false, "message" => "Missing email or password"]);
        exit();
    }

    $stmt = $conn->prepare("SELECT id, first_name, last_name, email, password, api_token FROM customers WHERE email=? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            echo json_encode([
                "success" => true,
                "message" => "Login successful",
                "data" => [
                    "id" => $row['id'],
                    "first_name" => $row['first_name'],
                    "last_name" => $row['last_name'],
                    "email" => $row['email'],
                    "token" => $row['api_token']
                ]
            ]);
        } else {
            echo json_encode(["success" => false, "message" => "Invalid password"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Email not found"]);
    }
    exit();
}

/* ---------------- FORGOT PASSWORD ---------------- */
if ($action === "forgot") {
    $email = $data['email'] ?? null;
    if (!$email) {
        echo json_encode(["success" => false, "message" => "Email required"]);
        exit();
    }

    $token = generateToken();

    $stmt = $conn->prepare("SELECT id FROM customers WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows === 0) {
        echo json_encode(["success" => false, "message" => "Email not found"]);
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO customer_password_resets (email, token, created_at) VALUES (?,?,NOW())");
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();

    echo json_encode(["success" => true, "message" => "Password reset token generated", "reset_token" => $token]);
    exit();
}

/* ---------------- RESET PASSWORD CONFIRM ---------------- */
if ($action === "reset") {
    $token    = $data['token'] ?? null;
    $password = $data['password'] ?? null;

    if (!$token || !$password) {
        echo json_encode(["success" => false, "message" => "Token and new password required"]);
        exit();
    }

    // Find email for given token
    $stmt = $conn->prepare("SELECT email FROM customer_password_resets WHERE token=? LIMIT 1");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        $email = $row['email'];
        $hashed = hashPassword($password);

        // Update password in customers table
        $stmt2 = $conn->prepare("UPDATE customers SET password=?, updated_at=NOW() WHERE email=?");
        $stmt2->bind_param("ss", $hashed, $email);
        $stmt2->execute();

        // Delete token
        $stmt3 = $conn->prepare("DELETE FROM customer_password_resets WHERE email=?");
        $stmt3->bind_param("s", $email);
        $stmt3->execute();

        echo json_encode(["success" => true, "message" => "Password reset successful"]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid or expired token"]);
    }
    exit();
}

/* ---------------- DEFAULT ---------------- */
echo json_encode(["error" => "Invalid action"]);
exit();
