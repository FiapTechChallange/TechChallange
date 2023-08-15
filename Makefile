start-kubernetes:
	docker build -t tech-challange/api .
	kubectl apply -f .k8s/deployment.yaml

delete-namespace:
	kubectl delete all --all --namespace tech-challange