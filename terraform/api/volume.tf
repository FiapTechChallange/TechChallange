resource "kubernetes_persistent_volume_claim" "api_pv_claim" {
  metadata {
    name      = "api-pv-claim"
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

