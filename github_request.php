<?php
include "./lib/database.php";

$access_token = "????";

// repo url
$url = "https://api.github.com/users/LukasLLaebel/repos";

// starting cURL
$ch = curl_init($url);
// setting up cURL parameters
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: token {$access_token}",
    "User-Agent: Github in curl"
));
// getting cURL response
$response = curl_exec($ch);
curl_close($ch);

// decoding the data to array
$data = json_decode($response, true);

// setting up sql database structure
$stmt = $connect->prepare(
    "INSERT INTO github_data (description, repo_name, created_at, updated_at, language, stars, visibility, url) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
);

// checking for database connection errors
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}





?>