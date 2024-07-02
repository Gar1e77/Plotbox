<!DOCTYPE html>
<html>
<head>
    <title>Postcode Search</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="/static/css/styles.css" />
</head>
<body>
    <h1>UK Postcode Search</h1>
    <form action="search.php" method="post">
        <input type="text" id="postcode" name="postcode" placeholder="Enter postcode" required>
        <button type="submit">Search</button>
    </form>
    <div id="container">
        <div id="result" data-result='<?php echo htmlspecialchars($result ?? 'null', ENT_QUOTES, 'UTF-8'); ?>'></div>
        <div id="map"></div>
    </div>
    <?php if (isset($error)): ?>
        <div class="result-item" style="color: red;">
            <strong><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></strong>
        </div>
    <?php endif; ?>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="/static/js/app.js"></script>
</body>
</html>
