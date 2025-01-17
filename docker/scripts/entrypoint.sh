#!/bin/bash

OS=$(uname -s)
case "$OS" in
    Linux*)
        echo "Detected Linux"
        source /docker-scripts/init-linux.sh
        ;;
    MINGW*|CYGWIN*)
        echo "Detected Windows"
        source /docker-scripts/init-windows.sh
        ;;
    *)
        echo "Unknown OS: $OS"
        exit 1
        ;;
esac

exec "$@"
