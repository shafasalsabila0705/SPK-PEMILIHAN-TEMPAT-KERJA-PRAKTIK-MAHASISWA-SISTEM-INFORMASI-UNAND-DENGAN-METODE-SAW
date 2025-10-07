<!DOCTYPE html>
<html lang="en">
<?php require "layout/head.php"; ?>

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
                <h3 class="text-blue fw-bold"><i class="bi bi-speedometer2 me-2"></i>Dashboard</h3>
                <p class="text-muted">Selamat datang di Sistem Pendukung Keputusan — Pemilihan Tempat Magang Terbaik dengan SAW.</p>
            </div>

          <!-- Content -->
  <div id="content">
    <div class="content-header">
      <h1 class="content-title">Dashboard Pemilihan Tempat Magang</h1>
      <p class="content-subtitle">Sistem Pendukung Keputusan Menggunakan Metode SAW</p>
    </div>

    <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
      <h3>Selamat Datang!</h3>
      <p>Sistem ini membantu dalam pemilihan tempat magang terbaik menggunakan metode Simple Additive Weighting (SAW).</p>
      
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 20px;">
        <div style="background: #800000; color: white; padding: 20px; border-radius: 8px; text-align: center;">
          <i class="bi bi-building" style="font-size: 24px; margin-bottom: 10px;"></i>
          <h4 style="margin: 0;">Alternatif</h4>
          <p style="margin: 5px 0 0;">Data tempat magang</p>
        </div>
        <div style="background: #A52A2A; color: white; padding: 20px; border-radius: 8px; text-align: center;">
          <i class="bi bi-sliders" style="font-size: 24px; margin-bottom: 10px;"></i>
          <h4 style="margin: 0;">Kriteria</h4>
          <p style="margin: 5px 0 0;">Bobot penilaian</p>
        </div>
        <div style="background: #8B4513; color: white; padding: 20px; border-radius: 8px; text-align: center;">
          <i class="bi bi-bar-chart-fill" style="font-size: 24px; margin-bottom: 10px;"></i>
          <h4 style="margin: 0;">Hasil</h4>
          <p style="margin: 5px 0 0;">Ranking terbaik</p>
        </div>
      </div>
    </div>
  </div>

  

    <?php require "layout/js.php"; ?>
</body>
</html>