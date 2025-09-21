<?php
// header("Content-Type: application/json; charset=UTF-8");

// // Database config (should match your .env file in Bagisto)
// $host = "127.0.0.1";
// $user = "root"; // change if your MySQL user is different
// $pass = "";     // change if your MySQL password is set
// $db   = "copybagistobk";

// // Connect to DB
// $conn = new mysqli($host, $user, $pass, $db);

// if ($conn->connect_error) {
//     die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
// }

// // Optional: filter by product_id
// $productId = isset($_GET['product_id']) ? intval($_GET['product_id']) : null;

// $sql = "SELECT pav.product_id, pav.text_value, pav.attribute_id, a.code AS attribute_code
//         FROM product_attribute_values pav
//         JOIN attributes a ON pav.attribute_id = a.id
//         WHERE pav.text_value IS NOT NULL AND pav.text_value != ''";

// if ($productId) {
//     $sql .= " AND pav.product_id = " . $productId;
// }

// $result = $conn->query($sql);

// $data = [];

// // Group values by product_id with keys
// while ($row = $result->fetch_assoc()) {
//     $pid = $row["product_id"];
//     $key = $row["attribute_code"]; // e.g., 'name', 'description'
//     $value = strip_tags($row["text_value"]);

//     if (!isset($data[$pid])) {
//         $data[$pid] = [
//             "product_id" => $pid,
//             "values"     => []
//         ];
//     }

//     $data[$pid]["values"][$key] = $value;
// }

// // Reset array keys
// $data = array_values($data);

// echo json_encode($data, JSON_PRETTY_PRINT);

// $conn->close();
// ?>


<?php
// header("Content-Type: application/json; charset=UTF-8");

// // Database config (should match your .env file in Bagisto)
// $host = "127.0.0.1";
// $user = "root"; // change if your MySQL user is different
// $pass = "";     // change if your MySQL password is set
// $db   = "copybagistobk";

// // Connect to DB
// $conn = new mysqli($host, $user, $pass, $db);

// if ($conn->connect_error) {
//     die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
// }

// // Optional: filter by product_id
// $productId = isset($_GET['product_id']) ? intval($_GET['product_id']) : null;

// $sql = "SELECT pav.product_id, pav.text_value, pav.attribute_id, a.code AS attribute_code
//         FROM product_attribute_values pav
//         JOIN attributes a ON pav.attribute_id = a.id
//         WHERE pav.text_value IS NOT NULL AND pav.text_value != ''";

// if ($productId) {
//     $sql .= " AND pav.product_id = " . $productId;
// }

// $result = $conn->query($sql);

// $data = [];

// // Group values by product_id with keys
// while ($row = $result->fetch_assoc()) {
//     $pid = $row["product_id"];
//     $key = $row["attribute_code"]; // e.g., 'name', 'description'
//     $value = strip_tags($row["text_value"]);

//     if (!isset($data[$pid])) {
//         $data[$pid] = [
//             "product_id" => $pid,
//             "values"     => []
//         ];
//     }

//     // Special handling for description → split into lines
//     if ($key === "description") {
//         $lines = preg_split('/\r\n|\r|\n/', $value);
//         $lineData = [];
//         $i = 1;
//         foreach ($lines as $line) {
//             if (trim($line) !== "") {
//                 $lineData["descline" . $i] = trim($line);
//                 $i++;
//             }
//         }
//         $data[$pid]["values"][$key] = ["lines" => $lineData];
//     } else {
//         $data[$pid]["values"][$key] = $value;
//     }
// }

// // Reset array keys
// $data = array_values($data);

// echo json_encode($data, JSON_PRETTY_PRINT);

// $conn->close();
?>


<?php
// <!-- working with product attrubutes field below -->
// // Allow requests from any origin (you can restrict it to your frontend URL)
// header("Access-Control-Allow-Origin: http://localhost:5173");
// header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type, Authorization");
// header("Content-Type: application/json; charset=UTF-8");

// // Handle preflight requests
// if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//     http_response_code(200);
//     exit();
// }

