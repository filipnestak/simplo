docker stop $(docker ps -a -q --filter "status=running")

docker-compose up -d --remove-orphans --build
