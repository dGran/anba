# Definir variables
DOCKER_COMPOSE = docker-compose
COMPOSE_FILE = -f docker-compose.yml

# Construir los contenedores
build:
	$(DOCKER_COMPOSE) $(COMPOSE_FILE) up --build -d

# Levantar los contenedores
up:
	$(DOCKER_COMPOSE) $(COMPOSE_FILE) up -d

# Detener los contenedores sin eliminar los volúmenes
down:
	$(DOCKER_COMPOSE) $(COMPOSE_FILE) down

# Detener los contenedores sin eliminarlos
stop:
	$(DOCKER_COMPOSE) $(COMPOSE_FILE) stop

# Detener y eliminar los contenedores, redes y volúmenes
clean:
	$(DOCKER_COMPOSE) $(COMPOSE_FILE) down -v

# Ver los logs de todos los contenedores
logs:
	$(DOCKER_COMPOSE) $(COMPOSE_FILE) logs -f

# Ejecutar comandos dentro del contenedor de la aplicación
connect:
	$(DOCKER_COMPOSE) $(COMPOSE_FILE) exec app bash

# Construir los contenedores sin iniciar
build-no-start:
	$(DOCKER_COMPOSE) $(COMPOSE_FILE) build
