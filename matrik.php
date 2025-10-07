<!DOCTYPE html>
<html lang="en">
<?php
require "layout/head.php";
require "include/conn.php";
?>

<style>
  body {
    background-color: #f9fddc;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #5a0000;
  }

  .page-heading h3 {
    color: #5a0000;
    font-weight: 700;
    margin-bottom: 1rem;
  }

  .card {
    background-color: #fff;
    border: none;
    border-radius: 16px;
    box-shadow: 0 6px 18px rgba(128, 0, 0, 0.1);
    overflow: hidden;
    padding: 1.5rem;
  }

  .card-title {
    margin-bottom: 1rem;
    font-size: 1.25rem;
    font-weight: bold;
    color: #5a0000;
  }

  .card-body {
    font-size: 0.95rem;
    color: #333;
  }

  .table {
    margin-top: 1rem;
    border-radius: 12px;
    overflow: hidden;
  }

  .table th {
    background-color: #800000;
    color: white;
    font-weight: 600;
    text-align: center;
  }

  .table td {
    text-align: center;
    vertical-align: middle;
    color: #5a0000;
  }

  .table-striped tbody tr:nth-of-type(odd) {
    background-color: #fff7f7;
  }

  caption {
    caption-side: bottom;
    padding-top: 0.5rem;
    font-style: italic;
    color: #800000;
  }

  .btn-outline-success {
    border-color: #800000;
    color: #800000;
    margin-bottom: 1rem;
  }

  .btn-outline-success:hover {
    background-color: #a52a2a;
    color: white;
    border-color: #a52a2a;
  }

  .btn-danger {
    background-color: #a52a2a;
    border-color: #a52a2a;
  }
</style>

