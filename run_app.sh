#!/bin/bash

usage() {
    echo "Usage: $0 [setup|start|stop|restart]"
    echo "    setup  - Set up the application"
    echo "    start  - Start the application"
    echo "    stop   - Stop the application"
    echo "    restart- Restart the application"
    exit 1
}

setup_app() {
    echo "Setting up the application..."

    composer install

    php artisan key:generate

    if [[ ! -f .env ]]; then
        cp .env.example .env
    fi

    sed -i 's/DB_CONNECTION=mysql/DB_CONNECTION=sqlite/g' .env
    sed -i 's/DB_HOST=127.0.0.1/DB_HOST=/' .env
    sed -i 's/DB_PORT=3306/DB_PORT=/' .env
    sed -i 's/DB_DATABASE=laravel/DB_DATABASE=database.sqlite/' .env
    sed -i 's/DB_USERNAME=root/DB_USERNAME=/' .env
    sed -i 's/DB_PASSWORD=/DB_PASSWORD=/' .env

    touch database/database.sqlite

    php artisan migrate --seed

    echo "Setting up the frontend application..."

    npm install
}

start_app() {
    echo "Starting the application..."
    php artisan serve

    npm run dev

}

stop_app() {
    echo "Stopping the application..."
    pkill -f "php artisan serve"

    pkill -f "npm run dev"
}

restart_app() {
    stop_app
    start_app
}

if [[ $# -ne 1 ]]; then
    usage
fi

case "$1" in
    setup)
        setup_app
        ;;
    start)
        start_app
        ;;
    stop)
        stop_app
        ;;
    restart)
        restart_app
        ;;
    *)
        usage
        ;;
esac

exit 0
