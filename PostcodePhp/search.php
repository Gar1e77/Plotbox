<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postcode = $_POST['postcode'];
    $result = null;
    $error = null;

    $postcodePattern = '/^([GIR 0AA]|(A[BL]|B[ABDHLNRST]?|C[ABFHMORTVW]?|D[ADEGHLNTY]?|E[HNX]?|F[KY]?|G[LUY]?|H[ADGPRSUX]?|I[GMPV]?|JE|K[ATWY]|L[ADELNSU]?|M[EKL]?|N[EGNPRW]?|O[LX]?|P[AEHLOR]?|R[GHM]?|S[AEGKLMNORSTY]?|T[ADFNQRSW]?|UB|W[ADFNRSV]?|YO|ZE)[0-9][0-9A-Z]?[0-9][ABD-HJLNP-UW-Z]{2})$/i';

    if (!empty($postcode)) {
        if (preg_match($postcodePattern, $postcode)) {
            $url = "https://api.postcodes.io/postcodes/" . urlencode($postcode);
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if ($data['status'] === 200) {
                $result = json_encode($data['result']);
            } else {
                $error = "Postcode not found.";
            }
        } else {
            $error = "Invalid postcode format.";
        }
    } else {
        $error = "Please enter a postcode.";
    }
}
include 'index.php';
?>
