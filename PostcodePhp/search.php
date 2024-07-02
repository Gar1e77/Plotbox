<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postcode = $_POST['postcode'];
    $result = null;
    $error = null;

    if (!empty($postcode)) {
        $url = "https://api.postcodes.io/postcodes/" . urlencode($postcode);
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if ($data['status'] === 200) {
            $result = json_encode($data['result']);
        } else {
            $error = "Postcode not found.";
        }
    } else {
        $error = "Please enter a postcode.";
    }
}
include 'index.php';
