<!DOCTYPE html>
<html lang="en">
<?php
require "layout/head.php";
require "include/conn.php";
require "W.php";
require "R.php";
?>

<style>
  /* Custom maroon color */
  .bg-maroon {
    background-color: #800000 !important;
  }
  .text-maroon {
    color: #800000 !important;
  }
  .border-maroon {
    border-color: #800000 !important;
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
        <h3 class="text-blue fw-bold">
          <i class="bi bi-bar-chart-steps me-2"></i>Nilai Preferensi (P)
        </h3>
        <p class="text-muted">Penjumlahan hasil normalisasi (R) dikalikan dengan bobot kriteria (W) untuk menentukan nilai akhir.</p>
      </div>

      <div class="page-content">
        <section class="row">
          <div class="col-12">
            <div class="card border-0 shadow rounded-4">
              <div class="card-header bg-white border-bottom border-maroon">
                
              <div class="card-body">
                <div class="alert" style="background-color: #800000; color: white; border-radius: 8px;">
                  <i class="bi bi-info-circle-fill me-2"></i>
                  Nilai preferensi dihitung dari: <strong>R x W</strong>. Alternatif dengan nilai tertinggi merupakan pilihan terbaik.
                </div>

                <div class="table-responsive mt-4">
                  <table class="table table-hover table-bordered align-middle shadow-sm">
                    <caption class="text-muted ps-2">Nilai Preferensi (P)</caption>
                    <thead style="background-color: #800000; color: white;" class="text-center">
                      <tr>
                        <th>No</th>
                        <th>Alternatif</th>
                        <th>Hasil</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      <?php
                      $P = array();
                      $m = count($W);
                      $no = 0;
                      foreach ($R as $i => $r) {
                        for ($j = 0; $j < $m; $j++) {
                          $P[$i] = (isset($P[$i]) ? $P[$i] : 0) + $r[$j] * $W[$j];
                        }
                        echo "<tr>
                                <td>" . (++$no) . "</td>
                                <td>A{$i}</td>
                                <td><span class='badge' style='background-color: #800000; font-size: 1rem;'>{$P[$i]}</span></td>
                              </tr>";
                      }
                      ?>
                    </tbody>
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