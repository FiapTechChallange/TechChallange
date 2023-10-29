terraform {
  required_providers {
    kubernetes = {
      source = "hashicorp/kubernetes"
      version = "2.23.0"
    }
  }
}

provider "kubernetes" {
  config_path = "~/.kube/config"
}

resource "kubernetes_namespace" "tech_challenge" {
  metadata {
    name = "tech-challenge"
  }
}

module "api" {
    source = "./api"
}

module "database" {
    source = "./database"
}