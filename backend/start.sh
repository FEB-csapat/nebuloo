#!/bin/sh -e

COMPOSE="docker compose"

if ! $($COMPOSE 2>/dev/null); then
    COMPOSE="docker-compose"
fi

if [ -f ".env" ]; then
    echo ".env fájl már létezik!"
else 
    cp .env.example .env
fi

if [ "$1" ]; then
  MODE=$1
else
  MODE=dev
fi

# shopt -s expand_aliases

$COMPOSE -f docker-compose.yml -f docker-compose.$MODE.yml -p nebuloo up -d
$COMPOSE -p nebuloo exec app composer install
$COMPOSE -p nebuloo exec app php artisan key:generate
$COMPOSE -p nebuloo exec app php artisan migrate:fresh --seed
$COMPOSE -p nebuloo exec app php artisan passport:client --personal
$COMPOSE -p nebuloo exec app php artisan passport:keys
$COMPOSE -p nebuloo exec app npm install