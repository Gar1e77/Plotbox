<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $postcode = $_POST['postcode'];
    $url = "https://api.postcodes.io/postcodes/" . urlencode($postcode);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if ($data['status'] == 200) {
        echo json_encode($data['result']);
    } else {
        echo json_encode(['error' => 'Postcode not found']);
    }
}
?>
