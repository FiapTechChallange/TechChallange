resource "kubernetes_deployment" "api" {
  metadata {
    name      = "api"
    namespace = "tech-challenge"
  }

  spec {
    replicas = 2

    selector {
      match_labels = {
        app = "api"
      }
    }

    template {
      metadata {
        labels = {
          app = "api"
        }
      }

      spec {
        volume {
          name = "api-persistent-storage"

          persistent_volume_claim {
            claim_name = "api-pv-claim"
          }
        }

        container {
          name  = "api"
          image = "tech-challenge/api"

          port {
            container_port = 80
          }

          env {
            name  = "DB_USERNAME"
            value = "user"
          }

          env {
            name  = "DB_PASSWORD"
            value = "password"
          }

          env {
            name  = "DB_DSN"
            value = "mysql:host=database-service;port=3306;dbname=FIAP_CHALLENGE;"
          }

          volume_mount {
            name       = "api-persistent-storage"
            mount_path = "/var/www/volume"
          }

          liveness_probe {
            http_get {
              path = "/healthcheck"
              port = "80"
            }

            initial_delay_seconds = 10
            timeout_seconds       = 10
            period_seconds        = 15
            success_threshold     = 1
            failure_threshold     = 3
          }

          image_pull_policy = "Never"
        }
      }
    }
  }
}

