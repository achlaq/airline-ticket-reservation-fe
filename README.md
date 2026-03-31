# FlightBooker: A CodeIgniter Frontend for an Airline Reservation API

This repository contains the source code for FlightBooker, a frontend application for a flight reservation system. It is built with PHP and CodeIgniter 4, acting as a server-side rendered frontend that interfaces with a separate, headless backend API.

The application leverages HTMX to incorporate dynamic, AJAX-powered features without the need for a larger JavaScript framework, demonstrating a robust and maintainable alternative to traditional Single-Page Applications (SPAs).

The development environment is fully containerized using Docker and Docker Compose.

---

## Features

-   **Flight Search:** Search for flights by origin (IATA code), destination (IATA code), and departure date.
-   **Dynamic Results:** Search results are loaded asynchronously onto the page without a full refresh.
-   **Booking Workflow:** A complete user flow for booking a flight, including selecting a flight, providing contact and passenger details, and receiving a booking confirmation.
-   **Booking Management:** An interface for users to retrieve a booking by its PNR (Passenger Name Record), update contact information, or cancel the reservation.
-   **Responsive UI:** The user interface is built with Bootstrap 5 and is optimized for both desktop and mobile devices.

---

## Application Preview

(It is recommended to replace the placeholder below with a screenshot or GIF of the application.)

![Application Screenshot](https://via.placeholder.com/800x500.png?text=Application+Screenshot)

---

## Technology Stack

-   **Backend (BFF):** CodeIgniter 4 on PHP 8.2
-   **Frontend:** Bootstrap 5, HTMX, JavaScript (ES6)
-   **Containerization:** Docker, Docker Compose

---

## Local Development Setup

The following instructions will guide you through setting up and running the project locally.

### Prerequisites

-   Docker
-   Docker Compose

### Installation

1.  **Clone the Repository**
    ```bash
    git clone <your-repository-url>
    cd <repository-directory>
    ```

2.  **Create Environment File**
    Copy the provided `env` template to a new `.env` file. This file holds your local configuration.
    ```bash
    cp env .env
    ```

3.  **Configure Backend API URL**
    Edit the `.env` file and set the `backend.api` variable to the base URL of the backend API service this frontend will communicate with.
    ```ini
    # .env
    app.baseURL = 'http://localhost:8080/'
    CI_ENVIRONMENT = development

    # Set this to your backend's API endpoint
    backend.api = 'http://localhost:8899/api'
    ```

4.  **Build and Run Containers**
    Use Docker Compose to build the application image and start the services.
    ```bash
    docker compose up --build -d
    ```

5.  **Access the Application**
    The application will be available in your browser at `http://localhost:8080`.

---

## Notes

-   PHP dependencies are managed by Composer and are installed within the Docker container during the build process, as specified in the `Dockerfile`. No local PHP or Composer installation is required on the host machine.
-   The application source code is mounted as a Docker volume, so any changes made to local files will be immediately reflected in the running container.
