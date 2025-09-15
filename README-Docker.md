# WebGame Docker Setup

## Quick Start

### 1. Clone và setup
```bash
git clone <your-repo>
cd webgame
```

### 2. Copy environment file
```bash
cp env.example .env
```

### 3. Chạy Docker
```bash
# Build và start containers
docker-compose up -d

# Hoặc build lại nếu có thay đổi
docker-compose up -d --build
```

### 4. Truy cập ứng dụng
- **Website**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081
- **MySQL**: localhost:3306

## Services

### Web Server (PHP 8.2 + Apache)
- **Port**: 8080
- **Container**: webgame_php
- **Features**: 
  - PHP 8.2 với Apache
  - Extensions: mysqli, PDO, GD, sockets
  - Composer support

### MySQL Database
- **Port**: 3306
- **Container**: webgame_mysql
- **Database**: thaodragon
- **User**: admin / admin
- **Root**: root / root

### phpMyAdmin
- **Port**: 8081
- **Container**: webgame_phpmyadmin
- **Auto-configured** để kết nối MySQL

## Environment Variables

Tạo file `.env` từ `env.example`:

```bash
# Database Configuration
DB_HOST=mysql
DB_USER=admin
DB_PASS=admin
DB_NAME=thaodragon
DB_PORT=3306

# Application Configuration
APP_ENV=development
APP_DEBUG=true
APP_DOMAIN=http://localhost:8080
```

## Commands

```bash
# Start services
docker-compose up -d

# Stop services
docker-compose down

# View logs
docker-compose logs -f

# Rebuild containers
docker-compose up -d --build

# Access MySQL CLI
docker-compose exec mysql mysql -u admin -p thaodragon

# Access PHP container
docker-compose exec web bash
```

## Database Setup

1. Truy cập phpMyAdmin: http://localhost:8081
2. Import các file SQL từ thư mục `sql/`:
   - `account.sql`
   - `adminpanel.sql`
   - `mbbank_log.sql`
   - `momo_trans.sql`
   - `momo.sql`
   - `trans_log.sql`

## Troubleshooting

### Port conflicts
Nếu port 8080, 8081, hoặc 3306 đã được sử dụng, sửa trong `docker-compose.yml`:

```yaml
ports:
  - "8080:80"  # Thay 8080 thành port khác
```

### Permission issues
```bash
sudo chown -R $USER:$USER .
```

### Database connection issues
Kiểm tra logs:
```bash
docker-compose logs mysql
docker-compose logs web
```
