rollback:
	php artisan migrate:rollback

refresh:
	php artisan migrate:refresh

seed:
	php artisan db:seed

serve:
	php artisan serve

dev:
	@make rollback
	@make refresh
	@make seed
	@make serve