// // Database config (should match your .env file in Bagisto)
// $host = "127.0.0.1";
// $user = "root"; // change if your MySQL user is different
// $pass = "";     // change if your MySQL password is set
// $db   = "copybagistobk";

// // Connect to DB
// $conn = new mysqli($host, $user, $pass, $db);

// if ($conn->connect_error) {
//     die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
// }

// // Optional: filter by product_id
// $productId = isset($_GET['product_id']) ? intval($_GET['product_id']) : null;

// $sql = "SELECT pav.product_id, pav.text_value, pav.attribute_id, a.code AS attribute_code
//         FROM product_attribute_values pav
//         JOIN attributes a ON pav.attribute_id = a.id
//         WHERE pav.text_value IS NOT NULL AND pav.text_value != ''";

// if ($productId) {
//     $sql .= " AND pav.product_id = " . $productId;
// }

// $result = $conn->query($sql);

// $data = [];

// // Group values by product_id with keys
// while ($row = $result->fetch_assoc()) {
//     $pid = $row["product_id"];
//     $key = $row["attribute_code"];
//     $value = strip_tags($row["text_value"]);

//     // Special handling for description → split into lines
//     if ($key === "description") {
//         $lines = preg_split('/\r\n|\r|\n/', $value);
//         $lineData = [];
//         $i = 1;
//         foreach ($lines as $line) {
//             if (trim($line) !== "") {
//                 $lineData["descline" . $i] = trim($line);
//                 $i++;
//             }
//         }
//         $data[$pid]["values"][$key] = ["lines" => $lineData];
//     } else {
//         $data[$pid]["values"][$key] = $value;
//     }

//     if (!isset($data[$pid])) {
//         $data[$pid] = [
//             "product_id" => $pid,
//             "values"     => []
//         ];
//     }
// }

// // Reset array keys
// $data = array_values($data);

// echo json_encode($data, JSON_PRETTY_PRINT);

// $conn->close();
?>

<?php
// /////// with video url below
// // Allow requests from frontend
// header("Access-Control-Allow-Origin: http://localhost:5173");
// header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type, Authorization");
// header("Content-Type: application/json; charset=UTF-8");

// // Handle preflight
// if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//     http_response_code(200);
//     exit();
// }

// // Database config
// $host = "127.0.0.1";
// $user = "root";
// $pass = "";
// $db   = "copybagistobk";

// // Connect to DB
// $conn = new mysqli($host, $user, $pass, $db);
// if ($conn->connect_error) {
//     die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
// }

// // Optional: filter by product_id
// $productId = isset($_GET['product_id']) ? intval($_GET['product_id']) : null;

// // Fetch product attribute values
// $sql = "SELECT pav.product_id, pav.text_value, pav.attribute_id, a.code AS attribute_code
//         FROM product_attribute_values pav
//         JOIN attributes a ON pav.attribute_id = a.id
//         WHERE pav.text_value IS NOT NULL AND pav.text_value != ''";

// if ($productId) {
//     $sql .= " AND pav.product_id = " . $productId;
// }

// $result = $conn->query($sql);
// $data = [];

// // Group attribute values by product_id
// while ($row = $result->fetch_assoc()) {
//     $pid = $row["product_id"];
//     $key = $row["attribute_code"];
//     $value = strip_tags($row["text_value"]);

//     if (!isset($data[$pid])) {
//         $data[$pid] = [
//             "product_id" => $pid,
//             "values"     => []
//         ];
//     }

//     // Description split into lines
//     if ($key === "description") {
//         $lines = preg_split('/\r\n|\r|\n/', $value);
//         $lineData = [];
//         $i = 1;
//         foreach ($lines as $line) {
//             if (trim($line) !== "") {
//                 $lineData["descline" . $i] = trim($line);
//                 $i++;
//             }
//         }
//         $data[$pid]["values"][$key] = ["lines" => $lineData];
//     } else {
//         $data[$pid]["values"][$key] = $value;
//     }
// }

// // Fetch product videos
// $videoSql = "SELECT product_id, path FROM product_videos WHERE path IS NOT NULL AND path != ''";
// if ($productId) {
//     $videoSql .= " AND product_id = " . $productId;
// }
// $videoResult = $conn->query($videoSql);

