resource "kubernetes_deployment" "database" {
  metadata {
    name      = "database"
    namespace = "tech-challenge"

    labels = {
      app = "database"
    }
  }

  spec {
    selector {
      match_labels = {
        app = "database"

        tier = "mysql"
      }
    }

    template {
      metadata {
        namespace = "tech-challenge"

        labels = {
          app = "database"

          tier = "mysql"
        }
      }

      spec {
        volume {
          name = "mysql-persistent-storage"

          persistent_volume_claim {
            claim_name = "mysql-pv-claim"
          }
        }

        container {
          name  = "mysql"
          image = "mysql:8.0"

          port {
            name           = "mysql"
            container_port = 3306
          }

          env {
            name  = "MYSQL_ROOT_PASSWORD"
            value = "password"
          }

          env {
            name  = "MYSQL_DATABASE"
            value = "FIAP_CHALLENGE"
          }

          env {
            name  = "MYSQL_USER"
            value = "user"
          }

          env {
            name  = "MYSQL_PASSWORD"
            value = "password"
          }

          volume_mount {
            name       = "mysql-persistent-storage"
            mount_path = "/var/lib/mysql"
          }
        }
      }
    }

    strategy {
      type = "Recreate"
    }
  }
}

