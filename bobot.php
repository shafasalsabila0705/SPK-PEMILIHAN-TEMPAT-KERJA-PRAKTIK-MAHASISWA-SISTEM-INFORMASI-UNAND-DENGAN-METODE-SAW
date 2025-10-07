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
    margin-bottom: 0.75rem;
    font-size: 1.25rem;
    font-weight: bold;
    color: #5a0000;
  }

  .card-body {
    font-size: 0.95rem;
    color: #333;
  }

  .table {
    margin: 0;
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

  .btn-info {
    background-color: #800000;
    border-color: #800000;
    color: #fff;
    padding: 6px 12px;
    font-size: 0.85rem;
    border-radius: 6px;
    transition: background-color 0.3s ease;
    margin-bottom: 1rem;
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
        <h3 class="text-blue fw-bold">Bobot Kriteria</h3>
      </div>
      <div class="page-content">
        <section class="row">
          <div class="col-12">

          
                <p class="fw-semibold text-dark mb-3">Pengambil keputusan memberi bobot preferensi dari setiap kriteria dengan masing-masing jenisnya (keuntungan/benefit atau biaya/cost):</p>
                
                <div class="card">
              
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped mb-0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Simbol</th>
                        <th>Kriteria</th>
                        <th>Bobot</th>
                        <th>Atribut</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = 'SELECT id_criteria,criteria,weight,attribute FROM saw_criterias';
                      $result = $db->query($sql);
                      $i = 0;
                      while ($row = $result->fetch_object()) {
                          echo "<tr>
                              <td>" . (++$i) . "</td>
                              <td>C{$i}</td>
                              <td>{$row->criteria}</td>
                              <td>{$row->weight}</td>
                              <td>{$row->attribute}</td>
                              <td>
                                  <a href='bobot-edit.php?id={$row->id_criteria}' class='btn btn-info btn-sm'>Edit</a>
                              </td>
                          </tr>\n";
                      }
                      $result->free();
                      ?>
                    </tbody>
                    <caption>Tabel Kriteria C<sub>i</sub></caption>
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
  <?php require "layout/js.php"; ?>
</body>

</html>