<body>
  <div id="app">
    <?php require "layout/sidebar.php"; ?>
    <div id="main">
      <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
          <i class="bi bi-justify fs-3"></i>
        </a>
      </header>
      <div class="page-heading">
        <h3>Matriks Keputusan</h3>
      </div>
      <div class="page-content">
        <section class="row">
          <div class="col-12">
            
              <h4 class="card-title">Matriks Keputusan (X) & Ternormalisasi (R)</h4>
              
                <p>Melakukan perhitungan normalisasi untuk mendapatkan matriks nilai ternormalisasi (R), dengan ketentuan:</p>
                <ul>
                  <li><strong>Cost:</strong> Rij = min{Xij} / Xij</li>
                  <li><strong>Benefit:</strong> Rij = Xij / max{Xij}</li>
                </ul>
                 

                <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#inlineForm">
                  Isi Nilai Alternatif
                </button>
                <div class="card">
                <div class="card-body"> 

                <!-- Tabel X -->
                <div class="table-responsive">
                  <table class="table table-striped mb-0">
                    <caption>Matriks Keputusan (X)</caption>
                    <tr>
                      <th rowspan='2'>Alternatif</th>
                      <th colspan='5'>Kriteria</th>
                      <th rowspan='2'>Aksi</th>
                    </tr>
                    <tr>
                      <th>C1</th><th>C2</th><th>C3</th><th>C4</th><th>C5</th>
                    </tr>
                    <?php
                    $sql = "SELECT
                              a.id_alternative,
                              b.name,
                              SUM(IF(a.id_criteria=1,a.value,0)) AS C1,
                              SUM(IF(a.id_criteria=2,a.value,0)) AS C2,
                              SUM(IF(a.id_criteria=3,a.value,0)) AS C3,
                              SUM(IF(a.id_criteria=4,a.value,0)) AS C4,
                              SUM(IF(a.id_criteria=5,a.value,0)) AS C5
                            FROM saw_evaluations a
                            JOIN saw_alternatives b USING(id_alternative)
                            GROUP BY a.id_alternative
                            ORDER BY a.id_alternative";
                    $result = $db->query($sql);
                    $X = array(1 => [], 2 => [], 3 => [], 4 => [], 5 => []);
                    while ($row = $result->fetch_object()) {
                      for ($c = 1; $c <= 5; $c++) {
                        array_push($X[$c], round($row->{"C$c"}, 2));
                      }
                      echo "<tr>
                              <th>A<sub>{$row->id_alternative}</sub> {$row->name}</th>
                              <td>{$row->C1}</td>
                              <td>{$row->C2}</td>
                              <td>{$row->C3}</td>
                              <td>{$row->C4}</td>
                              <td>{$row->C5}</td>
                              <td>
                                <a href='keputusan-hapus.php?id={$row->id_alternative}' class='btn btn-danger btn-sm'>Hapus</a>
                              </td>
                            </tr>";
                    }
                    $result->free();
                    ?>
                  </table>
                </div>

                <!-- Tabel R -->
                <div class="table-responsive mt-4">
                  <table class="table table-striped mb-0">
                    <caption>Matriks Ternormalisasi (R)</caption>
                    <tr>
                      <th rowspan='2'>Alternatif</th>
                      <th colspan='5'>Kriteria</th>
                    </tr>
                    <tr>
                      <th>C1</th><th>C2</th><th>C3</th><th>C4</th><th>C5</th>
                    </tr>
                    <?php
                    $sql = "SELECT
                              a.id_alternative,
                              SUM(IF(a.id_criteria=1, IF(b.attribute='benefit', a.value/".max($X[1]).", ".min($X[1])."/a.value), 0)) AS C1,
                              SUM(IF(a.id_criteria=2, IF(b.attribute='benefit', a.value/".max($X[2]).", ".min($X[2])."/a.value), 0)) AS C2,
                              SUM(IF(a.id_criteria=3, IF(b.attribute='benefit', a.value/".max($X[3]).", ".min($X[3])."/a.value), 0)) AS C3,
                              SUM(IF(a.id_criteria=4, IF(b.attribute='benefit', a.value/".max($X[4]).", ".min($X[4])."/a.value), 0)) AS C4,
                              SUM(IF(a.id_criteria=5, IF(b.attribute='benefit', a.value/".max($X[5]).", ".min($X[5])."/a.value), 0)) AS C5
                            FROM saw_evaluations a
                            JOIN saw_criterias b USING(id_criteria)
                            GROUP BY a.id_alternative
                            ORDER BY a.id_alternative";
                    $result = $db->query($sql);
                    while ($row = $result->fetch_object()) {
                      echo "<tr>
                              <th>A{$row->id_alternative}</th>
                              <td>".round($row->C1, 2)."</td>
                              <td>".round($row->C2, 2)."</td>
                              <td>".round($row->C3, 2)."</td>
                              <td>".round($row->C4, 2)."</td>
                              <td>".round($row->C5, 2)."</td>
                            </tr>";
                    }
                    ?>
                  </table>
                </div>

              </div>
            </div>
          </div>
        </section>
      </div>
      <?php require "layout/footer.php"; ?>
    </div>
  </div>

  <!-- Modal Input -->
  <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Isi Nilai Kandidat</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <form action="matrik-simpan.php" method="POST">
          <div class="modal-body">
            <label>Nama Alternatif:</label>
            <div class="form-group">
              <select class="form-control" name="id_alternative">
                <?php
                $sql = 'SELECT id_alternative, name FROM saw_alternatives';
                $result = $db->query($sql);
                while ($row = $result->fetch_object()) {
                  echo "<option value='{$row->id_alternative}'>{$row->name}</option>";
                }
                ?>
              </select>
            </div>

            <label>Kriteria:</label>
            <div class="form-group">
              <select class="form-control" name="id_criteria">
                <?php
                $sql = 'SELECT * FROM saw_criterias';
                $result = $db->query($sql);
                while ($row = $result->fetch_object()) {
                  echo "<option value='{$row->id_criteria}'>{$row->criteria}</option>";
                }
                ?>
              </select>
            </div>

            <label>Nilai:</label>
            <div class="form-group">
              <input type="text" name="value" class="form-control" placeholder="value..." required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php require "layout/js.php"; ?>
</body>
</html>