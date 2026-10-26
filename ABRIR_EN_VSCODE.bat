@echo off
cd /d "%~dp0"
where code >nul 2>nul
if errorlevel 1 (
  echo No se encontro el comando code. Abre esta carpeta desde Visual Studio Code: Archivo ^> Abrir carpeta.
  pause
  exit /b 1
)
code .
