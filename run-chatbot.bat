@echo off
setlocal enabledelayedexpansion

echo ========================================
echo   CHATBOT - AUTO STARTUP
echo ========================================
echo.

REM Check jika XAMPP sudah running
echo [1/5] Checking XAMPP services...
tasklist | findstr /i "httpd.exe" >nul
if %errorlevel% neq 0 (
    echo Starting Apache...
    start "" "C:\xampp\apache_start.bat"
    timeout /t 3 /nobreak
) else (
    echo Apache sudah running
)

tasklist | findstr /i "mysqld.exe" >nul
if %errorlevel% neq 0 (
    echo Starting MySQL...
    start "" "C:\xampp\mysql_start.bat"
    timeout /t 3 /nobreak
) else (
    echo MySQL sudah running
)

echo.
echo [2/5] Waiting for services to start...
timeout /t 5 /nobreak

REM Check dan setup database jika belum ada
echo.
echo [3/5] Checking database...
cd /d "C:\xampp\mysql\bin"
mysql -u root -e "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME='chatbot_db';" >nul 2>&1

if %errorlevel% neq 0 (
    echo Database chatbot_db tidak ditemukan. Membuat database...
    cd /d "C:\xampp\htdocs\Chatbot\db"
    
    REM Coba setup dari file SQL
    if exist create_tables.sql (
        mysql -u root < create_tables.sql
        echo Database berhasil dibuat dari create_tables.sql
    ) else if exist chatbot_db.sql (
        mysql -u root < chatbot_db.sql
        echo Database berhasil dibuat dari chatbot_db.sql
    ) else (
        echo PERINGATAN: File SQL tidak ditemukan. Buat database secara manual.
    )
) else (
    echo Database chatbot_db sudah ada
)

echo.
echo [4/5] Opening application in browser...
timeout /t 2 /nobreak

REM Open browser
start http://localhost/Chatbot/

echo.
echo [5/5] SETUP COMPLETE!
echo ========================================
echo Aplikasi chatbot siap digunakan
echo URL: http://localhost/Chatbot/
echo ========================================
echo.
pause
