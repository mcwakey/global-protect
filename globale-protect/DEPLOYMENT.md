# Globale Protect - Deployment Guide

## Table of Contents
1. [Prerequisites](#prerequisites)
2. [Server Requirements](#server-requirements)
3. [Local Development Setup](#local-development-setup)
4. [Production Deployment](#production-deployment)
5. [Database Setup](#database-setup)
6. [Environment Configuration](#environment-configuration)
7. [SSL Certificate Setup](#ssl-certificate-setup)
8. [Performance Optimization](#performance-optimization)
9. [Monitoring and Maintenance](#monitoring-and-maintenance)
10. [Troubleshooting](#troubleshooting)
11. [Backup Strategy](#backup-strategy)

---

## Prerequisites

Before deploying Globale Protect, ensure you have the following:

### Required Software
- **PHP 8.1+** with required extensions
- **Composer** (dependency manager)
- **Node.js 18+** and **npm/yarn** (for asset compilation)
- **Web Server** (Apache/Nginx)
- **Database** (MySQL 8.0+, PostgreSQL 13+, or SQLite)
- **Git** (for version control)

### PHP Extensions Required
```bash
# Check required extensions
php -m | grep -E "(pdo|pdo_mysql|pdo_pgsql|mbstring|tokenizer|xml|ctype|json|bcmath|fileinfo|openssl|curl|zip|gd)"
```

Required extensions:
- PDO (with MySQL/PostgreSQL drivers)
- Mbstring
- Tokenizer
- XML
- Ctype
- JSON
- BCMath
- Fileinfo
- OpenSSL
- cURL
- Zip
- GD (for image processing)

---

## Server Requirements

### Minimum System Requirements
- **CPU**: 2 cores
- **RAM**: 2GB (4GB recommended for production)
- **Storage**: 10GB SSD
- **Network**: 100 Mbps connection

### Recommended Production Requirements
- **CPU**: 4+ cores
- **RAM**: 8GB+
- **Storage**: 50GB+ SSD
- **Network**: 1 Gbps connection
- **Load Balancer**: For high availability

---

## Local Development Setup

### 1. Clone Repository
```bash
git clone https://github.com/yourusername/globale-protect.git
cd globale-protect
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup
```bash
# Create database and run migrations
php artisan migrate

# Seed database with initial data
php artisan db:seed
```

### 5. Build Assets
```bash
# Development build
npm run dev

# Watch for changes during development
npm run watch

# Production build
npm run build
```

### 6. Start Development Server
```bash
php artisan serve
```

Access the application at: `http://localhost:8000`

---

## Production Deployment

### Option 1: Manual Deployment

#### 1. Server Preparation
```bash
# Update system packages
sudo apt update && sudo apt upgrade -y

# Install required packages
sudo apt install -y nginx mysql-server php8.1-fpm php8.1-mysql php8.1-xml php8.1-gd php8.1-curl php8.1-zip php8.1-mbstring php8.1-tokenizer php8.1-bcmath php8.1-fileinfo composer nodejs npm git certbot python3-certbot-nginx
```

#### 2. Deploy Application
```bash
# Create application directory
sudo mkdir -p /var/www/globale-protect
cd /var/www/globale-protect

# Clone repository
sudo git clone https://github.com/yourusername/globale-protect.git .

# Set ownership
sudo chown -R www-data:www-data /var/www/globale-protect
sudo chmod -R 755 /var/www/globale-protect

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install --production
npm run build

# Set permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

#### 3. Database Configuration
```bash
# Create database
sudo mysql -u root -p
```

```sql
CREATE DATABASE globale_protect;
CREATE USER 'globale_protect'@'localhost' IDENTIFIED BY 'your_secure_password';
GRANT ALL PRIVILEGES ON globale_protect.* TO 'globale_protect'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

#### 4. Environment Setup
```bash
# Copy and configure environment
cp .env.example .env
nano .env
```

### Option 2: Docker Deployment

#### 1. Create Dockerfile
```dockerfile
FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . .

# Install dependencies
RUN composer install --optimize-autoloader --no-dev
RUN npm install --production
RUN npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
```

#### 2. Docker Compose Configuration
```yaml
version: '3.8'

services:
  app:
    build: .
    container_name: globale-protect-app
    restart: unless-stopped
    working_dir: /var/www
    volumes:
      - ./:/var/www
      - ./docker/php/local.ini:/usr/local/etc/php/conf.d/local.ini
    networks:
      - globale-protect

  webserver:
    image: nginx:alpine
    container_name: globale-protect-webserver
    restart: unless-stopped
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - ./:/var/www
      - ./docker/nginx/conf.d/:/etc/nginx/conf.d/
      - ./docker/nginx/ssl/:/etc/nginx/ssl/
    networks:
      - globale-protect

  database:
    image: mysql:8.0
    container_name: globale-protect-db
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: globale_protect
      MYSQL_ROOT_PASSWORD: root_password
      MYSQL_PASSWORD: user_password
      MYSQL_USER: globale_protect
    volumes:
      - dbdata:/var/lib/mysql
    networks:
      - globale-protect

  redis:
    image: redis:alpine
    container_name: globale-protect-redis
    restart: unless-stopped
    networks:
      - globale-protect

volumes:
  dbdata:
    driver: local

networks:
  globale-protect:
    driver: bridge
```

### Option 3: Cloud Deployment (AWS/DigitalOcean/Google Cloud)

#### AWS Elastic Beanstalk
```bash
# Install EB CLI
pip install awsebcli

# Initialize Elastic Beanstalk
eb init

# Create environment
eb create production

# Deploy
eb deploy
```

#### DigitalOcean App Platform
```yaml
# .do/app.yaml
name: globale-protect
services:
- name: web
  source_dir: /
  github:
    repo: yourusername/globale-protect
    branch: main
  run_command: |
    composer install --optimize-autoloader --no-dev
    npm install --production
    npm run build
    php artisan migrate --force
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
  environment_slug: php
  instance_count: 1
  instance_size_slug: basic-xxs
  http_port: 8080
  routes:
  - path: /
databases:
- name: db
  engine: MYSQL
  version: "8"
  size: db-s-1vcpu-1gb
```

---

## Database Setup

### 1. Environment Configuration
```bash
# Edit .env file
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=globale_protect
DB_USERNAME=globale_protect
DB_PASSWORD=your_secure_password
```

### 2. Run Migrations and Seeders
```bash
# Run migrations
php artisan migrate --force

# Seed database
php artisan db:seed --force

# Create admin user (if not seeded)
php artisan tinker
```

```php
// In tinker console
User::factory()->create([
    'name' => 'Admin User',
    'email' => 'admin@globaleprotect.com',
    'password' => bcrypt('your_secure_password')
]);
```

---

## Environment Configuration

### Production .env Template
```env
APP_NAME="Globale Protect"
APP_ENV=production
APP_KEY=base64:your_generated_key_here
APP_DEBUG=false
APP_URL=https://yourdomain.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=globale_protect
DB_USERNAME=globale_protect
DB_PASSWORD=your_secure_password

BROADCAST_DRIVER=log
CACHE_DRIVER=redis
FILESYSTEM_DISK=local
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@globaleprotect.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```

### Security Configuration
```bash
# Generate application key
php artisan key:generate

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Clear caches when needed
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

---

## SSL Certificate Setup

### Using Let's Encrypt (Recommended)
```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx

# Obtain SSL certificate
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

# Set up automatic renewal
sudo crontab -e
# Add line: 0 12 * * * /usr/bin/certbot renew --quiet
```

### Manual SSL Certificate
```bash
# Generate CSR
openssl req -new -newkey rsa:2048 -nodes -keyout yourdomain.key -out yourdomain.csr

# Install certificate files
sudo cp yourdomain.crt /etc/ssl/certs/
sudo cp yourdomain.key /etc/ssl/private/
sudo chmod 600 /etc/ssl/private/yourdomain.key
```

---

## Performance Optimization

### 1. Caching Configuration
```bash
# Enable OPcache
sudo nano /etc/php/8.1/fpm/php.ini
```

```ini
opcache.enable=1
opcache.enable_cli=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=4000
opcache.revalidate_freq=60
opcache.validate_timestamps=0
```

### 2. Laravel Optimization
```bash
# Production optimizations
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
php artisan queue:restart
```

### 3. Database Optimization
```sql
-- Create indexes for better performance
CREATE INDEX idx_legal_pages_type ON legal_pages(type);
CREATE INDEX idx_legal_pages_active ON legal_pages(is_active);
CREATE INDEX idx_sections_type ON sections(type);
CREATE INDEX idx_sections_active ON sections(is_active);
```

### 4. Web Server Configuration

#### Nginx Configuration
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name yourdomain.com www.yourdomain.com;
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/globale-protect/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    add_header X-XSS-Protection "1; mode=block";
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains";

    index index.php;

    charset utf-8;

    # SSL Configuration
    ssl_certificate /etc/letsencrypt/live/yourdomain.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/yourdomain.com/privkey.pem;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers ECDHE-RSA-AES256-GCM-SHA512:DHE-RSA-AES256-GCM-SHA512:ECDHE-RSA-AES256-GCM-SHA384:DHE-RSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-SHA384;
    ssl_prefer_server_ciphers off;

    # Gzip Configuration
    gzip on;
    gzip_vary on;
    gzip_min_length 1024;
    gzip_comp_level 6;
    gzip_types text/plain text/css application/json application/javascript text/xml application/xml application/xml+rss text/javascript;

    # Cache static assets
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
        add_header Vary Accept-Encoding;
    }

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

---

## Monitoring and Maintenance

### 1. Log Monitoring
```bash
# Monitor Laravel logs
tail -f storage/logs/laravel.log

# Monitor Nginx logs
sudo tail -f /var/log/nginx/error.log
sudo tail -f /var/log/nginx/access.log

# Monitor PHP-FPM logs
sudo tail -f /var/log/php8.1-fpm.log
```

### 2. Health Check Script
```bash
#!/bin/bash
# health-check.sh

APP_URL="https://yourdomain.com"
LOG_FILE="/var/log/health-check.log"

# Check if application is responding
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" $APP_URL)

if [ $HTTP_CODE -eq 200 ]; then
    echo "$(date): Application is healthy" >> $LOG_FILE
else
    echo "$(date): Application is down (HTTP $HTTP_CODE)" >> $LOG_FILE
    # Send alert (email/slack notification)
fi

# Check database connection
php artisan tinker --execute="DB::connection()->getPdo();"
if [ $? -eq 0 ]; then
    echo "$(date): Database connection is healthy" >> $LOG_FILE
else
    echo "$(date): Database connection failed" >> $LOG_FILE
fi
```

### 3. Automated Backups
```bash
#!/bin/bash
# backup.sh

TIMESTAMP=$(date +"%Y%m%d_%H%M%S")
BACKUP_DIR="/var/backups/globale-protect"
DB_NAME="globale_protect"
DB_USER="globale_protect"
DB_PASSWORD="your_password"

# Create backup directory
mkdir -p $BACKUP_DIR

# Database backup
mysqldump -u $DB_USER -p$DB_PASSWORD $DB_NAME > $BACKUP_DIR/database_$TIMESTAMP.sql

# Files backup
tar -czf $BACKUP_DIR/files_$TIMESTAMP.tar.gz -C /var/www/globale-protect storage public/storage

# Clean old backups (keep last 7 days)
find $BACKUP_DIR -name "*.sql" -mtime +7 -delete
find $BACKUP_DIR -name "*.tar.gz" -mtime +7 -delete
```

### 4. Cron Jobs
```bash
# Edit crontab
sudo crontab -e

# Add cron jobs
# Laravel scheduler
* * * * * cd /var/www/globale-protect && php artisan schedule:run >> /dev/null 2>&1

# Daily backup
0 2 * * * /path/to/backup.sh

# Health check every 5 minutes
*/5 * * * * /path/to/health-check.sh

# Clear logs weekly
0 0 * * 0 cd /var/www/globale-protect && php artisan log:clear
```

---

## Troubleshooting

### Common Issues

#### 1. Permission Issues
```bash
# Fix storage permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

#### 2. 500 Internal Server Error
```bash
# Check Laravel logs
tail -f storage/logs/laravel.log

# Check web server logs
sudo tail -f /var/log/nginx/error.log

# Clear caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

#### 3. Database Connection Issues
```bash
# Test database connection
php artisan tinker
DB::connection()->getPdo();

# Check database credentials in .env
cat .env | grep DB_
```

#### 4. Asset Loading Issues
```bash
# Rebuild assets
npm run build

# Check public directory permissions
ls -la public/
```

### Debug Mode
```bash
# Enable debug mode temporarily
php artisan down --message="Maintenance Mode"
# Edit .env: APP_DEBUG=true
php artisan config:clear
# Test and fix issues
# Edit .env: APP_DEBUG=false
php artisan config:cache
php artisan up
```

---

## Backup Strategy

### 1. Automated Database Backups
```bash
# Create backup script
#!/bin/bash
DB_NAME="globale_protect"
DB_USER="globale_protect"
DB_PASSWORD="your_password"
BACKUP_DIR="/var/backups/globale-protect"
TIMESTAMP=$(date +"%Y%m%d_%H%M%S")

mkdir -p $BACKUP_DIR

# Full backup
mysqldump -u $DB_USER -p$DB_PASSWORD $DB_NAME > $BACKUP_DIR/full_backup_$TIMESTAMP.sql

# Compressed backup
mysqldump -u $DB_USER -p$DB_PASSWORD $DB_NAME | gzip > $BACKUP_DIR/backup_$TIMESTAMP.sql.gz

# Upload to cloud storage (optional)
# aws s3 cp $BACKUP_DIR/backup_$TIMESTAMP.sql.gz s3://your-backup-bucket/
```

### 2. File System Backups
```bash
# Backup important directories
tar -czf /var/backups/globale-protect/files_$(date +%Y%m%d_%H%M%S).tar.gz \
    /var/www/globale-protect/storage \
    /var/www/globale-protect/public/storage \
    /var/www/globale-protect/.env
```

### 3. Recovery Procedures
```bash
# Database recovery
mysql -u globale_protect -p globale_protect < backup_file.sql

# File recovery
tar -xzf files_backup.tar.gz -C /
```

---

## Security Checklist

- [ ] SSL certificate installed and configured
- [ ] Firewall configured (UFW/iptables)
- [ ] Database user has minimal required permissions
- [ ] Strong passwords for all accounts
- [ ] Regular security updates applied
- [ ] Backup strategy implemented
- [ ] Monitoring and alerting configured
- [ ] Error logging enabled
- [ ] Access logs monitored
- [ ] File permissions properly set
- [ ] Environment variables secured
- [ ] Debug mode disabled in production
- [ ] CSRF protection enabled
- [ ] XSS protection headers added
- [ ] Rate limiting configured

---

## Support

For deployment issues or questions:
- Check the Laravel documentation: https://laravel.com/docs
- Review application logs: `storage/logs/laravel.log`
- Contact the development team: dev@globaleprotect.com

---

*Last updated: July 4, 2025*
