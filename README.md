## Docker Setup (Recommended)

The easiest way to run this project is using Docker. See [DOCKER.md](DOCKER.md) for detailed instructions.

### Quick Start with Docker

1. **Install Docker and Docker Compose** (if not already installed)

2. **Start development environment**:
   ```bash
   make dev
   # or
   ./docker.sh dev
   ```

3. **Visit your site**: http://localhost:8080

### Docker Commands

Using Makefile:
```bash
make dev      # Start development environment
make prod     # Start production environment  
make stop     # Stop all containers
make logs     # View logs
make clean    # Clean up resources
make shell    # Open container shell
```

Using the script:
```bash
./docker.sh dev    # Development mode
./docker.sh prod   # Production mode
./docker.sh stop   # Stop containers
```

## Local Development (Alternative)

Apache/httpd or other web servers should also work. Have fun!