# Makefile for luksplace.com Docker management

.PHONY: help dev dev-bg prod stop stop-dev stop-prod restart logs clean shell build-dev build-prod

help: ## Show this help message
	@echo "Docker management for luksplace.com"
	@echo ""
	@echo "Usage: make [target]"
	@echo ""
	@echo "Targets:"
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "  %-15s %s\n", $$1, $$2}' $(MAKEFILE_LIST)
	@echo ""
	@echo "Development URL: http://localhost:8080"
	@echo "Production URL: http://localhost"

dev: ## Start development environment
	@echo "🚀 Starting development environment..."
	docker compose --profile dev up --build

dev-bg: ## Start development environment in background
	@echo "🚀 Starting development environment in background..."
	docker compose --profile dev up --build -d

prod: ## Start production environment
	@echo "🚀 Starting production environment..."
	docker compose --profile prod up --build -d

stop: ## Stop all containers
	@echo "🛑 Stopping all containers..."
	docker compose --profile dev --profile prod down

stop-dev: ## Stop development containers only
	@echo "🛑 Stopping development containers..."
	docker compose --profile dev down

stop-prod: ## Stop production containers only
	@echo "🛑 Stopping production containers..."
	docker compose --profile prod down

restart: ## Restart development environment
	@echo "🔄 Restarting development environment..."
	docker compose down
	docker compose --profile dev up --build -d

logs: ## Show container logs
	@echo "📋 Showing logs..."
	docker compose logs -f

clean: ## Clean up Docker resources
	@echo "🧹 Cleaning up Docker resources..."
	docker compose down
	docker system prune -f

shell: ## Open shell in development container
	@echo "🐚 Opening shell in development container..."
	docker compose --profile dev exec app-dev bash

build-dev: ## Build development image only
	@echo "🔨 Building development image..."
	docker build -f Dockerfile.dev -t luksplace:dev .

build-prod: ## Build production image only
	@echo "🔨 Building production image..."
	docker build -f Dockerfile -t luksplace:prod .