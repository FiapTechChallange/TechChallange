resource "kubernetes_service" "api_service" {
  metadata {
    name      = "api-service"
    namespace = "tech-challenge"

    labels = {
      app = "api"
    }
  }

  spec {
    port {
      name        = "http"
      protocol    = "TCP"
      port        = 8888
      target_port = "80"
    }

    selector = {
      app = "api"
    }

    type = "LoadBalancer"
  }
}

