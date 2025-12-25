#!/bin/bash

# Docker management script for luksplace.com

case $1 in
  "dev")
    echo "🚀 Starting development environment..."
    docker compose --profile dev up --build
    ;;
  "dev-bg")
    echo "🚀 Starting development environment in background..."
    docker compose --profile dev up --build -d
    ;;
  "prod")
    echo "🚀 Starting production environment..."
    docker compose --profile prod up --build -d
    ;;
  "stop")
    echo "🛑 Stopping all containers..."
    docker compose down
    ;;
  "restart")
    echo "🔄 Restarting containers..."
    docker compose down && docker compose --profile dev up --build -d
    ;;
  "logs")
    echo "📋 Showing logs..."
    docker compose logs -f
    ;;
  "clean")
    echo "🧹 Cleaning up Docker resources..."
    docker compose down
    docker system prune -f
    ;;
  "shell")
    echo "🐚 Opening shell in development container..."
    docker compose --profile dev exec app-dev bash
    ;;
  *)
    echo "Docker management for luksplace.com"
    echo ""
    echo "Usage: ./docker.sh [command]"
    echo ""
    echo "Commands:"
    echo "  dev      - Start development environment (with live reload)"
    echo "  dev-bg   - Start development environment in background"
    echo "  prod     - Start production environment"
    echo "  stop     - Stop all containers"
    echo "  restart  - Restart development environment"
    echo "  logs     - Show container logs"
    echo "  clean    - Clean up Docker resources"
    echo "  shell    - Open shell in development container"
    echo ""
    echo "Development URL: http://localhost:8080"
    echo "Production URL: http://localhost"
    ;;
esac