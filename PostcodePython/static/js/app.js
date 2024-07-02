document.getElementById('postcodeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const postcode = document.getElementById('postcode').value;
    fetch('/search', {
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
                        generateHtml(value, '', indentLevel + 1);
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
