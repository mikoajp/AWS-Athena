#!/bin/bash
set -e

mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/cache
mkdir -p storage/logs
mkdir -p bootstrap/cache
chmod -R 777 storage
chmod -R 777 bootstrap/cache

find . -type f -name "*.php" -exec dos2unix {} \;
find . -type f -name "*.json" -exec dos2unix {} \;
find . -type f -name "*.sh" -exec dos2unix {} \;
