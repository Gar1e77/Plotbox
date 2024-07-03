// Add an event listener to execute when the DOM is fully loaded
document.addEventListener("DOMContentLoaded", function() {
    // Regular expression pattern for validating UK postcodes
    const postcodePattern = /^([GIR 0AA]|(A[BL]|B[ABDHLNRST]?|C[ABFHMORTVW]?|D[ADEGHLNTY]?|E[HNX]?|F[KY]?|G[LUY]?|H[ADGPRSUX]?|I[GMPV]?|JE|K[ATWY]|L[ADELNSU]?|M[EKL]?|N[EGNPRW]?|O[LX]?|P[AEHLOR]?|R[GHM]?|S[AEGKLMNORSTY]?|T[ADFNQRSW]?|UB|W[ADFNRSV]?|YO|ZE)[0-9][0-9A-Z]?[0-9][ABD-HJLNP-UW-Z]{2})$/i;

    // Function to generate HTML from a given object recursively
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

    // Retrieve the result data stored in the HTML element's data attribute
    var response = document.getElementById('result').getAttribute('data-result');
    console.log("Raw response data:", response);  // Debugging statement

    // Check if the response is not null
    if (response !== 'null') {
        try {
            // Parse the JSON response data
            var data = JSON.parse(response);
            console.log("Parsed response data:", data);  // Debugging statement

            if (data) {
                // Display the map container
                document.getElementById('map').style.display = 'block';
                var resultDiv = document.getElementById('result');
                // Generate and insert HTML for the result data
                resultDiv.innerHTML = generateHtml(data);
                
                // Initialize and set the view of the Leaflet map
                const map = L.map('map').setView([data.latitude, data.longitude], 13);
                // Add tile layer to the map
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                // Add a marker to the map with a popup
                L.marker([data.latitude, data.longitude]).addTo(map)
                    .bindPopup("<b>Postcode:</b> " + data.postcode + "<br><b>Country:</b> " + data.country).openPopup();
            }
        } catch (error) {
            console.error("Error parsing JSON response:", error);  // Debugging statement
        }
    }

    // Add event listener for form submission to validate the postcode format
    document.getElementById('postcodeForm').addEventListener('submit', function(event) {
        const postcode = document.getElementById('postcode').value;

        // Validate the postcode format against the regular expression
        if (!postcodePattern.test(postcode)) {
            // Alert the user and prevent form submission if the postcode is invalid
            alert('Please enter a valid UK postcode.');
            event.preventDefault();
        }
    });
});
