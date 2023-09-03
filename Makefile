start-kubernetes:
	docker build -t tech-challenge/api .
	kubectl apply -f .k8s/namespace.yaml
	kubectl apply -f .k8s/api/
	kubectl apply -f .k8s/database/

delete-namespace:
	kubectl delete all --all --namespace tech-challenge

create-db:
	kubectl exec -i deploy/database -n tech-challenge -- mysql -u user -ppassword FIAP_CHALLENGE < dump-database.sql
