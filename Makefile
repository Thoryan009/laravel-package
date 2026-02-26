# ===== Docker Compose Helpers =====

up:
	docker compose up -d

build:
	docker compose build

rebuild:
	docker compose down
	docker compose up -d --build

down:
	docker compose down

restart:
	docker compose down
	docker compose up

restart-d:
	docker compose down
	docker compose up -d

logs:
	docker compose logs -f

ps:
	docker compose ps


# ===== Container Shell =====

backend:
	docker exec -it sb_backend sh

mysql:
	docker exec -it sb_mysql mysql -uroot -p1234


# ===== Laravel Helpers =====

artisan:
	docker exec -it sb_backend php artisan $(cmd)

migrate:
	docker exec -it sb_backend php artisan migrate

seed:
	docker exec -it sb_backend php artisan db:seed

fresh:
	docker exec -it sb_backend php artisan migrate:fresh --seed

tinker:
	docker exec -it sb_backend php artisan tinker

# ===== Redis Helpers =====

redis:
	docker exec -it sb_redis redis-cli -n 1



# ===== Composer =====

composer:
	docker exec -it sb_backend composer $(cmd)


# ===== NPM (if needed) =====

npm:
	docker exec -it sb_frontend npm $(cmd)
