# Postcode Search App

This is a series of simple web applications to search for UK postcodes and retrieve geographical information, displayed alongside a map.
They are presented as a:
  - Python flask variant
  - Php variant
  - Spring boot Java variant

Each variant is presented to demonstrate adaptability to handling the project task in a variety of technologies.

For simplicity sake, each variant is presented with a docker configuration to aid in running each variant in a multi-environment situation. 
In doing so it demonstrates how the developer can share the environmental conditions with others necessary to run these apps.  

In addition, dockerizing the code is a key step in making code readily available in other environments such as the cloud, e.g. in a Kubernetes pod in AWS EKS.
This in turn is a step towards ensuring code is horizontally scalable.


## Prerequisites

- Docker
- Docker Compose

## Setup with Docker

1. Clone the repository:
    ```sh
    git clone https://github.com/Gar1e77/Plotbox.git
    cd < the desired variant>
    ```

2. Build and run the Docker container:
    ```sh
    docker-compose up --build
    ```

3. Open a web browser and go to:
    ```
    http://localhost:8080/
    ```
