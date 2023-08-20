start-kubernetes:
	docker build -t tech-challange/api .
	kubectl apply -f .k8s/

delete-namespace:
	kubectl delete all --all --namespace tech-challange