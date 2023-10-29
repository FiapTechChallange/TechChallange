resource "kubernetes_service" "database_service" {
  metadata {
    name      = "database-service"
    namespace = "tech-challenge"

    labels = {
      app = "database"
    }
  }

  spec {
    port {
      name        = "database"
      protocol    = "TCP"
      port        = 3306
      target_port = "3306"
      node_port   = 30432
    }

    selector = {
      app = "database"
    }

    type = "NodePort"
  }
}

