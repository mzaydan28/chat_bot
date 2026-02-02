#!/usr/bin/env powershell
# Chatbot Auto Startup Script

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "   CHATBOT - AUTO STARTUP" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Function untuk cek apakah service sudah running
function Test-ServiceRunning {
    param([string]$ProcessName)
    return (Get-Process $ProcessName -ErrorAction SilentlyContinue) -ne $null
}

# 1. Start Apache
Write-Host "[1/5] Checking Apache..." -ForegroundColor Yellow
if (Test-ServiceRunning "httpd") {
    Write-Host "✓ Apache sudah running" -ForegroundColor Green
} else {
    Write-Host "Starting Apache..." -ForegroundColor Yellow
    Start-Process "C:\xampp\apache_start.bat" -WindowStyle Hidden
    Start-Sleep -Seconds 3
}

# 2. Start MySQL
Write-Host "[2/5] Checking MySQL..." -ForegroundColor Yellow
if (Test-ServiceRunning "mysqld") {
    Write-Host "✓ MySQL sudah running" -ForegroundColor Green
} else {
    Write-Host "Starting MySQL..." -ForegroundColor Yellow
    Start-Process "C:\xampp\mysql_start.bat" -WindowStyle Hidden
    Start-Sleep -Seconds 3
}

# 3. Wait untuk services startup
Write-Host ""
Write-Host "[3/5] Waiting for services to stabilize..." -ForegroundColor Yellow
Start-Sleep -Seconds 5

# 4. Check dan setup database
Write-Host "[4/5] Checking database..." -ForegroundColor Yellow

$mysqlPath = "C:\xampp\mysql\bin\mysql.exe"
$dbCheckCmd = '& "$mysqlPath" -u root -e "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME=''chatbot_db'';" 2>$null'

$dbExists = Invoke-Expression $dbCheckCmd | Select-String "chatbot_db"

if ($dbExists) {
    Write-Host "✓ Database chatbot_db sudah ada" -ForegroundColor Green
} else {
    Write-Host "Creating database chatbot_db..." -ForegroundColor Yellow
    
    if (Test-Path "C:\xampp\htdocs\Chatbot\db\create_tables.sql") {
        & $mysqlPath -u root < "C:\xampp\htdocs\Chatbot\db\create_tables.sql" 2>$null
        Write-Host "✓ Database berhasil dibuat" -ForegroundColor Green
    } elseif (Test-Path "C:\xampp\htdocs\Chatbot\db\chatbot_db.sql") {
        & $mysqlPath -u root < "C:\xampp\htdocs\Chatbot\db\chatbot_db.sql" 2>$null
        Write-Host "✓ Database berhasil dibuat" -ForegroundColor Green
    } else {
        Write-Host "⚠ File SQL tidak ditemukan. Buat database secara manual." -ForegroundColor Red
    }
}

# 5. Open browser
Write-Host ""
Write-Host "[5/5] Opening application in browser..." -ForegroundColor Yellow
Start-Sleep -Seconds 2

Start-Process "http://localhost/Chatbot/"

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "✓ SETUP COMPLETE!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "Aplikasi chatbot siap digunakan" -ForegroundColor Green
Write-Host "URL: http://localhost/Chatbot/" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
