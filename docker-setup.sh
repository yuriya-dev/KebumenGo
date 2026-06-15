#!/bin/bash

echo "🐳 KebumenGo Docker Setup"
echo "========================"
echo ""

# Check if docker and docker-compose are installed
if ! command -v docker &> /dev/null; then
    echo "❌ Docker is not installed. Please install Docker first."
    exit 1
fi

if ! command -v docker-compose &> /dev/null; then
    echo "❌ Docker Compose is not installed. Please install Docker Compose first."
    exit 1
fi

echo "✅ Docker dan Docker Compose terdeteksi"
echo ""

# Start Docker containers
echo "🚀 Memulai Docker containers..."
docker-compose up -d

echo ""
echo "✅ Setup selesai!"
echo ""
echo "📍 Akses aplikasi di:"
echo "   - PHP App: http://localhost:8000"
echo "   - phpMyAdmin: http://localhost:8081"
echo ""
echo "🗄️  Informasi Database:"
echo "   - Host: mysql (atau localhost jika dari host)"
echo "   - User: user"
echo "   - Password: password"
echo "   - Database: kebumengo"
echo ""
echo "🔐 phpMyAdmin Login:"
echo "   - Username: user"
echo "   - Password: password"
echo ""
echo "⚠️  Untuk root access phpMyAdmin:"
echo "   - Username: root"
echo "   - Password: password"
echo ""
echo "💡 Useful commands:"
echo "   - docker-compose logs -f          (lihat logs)"
echo "   - docker-compose stop             (hentikan containers)"
echo "   - docker-compose down             (hapus containers)"
echo "   - docker-compose restart          (restart containers)"
