from flask import Flask, request, render_template, jsonify
import requests
import os

app = Flask(__name__)

# Load configuration from environment variables or default values
POSTCODE_API_URL = os.getenv('POSTCODE_API_URL', 'https://api.postcodes.io/postcodes/')

@app.route('/')
def index():
    # Serve the main page
    return render_template('index.html')

@app.route('/search', methods=['POST'])
def search():
    # Retrieve the postcode from the form data
    postcode = request.form['postcode']
    
    # Make a request to the postcode API
    response = requests.get(f"{POSTCODE_API_URL}{postcode}")
    data = response.json()
    
    # Check if the response is successful
    if data['status'] == 200:
        result = data['result']
        return jsonify(result)
    else:
        return jsonify({'error': 'Postcode not found'}), 404

if __name__ == '__main__':
    # Run the Flask app
    app.run(debug=True, host='0.0.0.0', port=8080)
