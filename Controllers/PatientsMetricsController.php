<?php

class PatientsMetricsController {
  public function index() {
    echo "PatientsMetricsController @ index";
  }

  public function get($id, $metricsId) {
    echo "PatientsMetricsController @ get($id, $metricsId)";
  }

  public function create() {
    echo "PatientsMetricsController @ create";
  }

  public function update($id, $metricsId) {
    header('Content-Type: application/json');
    echo json_encode(["PatientsMetricsController @ update($id, $metricsId)", "<br /> \$_SERVER['REQUEST_METHOD'] = {$_SERVER['REQUEST_METHOD']}"]);
    die();
  }

  public function delete($id, $metricsId) {
    header('Content-Type: application/json');
    echo json_encode(["PatientsMetricsController @ delete($id, $metricsId)", "<br /> \$_SERVER['REQUEST_METHOD'] = {$_SERVER['REQUEST_METHOD']}"]);
    die();
  }
}
 ?>
