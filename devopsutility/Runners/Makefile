.PHONY: help start stop rm reset-all-containers hard-reset rm-all reset-all-containers 
.DEFAULT_GOAL := help


build-start:			
	@make build
	@make start

DockerRunnerShellCommand := ./start.sh --accountUuid {9625540a-93c5-4380-be77-0839cdaf054e} --runnerUuid {ea4b039b-674f-59e8-a408-f8745724eeb3} --OAuthClientId iIUYmdXnXYk8v4D64wiESgixK5e7Z6iV --OAuthClientSecret ATOAbBuJZIqJ1AK0EfbgWlM6aAuJiY2ajBDI8xBKMQ1nGfhOc3i_XZJbEmuj-vmCFYdC34B7BF55 --runtime linux-shell --workingDirectory ../temp

start:						## start 
	@docker build -t runner .
	@docker run --name runnerShell -v /$(XDG_RUNTIME_DIR)/docker.sock:/var/run/docker.sock --rm runner:latest $(DockerRunnerShellCommand)

help:                                                       ## Show help
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'


start-docker-runner: #no sirve para buildear imagenes docker 
	@docker container run -it \
    --rm \
    --name runner-7f409a3d-72b1-5530-b858-ee83f25aa7b6 \
    -v /tmp:/tmp \
    -v /$(XDG_RUNTIME_DIR)/docker.sock:/var/run/docker.sock \
    -v /$(XDG_RUNTIME_DIR)/docker/containerd:/var/lib/docker/containers:ro \
    -e ACCOUNT_UUID={$(ACCOUNT_UUID)} \
    -e RUNNER_UUID={$(RUNNER_UUID)} \
    -e RUNTIME_PREREQUISITES_ENABLED=true \
    -e OAUTH_CLIENT_ID=$(OAUTH_CLIENT_ID) \
    -e OAUTH_CLIENT_SECRET= $(OAUTH_CLIENT_SECRET)\
    -e WORKING_DIRECTORY=/tmp \
    docker-public.packages.atlassian.com/sox/atlassian/bitbucket-pipelines-runner:1



