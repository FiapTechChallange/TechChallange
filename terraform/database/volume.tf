resource "kubernetes_persistent_volume_claim" "mysql_pv_claim" {
  metadata {
    name      = "mysql-pv-claim"
    namespace = "tech-challenge"

    labels = {
      app = "database"
    }
  }

  spec {
    access_modes = ["ReadWriteOnce"]

    resources {
      requests = {
        storage = "5Gi"
      }
    }
  }
}

