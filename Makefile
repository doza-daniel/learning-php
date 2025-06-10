restart:
	docker compose down
	docker compose up -d

logs:
	docker compose logs nginx
