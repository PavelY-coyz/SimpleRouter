<?php

class PatientsController {
  public function index() {
    echo "PatientsController @ index";
  }

  public function get($id) {
    echo "PatientsController @ get($id)";
  }

  public function create() {
    echo "PatientsController @ create";
  }

  public function update($id) {
    header('Content-Type: application/json');
    echo json_encode(["PatientsController @ update($id)", "<br /> \$_SERVER['REQUEST_METHOD'] = {$_SERVER['REQUEST_METHOD']}"]);
    die();
  }

  public function delete($id) {
    header('Content-Type: application/json');
    echo json_encode(["PatientsController @ delete($id)", "<br /> \$_SERVER['REQUEST_METHOD'] = {$_SERVER['REQUEST_METHOD']}"]);
    die();
  }
}
 ?>
