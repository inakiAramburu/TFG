.PHONY: help start stop rm reset-all-containers hard-reset rm-all reset-all-containers conect-django start- stop- rm- rmi- reset- conect- tests showmigrations migrate check-code logs
.DEFAULT_GOAL := help






CONTAINER_NAME := tfg-gateway-api.tfg.test
IMAGE_NAME := image-tfg-gateway-api



## api-gateway
start:                                                    ## Start containers
	@docker compose up -d $(CONTAINER_NAME)
	@echo "API Gateway started at http://localhost:9880/"
	@echo "API Gateway started at https://localhost:9440/"

stop:                                                    ## Stop containers
	@docker stop $(CONTAINER_NAME)

rm:                                                    ## Delete containers 
	@docker stop $(CONTAINER_NAME)
	@docker rm $(CONTAINER_NAME)

rmi:													## Delete image 
	@docker image rm $(IMAGE_NAME)
subir:
	@docker build -t europe-west1-docker.pkg.dev/tfg-naru/tfgrepo/image-api-gateway-tfg-develop:51.0.0 -f devops/dockerfile-qa . 
	@docker push europe-west1-docker.pkg.dev/tfg-naru/tfgrepo/image-api-gateway-tfg-develop:51.0.0

desplegar_en_kube:
	@kubectl create secret tls gateway-cert-name     --cert=devops/apache/certs/cert-pro.pem     --key=devops/apache/certs/key-pro.pem
	@kubecolor apply -f devops/pods/gatewayApi-deployment-service-ingress.yaml


reset:                                                    ## Reset (rm container, rmi image, start container)
	@make rm
	@make rmi
	@make start


conect:                                                    ## Connect to container
	@docker exec -it $(CONTAINER_NAME) /bin/bash


help:                                                       ## Show help
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'





export HELP