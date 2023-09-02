start-kubernetes:
	docker build -t tech-challenge/api .
	kubectl apply -f .k8s/namespace.yaml
	kubectl apply -f .k8s/

delete-namespace:
	kubectl delete all --all --namespace tech-challenge


start-db:
	kubectl exec -i deploy/database -n tech-challenge -- mysql -u root -ppassword FIAP_CHALLENGE < dump-database.sql