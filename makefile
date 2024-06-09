rollback:
	php artisan migrate:rollback

refresh:
	php artisan migrate:refresh

seed:
	php artisan db:seed

dev:
	@make rollback
	@make refresh
	@make seed
