start-kubernetes:
	docker build -t tech-challenge/api .
	kubectl apply -f .k8s/namespace.yaml
	kubectl apply -f .k8s/

delete-namespace:
	kubectl delete all --all --namespace tech-challenge