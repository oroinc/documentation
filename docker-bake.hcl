variable "ORO_PROJECT" { default = "ocir.eu-frankfurt-1.oci.oraclecloud.com/frecfpcrj6gd/oro-product-development/" }
variable "ORO_IMAGE" { default = "${ORO_PROJECT}doc-application" }
variable "ORO_IMAGE_TAG" { default = "latest" }
variable "GIT_COMMIT" { default = null }
variable "GIT_URL" { default = null }
variable "BUILD_TIMESTAMP" { default = null }
variable "GIT_BRANCH" { default = null }
variable "TAG_NAME" { default = null }
variable "MAINTENANCE_BRANCHES" { default = "" }

function "labelList" {
  params = []
  result = {
    "org.opencontainers.image.revision" = "${GIT_COMMIT}"
    "org.opencontainers.image.source"   = "${GIT_URL}"
    "org.opencontainers.image.created"  = "${BUILD_TIMESTAMP}"
    "com.oroinc.orocloud.reference"     = "${GIT_BRANCH}"
    "org.opencontainers.image.version"  = "${TAG_NAME}"
  }
}

group "default" {
  targets = ["runtime", "build_artifacts"]
}

target "runtime" {
  target     = "runtime"
  dockerfile = "Dockerfile"
  tags = [
    "${ORO_IMAGE}:${ORO_IMAGE_TAG}",
    "${ORO_IMAGE}:${formatdate("YYYYMMDD", timestamp())}"
  ]
  labels = labelList()
  args = {
    MAINTENANCE_BRANCHES = "${MAINTENANCE_BRANCHES}"
  }
}

target "build_artifacts" {
  target     = "build_artifacts"
  dockerfile = "Dockerfile"
  output     = ["type=local, dest=./_build"]
  args = {
    MAINTENANCE_BRANCHES = "${MAINTENANCE_BRANCHES}"
  }
}
