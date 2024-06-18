
#it is recommended to replace kubectl with kubekolor for better visualisation.

loki:
	@helm install loki grafana/loki-stack

unloki:
	@helm uninstall loki

start:
	@make loki
	@kubectl apply -f deploygrafana.yaml
	@make configmap-start
	@echo "cambia el dominio gramfana.arzueta.com https://secure.piensasolutions.com/home/2239508"
	@echo "kubernetes ingrees: https://console.cloud.google.com/kubernetes/ingresses?authuser=1&hl=es&project=tfg-naru&pageState=(%22savedViews%22:(%22i%22:%220bed701b39cf48f7b8f93f39e0c8520c%22,%22c%22:%5B%5D,%22n%22:%5B%5D))"

delete:
	@make unloki
	@make configmap-delete
	@kubectl delete -f deploygrafana.yaml

configmap-start:
	@kubectl create configmap grafana-dashboard --from-file=dashboard.json
	@kubectl create configmap grafana-dashboards-config --from-file=provisioning-dashboards.yaml
	@kubectl create configmap grafana-datasource --from-file=datasource.yaml
configmap-delete:
	@kubectl delete configmap grafana-dashboard
	@kubectl delete configmap grafana-dashboards-config
	@kubectl delete configmap grafana-datasource