// while ($vrow = $videoResult->fetch_assoc()) {
//     $pid = $vrow["product_id"];
//     $videoPath = $vrow["path"];

//     if (!isset($data[$pid])) {
//         $data[$pid] = [
//             "product_id" => $pid,
//             "values"     => []
//         ];
//     }

//     if (!isset($data[$pid]["values"]["videos"])) {
//         $data[$pid]["values"]["videos"] = [];
//     }

//     // Assign as object keys: vdo1, vdo2...
//     $index = count($data[$pid]["values"]["videos"]) + 1;
//     $data[$pid]["values"]["videos"]["vdo" . $index] = $videoPath;
// }

// // Reset array keys
// $data = array_values($data);

// echo json_encode($data, JSON_PRETTY_PRINT);
// $conn->close();
?>
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

// Optional: filter by product_id
$productId = isset($_GET['product_id']) ? intval($_GET['product_id']) : null;

// Fetch product attribute values
$sql = "SELECT pav.product_id, pav.text_value, pav.attribute_id, a.code AS attribute_code
        FROM product_attribute_values pav
        JOIN attributes a ON pav.attribute_id = a.id
        WHERE pav.text_value IS NOT NULL AND pav.text_value != ''";

if ($productId) {
    $sql .= " AND pav.product_id = " . $productId;
}

$result = $conn->query($sql);
$data = [];

// Group attribute values by product_id
while ($row = $result->fetch_assoc()) {
    $pid = $row["product_id"];
    $key = $row["attribute_code"];
    $value = strip_tags($row["text_value"]);

    if (!isset($data[$pid])) {
        $data[$pid] = [
            "product_id" => $pid,
            "values"     => []
        ];
    }

    // Description split into lines
    if ($key === "description") {
        $lines = preg_split('/\r\n|\r|\n/', $value);
        $lineData = [];
        $i = 1;
        foreach ($lines as $line) {
            if (trim($line) !== "") {
                $lineData["descline" . $i] = trim($line);
                $i++;
            }
        }
        $data[$pid]["values"][$key] = ["lines" => $lineData];
    } else {
        $data[$pid]["values"][$key] = $value;
    }
}

// Fetch product videos
$videoSql = "SELECT product_id, path FROM product_videos WHERE path IS NOT NULL AND path != ''";
if ($productId) {
    $videoSql .= " AND product_id = " . $productId;
}
$videoResult = $conn->query($videoSql);

while ($vrow = $videoResult->fetch_assoc()) {
    $pid = $vrow["product_id"];
    $videoPath = $vrow["path"];

    if (!isset($data[$pid])) {
        $data[$pid] = [
            "product_id" => $pid,
            "values"     => []
        ];
    }

    if (!isset($data[$pid]["values"]["videos"])) {
        $data[$pid]["values"]["videos"] = [];
    }

    // Assign as object keys: vdo1, vdo2...
    $index = count($data[$pid]["values"]["videos"]) + 1;
    $data[$pid]["values"]["videos"]["vdo" . $index] = $videoPath;
}

// Fetch product images
$imageSql = "SELECT product_id, path FROM product_images WHERE path IS NOT NULL AND path != '' ORDER BY position ASC";
if ($productId) {
    $imageSql .= " AND product_id = " . $productId;
}
$imageResult = $conn->query($imageSql);

while ($irow = $imageResult->fetch_assoc()) {
    $pid = $irow["product_id"];
    $imagePath = $irow["path"];

    if (!isset($data[$pid])) {
        $data[$pid] = [
            "product_id" => $pid,
            "values"     => []
        ];
    }

    if (!isset($data[$pid]["values"]["images"])) {
        $data[$pid]["values"]["images"] = [];
    }

    // Assign as object keys: img1, img2...
    $index = count($data[$pid]["values"]["images"]) + 1;
    $data[$pid]["values"]["images"]["img" . $index] = $imagePath;
}

// Reset array keys
$data = array_values($data);

echo json_encode($data, JSON_PRETTY_PRINT);
$conn->close();
?>


