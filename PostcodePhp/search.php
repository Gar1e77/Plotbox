<?php
// Check if the form is submitted via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted postcode
    $postcode = $_POST['postcode'];
    // Initialize result and error variables
    $result = null;
    $error = null;

    // Regular expression pattern for validating UK postcodes
    $postcodePattern = '/^([GIR 0AA]|(A[BL]|B[ABDHLNRST]?|C[ABFHMORTVW]?|D[ADEGHLNTY]?|E[HNX]?|F[KY]?|G[LUY]?|H[ADGPRSUX]?|I[GMPV]?|JE|K[ATWY]|L[ADELNSU]?|M[EKL]?|N[EGNPRW]?|O[LX]?|P[AEHLOR]?|R[GHM]?|S[AEGKLMNORSTY]?|T[ADFNQRSW]?|UB|W[ADFNRSV]?|YO|ZE)[0-9][0-9A-Z]?[0-9][ABD-HJLNP-UW-Z]{2})$/i';

    // Check if the postcode is not empty
    if (!empty($postcode)) {
        // Validate the postcode against the regular expression pattern
        if (preg_match($postcodePattern, $postcode)) {
            // Construct the API URL for postcode lookup
            $url = "https://api.postcodes.io/postcodes/" . urlencode($postcode);
            // Send a GET request to the API and retrieve the response
            $response = file_get_contents($url);
            // Decode the JSON response into an associative array
            $data = json_decode($response, true);

            // Check if the API response status is 200 (OK)
            if ($data['status'] === 200) {
                // Encode the result data into JSON format and store it in the result variable
                $result = json_encode($data['result']);
            } else {
                // Set the error message if the postcode is not found
                $error = "Postcode not found.";
            }
        } else {
            // Set the error message for an invalid postcode format
            $error = "Invalid postcode format.";
        }
    } else {
        // Set the error message if the postcode input is empty
        $error = "Please enter a postcode.";
    }
}
// Include the index.php file to display the form and results
include 'index.php';
?>
