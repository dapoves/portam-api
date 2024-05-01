@echo off

rem Ruta al directorio de instalación de XAMPP
set XAMPP_PATH="C:\XAMPP"

rem Comando para iniciar MySQL
%XAMPP_PATH%\mysql_start.bat

rem Comando para iniciar Apache
%XAMPP_PATH%\apache_start.bat
