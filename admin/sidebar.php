<?php
// เริ่มต้น session
session_start();

// ตรวจสอบว่าผู้ใช้ล็อกอินเข้ามาหรือไม่
if (!isset($_SESSION['mem_name'])) {
    // ถ้ายังไม่ได้ล็อกอิน ให้เปลี่ยนเส้นทางไปที่หน้า login
    header('Location: index.php');
    exit();
}

// แสดงข้อความแจ้งเตือนเมื่อไม่ใช่ admin
if ($_SESSION['mem_name'] !== 'admin') {
    $isNotAdmin = true; // ตั้งค่าเพื่อใช้ใน JavaScript สำหรับแจ้งเตือน
} else {
    $isNotAdmin = false;
}
?>

<aside class="main-sidebar sidebar-dark-gray elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link bg-gray">
    <img src="../assets/img/ioyn_icon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">By IOYN | POS System</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../mem_img/<?php echo $_SESSION['mem_img']; ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="edit_profile.php" target="" class="d-block"><?php echo $_SESSION['mem_name']; ?> | Edit Profile</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- เมนูสำหรับการขาย -->
        <li class="nav-header">เมนูสำหรับการขาย</li>
        <li class="nav-item">
          <a href="index.php" class="nav-link <?php if($menu == "index"){echo "active";} ?>">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>รายการขาย</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="list_l.php" class="nav-link <?php if($menu == "sale"){echo "active";} ?>">
            <i class="nav-icon fa fa-shopping-cart"></i>
            <p>ขายสินค้า</p>
          </a>
        </li>
      </ul>
      <hr>

      <!-- ตั้งค่าข้อมูลระบบ -->
      <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">ตั้งค่าข้อมูลระบบ</li>
        
        <!-- ตรวจสอบว่าเป็น admin หรือไม่เมื่อคลิกเมนู Member -->
        <li class="nav-item">
          <?php if ($_SESSION['mem_name'] === 'Admin'): ?>
            <a href="list_mem.php" class="nav-link <?php if($menu == "member"){echo "active";} ?>">
              <i class="nav-icon fa fa-users"></i>
              <p>Member</p>
            </a>
          <?php else: ?>
            <!-- แสดงข้อความแจ้งเตือนถ้าไม่ใช่ admin -->
            <a href="#" class="nav-link" onclick="showAlert();">
              <i class="nav-icon fa fa-users"></i>
              <p>Member</p>
            </a>
          <?php endif; ?>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link <?php if($menu == "type"){echo "active";} ?>">
            <i class="nav-icon fa fa-copy"></i>
            <p>Type (!Coming Soon)</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link <?php if($menu == "brand"){echo "active";} ?>">
            <i class="nav-icon fa fa-box"></i>
            <p>Brand (! Coming Soon)</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="list_product.php" class="nav-link <?php if($menu == "product"){echo "active";} ?>">
            <i class="nav-icon fa fa-box-open"></i>
            <p>Product</p>
          </a>
        </li>
      </ul>
      <hr>

      <!-- Dashboard -->
      <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Dashboard</li>
        <li class="nav-item">
          <a href="report_p5.php" class="nav-link <?php if($menu == "report_p5"){echo "active";} ?>">
            <i class="nav-icon fas fa-crown text-fuchsia"></i>
            <p>5 อันดับสินค้าขายดี</p>
          </a>
        </li>
      </ul>
      <hr>

      <!-- ออกจากระบบ -->
      <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="../logout.php" class="nav-link text-danger">
            <i class="nav-icon fas fa-power-off"></i>
            <p>ออกจากระบบ</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>

<script type="text/javascript">
// ฟังก์ชันแจ้งเตือนเมื่อผู้ใช้ไม่ใช่ admin
function showAlert() {
    <?php if ($isNotAdmin): ?>
        alert('คุณไม่มีสิทธิ์เข้าถึงเมนูนี้');
    <?php endif; ?>
}
</script>
