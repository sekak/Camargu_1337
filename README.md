![Screenshot from 2025-07-09 15-26-31](https://github.com/user-attachments/assets/f605661f-1953-49df-a704-d97f8b52e6fe)
![Screenshot from 2025-07-09 15-25-26](https://github.com/user-attachments/assets/0cb28ede-75bb-4a12-a98d-15230e7b3018)
![Screenshot from 2025-07-09 15-26-38](https://github.com/user-attachments/assets/39f41667-2044-4fe5-af94-27009af0b0ef)

# Camargu - Social Photo Sharing Platform

Camargu is a web-based social media platform where users can share photos, interact with posts through likes and comments, and discover content from other users. Built with PHP and MariaDB, containerized with Docker for easy deployment.

## 🌟 Features

- **User Authentication**: Secure registration, login, and password reset with email verification
- **Photo Sharing**: Upload and share images with the community
- **Camera Integration**: Take photos directly through the web interface
- **Social Interaction**: Like and comment on posts
- **User Profiles**: Customize your profile and view other users' profiles
- **Gallery View**: Browse through all shared photos
- **Email Notifications**: Automated email system for account verification and password resets
- **Responsive Design**: Modern and beautiful UI that works on all devices

## 🏗️ Architecture

The project uses a containerized architecture with the following services:

- **Web Server**: Nginx with PHP-FPM for serving the application
- **Database**: MariaDB for data persistence
- **Mail Service**: MailHog for email testing and development
- **Database Admin**: Adminer for database management

## 📋 Prerequisites

Before you begin, ensure you have the following installed on your system:

- [Docker](https://docs.docker.com/get-docker/) (version 20.10 or higher)
- [Docker Compose](https://docs.docker.com/compose/install/) (version 2.0 or higher)
- Git

### Installing Docker

#### On Ubuntu/Debian:
```bash
# Update package index
sudo apt update

# Install Docker
sudo apt update
sudo apt install docker-ce docker-ce-cli containerd.io docker-compose-plugin

# Add user to docker group (optional, to run docker without sudo)
sudo usermod -aG docker $USER
```

#### On CentOS/RHEL:
```bash
# Install required packages
sudo yum install -y yum-utils

# Add Docker repository
sudo yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo

# Install Docker
sudo yum install docker-ce docker-ce-cli containerd.io docker-compose-plugin

# Start and enable Docker
sudo systemctl start docker
sudo systemctl enable docker
```

#### On macOS:
Download and install [Docker Desktop for Mac](https://docs.docker.com/desktop/install/mac-install/)

#### On Windows:
Download and install [Docker Desktop for Windows](https://docs.docker.com/desktop/install/windows-install/)

## 🚀 Installation & Setup

1. **Clone the repository**:
   ```bash
   git clone <repository-url>
   cd Camargu_1337
   ```

2. **Create environment file**:
   Create a `.env_file` in the project root with the following content:
   ```env
   # Database Configuration
   DB_HOST=mariadb
   DB_USER=your_db_user
   DB_PASS=your_db_password
   DB_NAME=camargu_db
   DB_CHARSET=utf8mb4
   ```

3. **Set up the MariaDB data directory**:
   To persist data on local even down the containers.(Optional)
   ```bash
   # Create the directory with proper permissions
   mkdir -p backend/mariadb_data
   sudo chown -R 999:999 backend/mariadb_data
   ```

4. **Build and start the containers**:
   ```bash
   # Build and start all services
   docker-compose up --build
   
   # Or run in background
   docker-compose up --build -d
   ```

5. **Access the application**:
   - **Main Application**: http://localhost:8000
   - **MailHog (Email Testing)**: http://localhost:8025
   - **Adminer (Database Admin)**: http://localhost:8080

## 🛠️ Development

### Project Structure

```
Camargu_1337/
├── backend/                    # PHP application code
│   ├── actions/               # Form processing scripts
│   ├── config/                # Database and session configuration
│   ├── controllers/           # Business logic controllers
│   ├── models/                # Data models
│   ├── public/                # Static assets and uploads
│   ├── utils/                 # Utility functions and middleware
│   ├── view/                  # HTML templates and views
│   └── vendor/                # Composer dependencies
├── mariadb/                   # MariaDB configuration
├── nginx/                     # Nginx and PHP-FPM configuration
├── docker-compose.yml         # Docker services configuration
└── mail.ini                   # PHP mail configuration
```

### Available Services

- **web**: Main application container (Nginx + PHP-FPM)
- **mariadb**: Database container (MariaDB)
- **mailhog**: Email testing service
- **adminer**: Database administration interface

### Common Docker Commands

```bash
# View running containers
docker-compose ps

# View logs
docker-compose logs

# View logs for specific service
docker-compose logs web

# Stop all services
docker-compose down

# Rebuild and restart
docker-compose down && docker-compose up --build

# Execute commands in containers
docker-compose exec web bash
docker-compose exec mariadb mysql -u root -p

# Remove all containers and volumes
docker-compose down -v
```

## 🔧 Configuration

### Database Setup

The database is automatically initialized when the MariaDB container starts. The application will create the necessary tables on first run.

### Email Configuration

Email functionality uses MailHog for development. In production, update the `mail.ini` file with your SMTP settings.

### File Uploads

User uploaded images are stored in `backend/public/users_pictures/`. Ensure this directory has proper write permissions.

## 🐛 Troubleshooting

### Common Issues

1. **Permission Denied Errors**:
   ```bash
   sudo chown -R 999:999 backend/mariadb_data
   sudo chmod -R 755 backend/public/users_pictures
   ```

2. **Database Connection Issues**:
   - Verify the `.env_file` configuration
   - Check if MariaDB container is running: `docker-compose ps`
   - Check MariaDB logs: `docker-compose logs mariadb`

3. **Port Conflicts**:
   If ports 8000, 3306, 8025, or 8080 are already in use, modify the port mappings in `docker-compose.yml`

4. **Container Build Issues**:
   ```bash
   # Clean rebuild
   docker-compose down
   docker system prune -f
   docker-compose up --build
   ```

### Viewing Logs

```bash
# All services
docker-compose logs

# Specific service
docker-compose logs mariadb
docker-compose logs web

# Follow logs in real-time
docker-compose logs -f
```

## 🧪 Testing

To test email functionality:
1. Trigger an email action in the application (registration, password reset)
2. Open MailHog at http://localhost:8025
3. View the captured emails

## 📝 API Endpoints

The application provides several endpoints for different functionalities:

- `/backend/` - Main application entry point
- `/backend/view/login.php` - User login
- `/backend/view/register.php` - User registration
- `/backend/view/gallery.php` - Photo gallery
- `/backend/view/camera.php` - Camera interface
- `/backend/view/profile.php` - User profile

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature-name`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin feature-name`
5. Submit a pull request

## 📄 License

This project is part of the 42 School curriculum and is intended for educational purposes.

## 📞 Support

If you encounter any issues or have questions, please check the troubleshooting section above or create an issue in the repository.
