document.addEventListener("DOMContentLoaded", function() {
    function generateHtml(obj, indentLevel = 0) {
        let html = '';
        for (const [key, value] of Object.entries(obj)) {
            const indentClass = indentLevel > 0 ? 'nested' : '';
            if (typeof value === 'object' && value !== null) {
                html += `<div class="${indentClass}"><strong>${key.replace(/_/g, ' ')}:</strong></div>`;
                html += generateHtml(value, indentLevel + 1);
            } else {
                html += `<div class="result-item ${indentClass}"><strong>${key.replace(/_/g, ' ')}:</strong> ${value || 'N/A'}</div>`;
            }
        }
        return html;
    }

    var response = document.getElementById('result').getAttribute('data-result');
    console.log("Raw response data:", response);  // Debugging statement

    if (response !== 'null') {
        try {
            var data = JSON.parse(response);
            console.log("Parsed response data:", data);  // Debugging statement

            if (data) {
                document.getElementById('map').style.display = 'block';
                var resultDiv = document.getElementById('result');
                resultDiv.innerHTML = generateHtml(data);
                
                const map = L.map('map').setView([data.latitude, data.longitude], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                L.marker([data.latitude, data.longitude]).addTo(map)
                    .bindPopup("<b>Postcode:</b> " + data.postcode + "<br><b>Country:</b> " + data.country).openPopup();
            }
        } catch (error) {
            console.error("Error parsing JSON response:", error);  // Debugging statement
        }
    }
});
