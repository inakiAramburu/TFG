.PHONY: help start stop rm reset-all-containers hard-reset rm-all reset-all-containers 
.DEFAULT_GOAL := help


build-start:			## make build-start DOMAIN=domain.com
	@if [ -z "$(DOMAIN)" ]; then \
		echo "Error: DOMAIN no especificado"; \
		exit 1; \
	fi
	@make build
	@make start DOMAIN=$(DOMAIN)

build:						## Build the docker image
	@docker build -t ca .

start:						## start  make start DOMAIN=domain.com
	@if [ -z "$(DOMAIN)" ]; then \
		echo "Error: DOMAIN no especificado"; \
		exit 1; \
	fi
	@docker run --name CAca -e DOMINIO=$(DOMAIN) --rm -v ./certificates:/certificates -it ca

help:                                                       ## Show help
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

