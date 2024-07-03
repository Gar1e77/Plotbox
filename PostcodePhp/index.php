<!DOCTYPE html>
<html>
<head>
    <!-- Title of the webpage -->
    <title>Postcode Search</title>
    <!-- Including Leaflet CSS for map styling -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Including custom styles for the webpage -->
    <link rel="stylesheet" href="/static/css/styles.css" />
</head>
<body>
    <!-- Main heading of the webpage -->
    <h1>UK Postcode Search</h1>
    <!-- Form for submitting the postcode -->
    <form id="postcodeForm" action="search.php" method="post">
        <!-- Input field for entering the postcode -->
        <input type="text" id="postcode" name="postcode" placeholder="Enter postcode" required>
        <!-- Submit button for the form -->
        <button type="submit">Search</button>
    </form>
    <!-- Container for the result and map -->
    <div id="container">
        <!-- Div to display the search result; result data is set by PHP -->
        <div id="result" data-result='<?php echo htmlspecialchars($result ?? 'null', ENT_QUOTES, 'UTF-8'); ?>'></div>
        <!-- Div to display the map -->
        <div id="map"></div>
    </div>
    <!-- PHP conditional block to display an error message if it exists -->
    <?php if (isset($error)): ?>
        <div class="result-item" style="color: red;">
            <strong><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></strong>
        </div>
    <?php endif; ?>

    <!-- Including Leaflet JavaScript library for map functionality -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Including custom JavaScript for the webpage functionality -->
    <script src="/static/js/app.js"></script>
</body>
</html>
