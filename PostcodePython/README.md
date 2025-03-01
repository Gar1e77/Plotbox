# Postcode Search App

This is a simple web application to search for UK postcodes and retrieve geographical information, displayed alongside a map.

## Prerequisites

- Docker
- Docker Compose

## Setup with Docker

1. Clone the repository:
    ```sh
    git clone https://github.com/Gar1e77/Plotbox.git
    cd postcode-search-app
    ```

2. Build and run the Docker container:
    ```sh
    docker-compose up --build
    ```

3. Open a web browser and go to:
    ```
    http://localhost:8080/
    ```

## Project Structure

postcodepython/
├── static/
│   ├── css/
│   │   └── styles.css
│   └── js/
│       └── app.js
├── templates/
│   └── index.html
├── app.py
├── requirements.txt
├── Dockerfile
├── README.md
