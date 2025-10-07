<!DOCTYPE html>
<html lang="en">
<?php
require "layout/head.php";
require "include/conn.php";
?>
<style>
    body {
        background-color: #fcf9f4;
        font-family: 'Segoe UI', sans-serif;
    }

    /* Fix for main content to not overlap with sidebar */
    #main {
        margin-left: 300px; /* Default margin for expanded sidebar */
        transition: margin-left 0.3s ease;
        min-height: 100vh;
        width: calc(100% - 300px);
    }

    /* When sidebar is collapsed */
    .sidebar-collapsed #main {
        margin-left: 80px; /* Adjust based on collapsed sidebar width */
        width: calc(100% - 80px);
    }

    /* Alternative class names that might be used */
    .sidebar-minimize #main,
    .sidebar-mini #main,
    .collapsed #main {
        margin-left: 80px;
        width: calc(100% - 80px);
    }

    /* If the body has a class for sidebar state */
    body.sidebar-collapsed #main,
    body.sidebar-minimize #main {
        margin-left: 80px;
        width: calc(100% - 80px);
    }

    /* Alternative approach using CSS variables (if supported) */
    :root {
        --sidebar-width: 300px;
        --sidebar-collapsed-width: 80px;
    }

    /* For larger screens to ensure enough space */
    @media (min-width: 1200px) {
        #main {
            margin-left: var(--sidebar-width, 300px);
            width: calc(100% - var(--sidebar-width, 300px));
        }
        
        .sidebar-collapsed #main {
            margin-left: var(--sidebar-collapsed-width, 80px);
            width: calc(100% - var(--sidebar-collapsed-width, 80px));
        }
    }

    /* For medium screens */
    @media (max-width: 1199px) and (min-width: 992px) {
        #main {
            margin-left: 280px;
            width: calc(100% - 280px);
        }
        
        .sidebar-collapsed #main {
            margin-left: 70px;
            width: calc(100% - 70px);
        }
    }

    /* For mobile devices */
    @media (max-width: 991px) {
        #main {
            margin-left: 0 !important;
            width: 100% !important;
        }
    }

    /* Ensure content has proper spacing */
    .page-content {
        padding: 0 20px;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 20px;
        padding: 20px;
    }

    .alt-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 20px;
        transition: all 0.3s ease;
        border-left: 4px solid #800000;
    }

    .alt-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .alt-title {
        font-weight: bold;
        font-size: 1.2rem;
        color: #800000;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    .alt-title i {
        margin-right: 8px;
        font-size: 1.1rem;
    }

    .alt-actions {
        margin-top: 15px;
    }

    .alt-actions .btn {
        margin-right: 8px;
        margin-top: 5px;
        border-radius: 6px;
        padding: 6px 12px;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }

    .btn-maroon {
        background-color: #800000;
        color: #fff;
        border: none;
    }

    .btn-maroon:hover {
        background-color: #a94442;
        color: #fff;
        transform: translateY(-1px);
    }

    .btn-danger:hover {
        transform: translateY(-1px);
    }

    .header-title {
        padding: 20px;
        padding-bottom: 0;
    }

    .add-button {
        margin-left: 20px;
        margin-bottom: 20px;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 20px;
        color: #800000;
        opacity: 0.5;
    }

    .alt-card-counter {
        position: absolute;
        top: 10px;
        right: 15px;
        background: #800000;
        color: white;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: bold;
    }

    .alt-card {
        position: relative;
    }

    .stats-container {
        margin: 0 20px 20px 20px;
        background: white;
        padding: 15px;
        border-radius: 12px;
        border-left: 4px solid #800000;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    .stats-text {
        color: #6c757d;
        margin: 0;
    }

    /* Responsive adjustments */
    @media (max-width: 1199px) {        
        .grid-container {
            grid-template-columns: 1fr;
            padding: 10px;
        }
        
        .add-button, .header-title {
            margin-left: 10px;
            margin-right: 10px;
        }
        
        .stats-container {
            margin: 0 10px 20px 10px;
        }
    }

    @media (max-width: 768px) {
        .grid-container {
            grid-template-columns: 1fr;
            padding: 10px;
        }
        
        .add-button, .header-title {
            margin-left: 10px;
            margin-right: 10px;
        }
        
        .stats-container {
            margin: 0 10px 20px 10px;
        }
    }

    /* Modal customizations */
    .modal-header {
        background-color: #800000 !important;
        color: white !important;
        border-radius: 12px 12px 0 0 !important;
    }

    .modal-content {
        border-radius: 12px !important;
        border: none !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
    }

    .close, .btn-close {
        color: white !important;
        opacity: 0.8 !important;
    }

    .close:hover, .btn-close:hover {
        opacity: 1 !important;
    }

    /* Header adjustments */
    header {
        margin-bottom: 1rem;
        padding: 0 20px;
    }

    .burger-btn {
        background: none;
        border: none;
        color: #800000;
        padding: 10px;
        border-radius: 8px;
        transition: background-color 0.2s ease;
    }

    .burger-btn:hover {
        background-color: rgba(128, 0, 0, 0.1);
    }

    /* Sidebar overlay for mobile */
    @media (max-width: 991px) {
        #sidebar {
            position: fixed;
            top: 0;
            left: -300px; /* Match with sidebar width */
            width: 280px;
            height: 100vh;
            z-index: 1000;
            transition: left 0.3s ease;
            background: white;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        #sidebar.active {
            left: 0;
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            display: none;
        }

        .sidebar-overlay.active {
            display: block;
        }
    }
