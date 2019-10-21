d-up: memory
	sudo docker-compose up -d

d-down:
	sudo docker-compose down

d-build: memory
	sudo docker-compose up --build -d

memory:
	sudo sysctl -w vm.max_map_count=262144
