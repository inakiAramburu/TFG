.PHONY: help start stop rm reset-all-containers hard-reset rm-all reset-all-containers 
.DEFAULT_GOAL := help

CONTAINER_NAME := tfg-symptom-api.tfg.test
IMAGE_NAME := image-tfg-symptom-api





## symtom-api
start:                                                    ## Start containers
	@docker compose up -d $(CONTAINER_NAME)
	@echo "Symptom API started at http://localhost:9081/"
	@echo "Symptom API started at https://localhost:9041/"

stop:                                                    ## Stop containers
	@docker stop $(CONTAINER_NAME)

rm:                                                    ## Delete containers 
	@docker stop $(CONTAINER_NAME)
	@docker rm $(CONTAINER_NAME)

rmi:													## Delete image 
	@docker image rm $(IMAGE_NAME)



reset:                                                    ## Reset (rm container, rmi image, start container)
	@make rm
	@make rmi
	@make start

conect:                                                    ## Connect to container
	@docker exec -it $(CONTAINER_NAME) /bin/bash
subir:
	@docker build -t europe-west1-docker.pkg.dev/tfg-naru/tfgrepo/image-tfg-symptom-api-develop:5.0.0 -f devops/dockerfile-qa . 
	@docker push europe-west1-docker.pkg.dev/tfg-naru/tfgrepo/image-tfg-symptom-api-develop:5.0.0
desplegar_en_kube:
	@./devops/pods/secretsGenerator.sh
	@kubecolor apply -f devops/pods/secrets.yaml
	@rm devops/pods/secrets.yaml
	@kubecolor apply -f devops/pods/symptom-deployment-cip.yaml


help:                                                       ## Show help
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'





export HELP