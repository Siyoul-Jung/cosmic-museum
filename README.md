# 🌌 Cosmic Museum

**Cosmic Museum** is an interactive digital museum exploring the profound relationship between humanity and the stars. Developed as a final project for **El Camino College - CS12 Web Programming**, this platform bridges the gap between historical celestial discovery and modern space exploration.

---

## 🚀 Quick Start (Docker Environment)

The project is now fully containerized using Docker for instant, consistent deployment across any system.

### Prerequisites
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) installed and running.

### Launching the Museum
1.  **Clone the repository**:
    ```bash
    git clone https://github.com/Siyoul-Jung/cosmic-museum.git
    cd cosmic-museum
    ```
2.  **Start the environment**:
    ```bash
    docker-compose up -d
    ```
3.  **Explore**:
    Open your browser and navigate to **[http://localhost:8080](http://localhost:8080)**.

---

## ✨ Features

### 🛠️ Phase 2: Dynamic Core (Current)
-   **Dynamic Content Engine**: Timeline and Architecture exhibits are dynamically populated from a **MariaDB** database via **PHP (PDO)**.
-   **User Authentication**: Integrated registration and login system for visitors.
-   **Administrative Dashboard**: Exclusive access for admins to manage (Add/Update/Delete) museum exhibits.
-   **Interactive Memory Wall**: A digital space where community reflections are stored and displayed in real-time.

### 📜 Phase 1: Interactive Foundation
-   **Responsive Design**: Modern, glassmorphic UI that adapts to any screen size.
-   **Visual Timelines**: Historical journey through space exploration milestones.
-   **Architectural Gallery**: Showcasing celestial-inspired structures from ancient monuments to modern observatories.

---

## 🏗️ Project Structure

- `Dockerfile`: Configuration for the PHP 8.2-apache environment.
- `docker-compose.yml`: Multi-container orchestration (App + DB).
- `includes/db_connect.php`: Secure database connectivity using the Docker internal network.
- `database_setup.sql`: Core schema initialization.
- `admin.php` & `add_exhibit.php`: Administrative management interfaces.
- `css/` & `js/`: Premium styling and interactive logic.

---

## 🛠️ Technology Stack

-   **Frontend**: HTML5, CSS3 (Custom Modules), JavaScript
-   **Backend**: PHP 8.2
-   **Database**: MariaDB (MySQL Compatible)
-   **Infrastructure**: Docker, Docker Compose

---

## 🎓 Academic Context

-   **Author**: Woongbin
-   **Institution**: El Camino College
-   **Course**: CS12 Web Programming
-   **Project Phase**: Phase 2 (Infrastructure & Dynamic Content)

---

## 🏛️ Legacy Setup (Manual)

<details>
<summary>View Manual Installation Steps (XAMPP/phpMyAdmin)</summary>

1.  Create a database named `cosmic_museum` in phpMyAdmin.
2.  Import `database_setup.sql`, `populate_exhibits.sql`, and `populate_timeline.sql`.
3.  Modify `includes/db_connect.php` to match your local PHP environment (host: `localhost`).
4.  Open the project through your local web server (e.g., `http://localhost/cosmic-museum`).
</details>
