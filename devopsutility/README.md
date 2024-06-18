# TFG DevOps Utilities

## Certificate Authority (CA)

This tool generates certificates using [minica](https://github.com/jsha/minica).

The process is quite simple. When we create a certificate for a domain for the first time, the "certificates" folder will be empty. When creating the certificate, three elements will be generated: a folder with the domain name containing the domain certificates and two .pem files corresponding to the root certificate. If we want to continue using the same root certificates or we already have some, we only need to place them in the "certificates" folder. The certificates we create later will be generated using those existing root certificates in the folder.

### Requirements

The requirements:

- Docker
- Docker-compose
- Make

### How to create a certificate



```bash
cd CA
make build
make start DOMAIN=domain.com
```

## Runners

Bitbucket runners are virtual machines or containers that run automated tasks or pipelines within the Bitbucket Pipelines environment. These runners allow developers to build, test and deploy code in an automated and efficient manner. Some of the typical tasks they can perform include compiling code, running automated tests, and deploying applications to test or production servers. Whenever a commit or change is made to the code repository, runners can be configured to automatically execute the tasks specified in the pipeline, helping to automate and accelerate the software development cycle.



In this case, two types of runners are used: one is a Docker runner and the other is a shell runner. The second runner shell is configured inside a Docker-in-Docker container. This ensures that when deploying inside the container, the container actually runs on the server that contains that container.

### Requirements
- Docker
- Docker-compose
- Make
### variables 
- XDG_RUNTIME_DIR
- ACCOUNT_UUID
- RUNNER_UUID
- OAUTH_CLIENT_ID
- OAUTH_CLIENT_SECRET

### How start Docker in docker

```bash
cd Runners
make start  #Docker in Docker runner 
make start-docker-runner #docker pipeline
```

## LOG
Promtail, Loki and Grafana are open source tools designed for observability and system monitoring. Together, Promtail, Loki and Grafana form a powerful ecosystem for collecting, storing, analysing and visualising logs and metrics, thus contributing to improved monitoring and troubleshooting of complex IT systems.

### Requirements
- Kubernetes cluster
- helm
- Make

### How start Promtail, Loki and Grafana


```bash
cd LOG
make start 
```
