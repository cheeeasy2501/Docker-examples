CURRENT_ID=$([[ $(id -u) -gt 9999 ]] && echo "root" || id -u)
CURRENT_GROUP=$([[ $(id -g) -gt 9999 ]] && echo "root" || id -g)

DC := CURRENT_USER=${CURRENT_ID}:${CURRENT_GROUP} docker-compose

build:
	@$(DC) build

start:
	@$(DC) up -d

stop:
	@$(DC) down

restart:
    @$(DC) restart

deploy: build start