</style>

<body>
    <div id="app">
        <?php require "layout/sidebar.php"; ?>
        <!-- Overlay for mobile sidebar -->
        <div class="sidebar-overlay" id="sidebar-overlay"></div>
        
        <div id="main">
            <div class="page-content">
                <header class="mb-3">
                    <a href="#" class="burger-btn d-block d-xl-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                </header>
                
                <div class="page-heading header-title">
                    <h3><i class="bi bi-building me-2"></i>Alternatif Magang</h3>
                    <p class="text-muted">Berikut adalah daftar kandidat tempat magang dalam bentuk kartu.</p>
                </div>

                <?php
                // Count total alternatives
                $count_sql = 'SELECT COUNT(*) as total FROM saw_alternatives';
                $count_result = $db->query($count_sql);
                $total_alternatives = $count_result->fetch_object()->total;
                ?>

                <div class="stats-container">
                    <p class="stats-text mb-0">
                        <i class="bi bi-info-circle me-2"></i>
                        Total <?php echo $total_alternatives; ?> alternatif tempat magang tersedia
                    </p>
                </div>

                <div class="add-button">
                    <button type="button" class="btn btn-maroon btn-sm" data-bs-toggle="modal" data-bs-target="#inlineForm">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Alternatif
                    </button>
                </div>

                <div class="grid-container">
                    <?php
                    $sql = 'SELECT id_alternative, name FROM saw_alternatives ORDER BY name ASC';
                    $result = $db->query($sql);
                    
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_object()) {
                            echo "<div class='alt-card'>
                                    <div class='alt-card-counter'>{$i}</div>
                                    <div class='alt-title'>
                                        <i class='bi bi-briefcase'></i>
                                        " . htmlspecialchars($row->name) . "
                                    </div>
                                    <div class='alt-actions'>
                                        <a href='alternatif-edit.php?id={$row->id_alternative}' class='btn btn-maroon btn-sm'>
                                            <i class='bi bi-pencil me-1'></i>Edit
                                        </a>
                                        <a href='alternatif-hapus.php?id={$row->id_alternative}' class='btn btn-danger btn-sm' 
                                           onclick='return confirm(\"Apakah Anda yakin ingin menghapus alternatif ini?\")'>
                                            <i class='bi bi-trash me-1'></i>Hapus
                                        </a>
                                    </div>
                                </div>";
                            $i++;
                        }
                    } else {
                        echo "<div class='empty-state col-12'>
                                <i class='bi bi-building'></i>
                                <h5>Belum ada alternatif</h5>
                                <p>Klik tombol 'Tambah Alternatif' untuk menambahkan kandidat tempat magang pertama Anda.</p>
                            </div>";
                    }
                    $result->free();
                    ?>
                </div>

                <?php require "layout/footer.php"; ?>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Alternatif
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
                </div>

                <form action="alternatif-simpan.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label fw-bold">Nama Kandidat:</label>
                            <input type="text" name="name" placeholder="Contoh: PT. Tokopedia" class="form-control" required>
                            <small class="text-muted">Masukkan nama perusahaan atau institusi tempat magang</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i>Batal
                        </button>
                        <button type="submit" name="submit" class="btn btn-maroon">
                            <i class="bi bi-check-circle me-1"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require "layout/js.php"; ?>

    <!-- Alert Messages -->
    <?php if (isset($_GET['msg'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php
            $pesan = [
                'kosong' => 'Nama alternatif tidak boleh kosong.',
                'duplikat' => 'Nama alternatif sudah ada!',
                'sukses' => 'Data berhasil ditambahkan!',
                'gagal' => 'Terjadi kesalahan saat menyimpan data!',
            ];
            $alertType = in_array($_GET['msg'], ['sukses']) ? 'success' : 'error';
            ?>
            
            // Using SweetAlert if available, otherwise use regular alert
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: '<?php echo $alertType; ?>',
                    title: '<?php echo $alertType === 'success' ? 'Berhasil!' : 'Perhatian!'; ?>',
                    text: '<?php echo $pesan[$_GET['msg']]; ?>',
                    confirmButtonColor: '#800000'
                });
            } else {
                alert('<?php echo $pesan[$_GET['msg']]; ?>');
            }
        });
    </script>
    <?php endif; ?>

    <!-- Sidebar Integration Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Activate current menu item in sidebar
            const sidebarItems = document.querySelectorAll('.sidebar-item');
            sidebarItems.forEach(item => {
                const link = item.querySelector('a');
                if (link && (link.href.includes('alternatif') || link.textContent.toLowerCase().includes('alternatif'))) {
                    item.classList.add('active');
                }
            });

            // Mobile sidebar toggle
            const burgerBtn = document.querySelector('.burger-btn');
            const sidebar = document.querySelector('#sidebar');
            const sidebarOverlay = document.querySelector('#sidebar-overlay');
            
            if (burgerBtn && sidebar) {
                burgerBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    sidebar.classList.toggle('active');
                    if (sidebarOverlay) {
                        sidebarOverlay.classList.toggle('active');
                    }
                });
            }

            // Close sidebar when clicking overlay
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                });
            }

            // Close sidebar when clicking outside on mobile (optional - redundant with overlay)
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 991) {
                    const sidebar = document.querySelector('#sidebar');
                    const burgerBtn = document.querySelector('.burger-btn');
                    
                    if (sidebar && sidebar.classList.contains('active') && 
                        !sidebar.contains(e.target) && 
                        !burgerBtn.contains(e.target)) {
                        sidebar.classList.remove('active');
                        if (sidebarOverlay) {
                            sidebarOverlay.classList.remove('active');
                        }
                    }
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 991) {
                    // Desktop view - remove mobile classes
                    sidebar.classList.remove('active');
                    if (sidebarOverlay) {
                        sidebarOverlay.classList.remove('active');
                    }
                }
            });

            // Monitor sidebar state changes for collapsed/expanded
            // This function will detect sidebar toggle and adjust main content
            function adjustMainContent() {
                const sidebar = document.querySelector('#sidebar');
                const main = document.querySelector('#main');
                const body = document.body;
                
                if (!sidebar || !main) return;
                
                // Check for various possible class names for collapsed sidebar
                const isCollapsed = 
                    sidebar.classList.contains('collapsed') ||
                    sidebar.classList.contains('sidebar-collapsed') ||
                    sidebar.classList.contains('sidebar-minimize') ||
                    sidebar.classList.contains('sidebar-mini') ||
                    body.classList.contains('sidebar-collapsed') ||
                    body.classList.contains('sidebar-minimize') ||
                    body.classList.contains('sidebar-mini');
                
                // Get the actual width of the sidebar
                const sidebarWidth = sidebar.offsetWidth;
                
                if (window.innerWidth > 991) {
                    // Only apply margins on desktop
                    if (isCollapsed || sidebarWidth < 150) {
                        // Sidebar is collapsed
                        main.style.marginLeft = `${sidebarWidth}px`;
                        main.style.width = `calc(100% - ${sidebarWidth}px)`;
                    } else {
                        // Sidebar is expanded
                        main.style.marginLeft = `${sidebarWidth}px`;
                        main.style.width = `calc(100% - ${sidebarWidth}px)`;
                    }
                } else {
                    // Mobile view
                    main.style.marginLeft = '0';
                    main.style.width = '100%';
                }
            }

            // Initial adjustment
            setTimeout(adjustMainContent, 100);
            
            // Monitor for changes using MutationObserver
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'attributes' && 
                        (mutation.attributeName === 'class' || mutation.attributeName === 'style')) {
                        adjustMainContent();
                    }
                });
            });
            
            // Observe sidebar and body for class changes
            const sidebar = document.querySelector('#sidebar');
            if (sidebar) {
                observer.observe(sidebar, { attributes: true, attributeFilter: ['class', 'style'] });
                observer.observe(document.body, { attributes: true, attributeFilter: ['class'] });
            }
            
            // Also listen for window resize
            window.addEventListener('resize', adjustMainContent);
            
            // Listen for sidebar toggle button clicks (if they exist)
            const sidebarToggleButtons = document.querySelectorAll('[data-sidebar-toggle], .sidebar-toggle, .btn-sidebar-toggle');
            sidebarToggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    setTimeout(adjustMainContent, 350); // Wait for animation to complete
                });
            });
        });
    </script>
</body>
</html>