<!DOCTYPE html>
<html>
<head>
    <title>Postcode Search</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        input { margin: 10px 0; padding: 5px; }
        button { padding: 5px 10px; }
        #container { display: flex; flex-direction: row; justify-content: space-between; margin-top: 20px; }
        #result { flex: 1; margin-right: 20px; }
        .result-item { margin-bottom: 10px; }
        .nested { margin-left: 20px; }
        #map { flex: 1; height: 400px; width: 100%; display: none; }
    </style>
    <!-- Include Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body>
    <h1>UK Postcode Search</h1>
    <form id="postcodeForm">
        <input type="text" id="postcode" name="postcode" placeholder="Enter postcode" required>
        <button type="submit">Search</button>
    </form>
    <div id="container">
        <div id="result"></div>
        <div id="map"></div>
    </div>

    <!-- Include Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.getElementById('postcodeForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const postcode = document.getElementById('postcode').value;
            fetch('search.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ 'postcode': postcode })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    document.getElementById('result').innerText = data.error;
                    document.getElementById('map').style.display = 'none';
                } else {
                    let resultHtml = '';
                    const generateHtml = (obj, parentKey = '', indentLevel = 0) => {
                        for (const [key, value] of Object.entries(obj)) {
                            const displayKey = parentKey ? `${parentKey} ${key}` : key;
                            const indentClass = indentLevel > 0 ? 'nested' : '';
                            if (typeof value === 'object' && value !== null) {
                                resultHtml += `<div class="${indentClass}"><strong>${displayKey.replace(/_/g, ' ')}:</strong></div>`;
                                generateHtml(value, displayKey, indentLevel + 1);
                            } else {
                                resultHtml += `<div class="result-item ${indentClass}"><strong>${displayKey.replace(/_/g, ' ')}:</strong> ${value || 'N/A'}</div>`;
                            }
                        }
                    };
                    generateHtml(data);
                    document.getElementById('result').innerHTML = resultHtml;

                    // Display the map
                    document.getElementById('map').style.display = 'block';
                    const map = L.map('map').setView([data.latitude, data.longitude], 13);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);
                    L.marker([data.latitude, data.longitude]).addTo(map)
                        .bindPopup(`<b>${data.postcode}</b><br />${data.country}`).openPopup();
                }
            });
        });
    </script>
</body>
</html>
