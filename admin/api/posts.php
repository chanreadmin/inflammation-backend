<?php
// Include the database connection file
include('../includes/config.php');

// Set headers to allow cross-origin resource sharing (CORS)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Check if the HTTP method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch posts from the database
    $result = $con->query("SELECT * FROM tblposts WHERE Is_Active = 1");

    // Check if there are any posts
    if ($result->num_rows > 0) {
        $posts = array();

        // Fetch posts and add them to the $posts array
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }

        // Return the posts as JSON
        echo json_encode($posts);
    } else {
        // No posts found
        echo json_encode(array('message' => 'No posts found.'));
    }
} else {
    // If the request method is not GET, return an error
    http_response_code(405);
    echo json_encode(array('message' => 'Method Not Allowed'));
}

// Close the database connection
$con->close();
?>

