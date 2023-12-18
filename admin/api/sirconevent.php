<?php
// Include the database connection file
include('../includes/config.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Check if the HTTP method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the post ID is provided in the request
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $postId = $_GET['id'];

        // Fetch a single post from the database based on ID
        $result = $con->query("SELECT * FROM tbl_sircon WHERE id = $postId ");

        // Check if the post is found
        if ($result->num_rows == 1) {
            $post = $result->fetch_assoc();
            echo json_encode($post);
        } else {
            // Post not found
            http_response_code(404);
            echo json_encode(array('message' => 'Post not found.'));
        }
    } else {
        // Post ID not provided or invalid
        http_response_code(400);
        echo json_encode(array('message' => 'Invalid or missing post ID.'));
    }
} else {
    // If the request method is not GET, return an error
    http_response_code(405);
    echo json_encode(array('message' => 'Method Not Allowed'));
}

// Close the database connection
$con->close();
?>