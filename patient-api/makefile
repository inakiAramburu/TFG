.PHONY: help start stop rm reset-all-containers hard-reset rm-all reset-all-containers 
.DEFAULT_GOAL := help

CONTAINER_NAME := tfg-patient-api.tfg.test
IMAGE_NAME := image-tfg-patient-api




reset-all-containers:                                                    ## Reset all containers
	@make reset




## Apache
start:                                                    ## Start containers
	@docker compose up -d $(CONTAINER_NAME)
	@echo "Patient API started at http://localhost:9080/"
	@echo "Patient API started at https://localhost:9040/"
stop:                                                    ## Stop containers
	@docker stop $(CONTAINER_NAME)

rm:                                                    ## Delete containers 
	@docker stop $(CONTAINER_NAME)
	@docker rm $(CONTAINER_NAME)

rmi:													
	@docker image rm $(IMAGE_NAME)

subir:
	@docker build -t europe-west1-docker.pkg.dev/tfg-naru/tfgrepo/image-tfg-patient-api-pipeline -f devops/dockerfile-qa . 
	@docker push europe-west1-docker.pkg.dev/tfg-naru/tfgrepo/image-tfg-patient-api-pipeline

desplegar_en_kube:

	@./devops/pods/secretsGenerator.sh
	@kubecolor apply -f devops/pods/secrets.yaml
	@rm devops/pods/secrets.yaml
	@kubecolor apply -f devops/pods/patient-deployment-cip.yaml


reset:                                                    ## Reset 
	@make rm
	@make rmi
	@make start

conect:                                                    ## Connect to container 
	@docker exec -it $(CONTAINER_NAME) /bin/bash


help:                                                       ## Show help
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'
## Build
														## Build the docker image
build-start:														## Build the docker image and start the container
	@make 
changelog:
	@./devops/changelog/changelog.sh



export HELP