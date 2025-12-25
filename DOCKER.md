# Docker Setup for luksplace.com

This project is fully dockerized with separate configurations for development and production environments.

## Quick Start

### Development Environment
```bash
# Start development environment with live reload
./docker.sh dev

# Or start in background
./docker.sh dev-bg
```

The development environment will be available at: http://localhost:8080

### Production Environment
```bash
# Build and start production environment
./docker.sh prod
```

The production environment will be available at: http://localhost

## Docker Commands

Use the provided script for easy management:

```bash
./docker.sh [command]
```

Available commands:
- `dev` - Start development environment (with live reload)
- `dev-bg` - Start development environment in background
- `prod` - Start production environment
- `stop` - Stop all containers
- `restart` - Restart development environment
- `logs` - Show container logs
- `clean` - Clean up Docker resources
- `shell` - Open shell in development container

## Architecture

### Development Environment
- **PHP 8.2 + Apache** - Main web server
- **Node.js 18** - For Tailwind CSS compilation with watch mode
- **Volume mounts** - Live code reloading without rebuilding containers
- **Port 8080** - To avoid conflicts with local services

### Production Environment
- **Multi-stage build** - Optimized for size and security
- **Pre-compiled CSS** - Tailwind CSS built during Docker build
- **Minimal runtime** - Only PHP, Apache, and application code
- **Port 80** - Standard web server port

## File Structure

```
├── Dockerfile              # Production build
├── Dockerfile.dev         # Development build
├── docker-compose.yml     # Container orchestration
├── docker.sh             # Management script
├── .dockerignore         # Docker build exclusions
└── docker/
    ├── apache.conf        # Production Apache config
    └── apache-dev.conf    # Development Apache config
```

## Development Workflow

1. **Start development environment**:
   ```bash
   ./docker.sh dev
   ```

2. **CSS changes are automatically compiled** - The css-watch service monitors `app/source.css`

3. **PHP changes are immediately visible** - Files are mounted as volumes

4. **View logs**:
   ```bash
   ./docker.sh logs
   ```

5. **Access container shell**:
   ```bash
   ./docker.sh shell
   ```

## Production Deployment

1. **Build and start**:
   ```bash
   ./docker.sh prod
   ```

2. **The production build**:
   - Compiles and minifies CSS during build
   - Creates optimized container image
   - Runs with minimal privileges
   - Includes proper error handling

## Environment Variables

No environment variables are required for basic operation. The containers are configured to work out of the box.

## Volumes and Persistence

### Development
- Source code: Live mounted for instant changes
- Logs: Persisted to `./app/logs`

### Production
- Logs: Persisted to `./app/logs`
- Database: Persisted to `./app/database.sqlite` (if using SQLite features)

## Troubleshooting

### Port Conflicts
If port 8080 (dev) or 80 (prod) are in use, modify `docker-compose.yml`:
```yaml
ports:
  - "8081:80"  # Change 8080 to 8081 for development
```

### Permission Issues
```bash
# Fix file permissions
sudo chown -R $USER:$USER ./app/logs
chmod 777 ./app/logs
```

### Clean Start
```bash
# Remove all containers and start fresh
./docker.sh clean
./docker.sh dev
```

### View Container Status
```bash
docker ps
docker-compose ps
```