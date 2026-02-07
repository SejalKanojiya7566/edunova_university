<?php
// current file name nikaalo
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!-- ADMIN SIDEBAR -->
<div class="sidebar bg-dark text-white vh-100 position-fixed" style="width:250px;">

  <!-- HEADER -->
  <div class="sidebar-header border-bottom">
    <h5 class="text-center mb-0 fw-bold">EduNova University</h5>
    <small class="text-center d-block text-secondary">Admin Panel</small>
  </div>

  <ul class="nav flex-column mt-3">

    <li class="nav-item">
      <a href="../dashboard/dashboard.php"
         class="nav-link text-white <?php echo ($currentPage=='dashboard.php')?'active':''; ?>">
        Dashboard
      </a>
    </li>

    <li class="nav-item">
      <a href="../office_management/view_office.php"
         class="nav-link text-white <?php echo ($currentPage=='view_office.php')?'active':''; ?>">
        Office Management
      </a>
    </li>

    <li class="nav-item">
      <a href="../enquiry_management/view_enquiry.php"
         class="nav-link text-white <?php echo ($currentPage=='view_enquiry.php')?'active':''; ?>">
        Enquiry Management
      </a>
    </li>

    <li class="nav-item">
      <a href="../admission_management/view_admission.php"
         class="nav-link text-white <?php echo ($currentPage=='view_admission.php')?'active':''; ?>">
        Admission Management
      </a>
    </li>

    <li class="nav-item">
      <a href="../admit_card/view_admit.php"
         class="nav-link text-white <?php echo ($currentPage=='view_admit.php')?'active':''; ?>">
        Admit Card
      </a>
    </li>

    <li class="nav-item">
      <a href="../attendance_management/view_attendance.php"
         class="nav-link text-white <?php echo ($currentPage=='view_attendance.php')?'active':''; ?>">
        Attendance
      </a>
    </li>

    <li class="nav-item">
      <a href="../fees_collection/view_fees.php"
         class="nav-link text-white <?php echo ($currentPage=='view_fees.php')?'active':''; ?>">
        Fees Collection
      </a>
    </li>

    <li class="nav-item">
      <a href="../notification/view_notice.php"
         class="nav-link text-white <?php echo ($currentPage=='view_notice.php')?'active':''; ?>">
        Notifications
      </a>
    </li>

    <li class="nav-item">
      <a href="../examination/view_exam.php"
         class="nav-link text-white <?php echo ($currentPage=='view_exam.php')?'active':''; ?>">
        Examination
      </a>
    </li>

    <li class="nav-item">
      <a href="../teacher_management/view_teacher.php"
         class="nav-link text-white <?php echo ($currentPage=='view_teacher.php')?'active':''; ?>">
        Teacher Management
      </a>
    </li>

    <li class="nav-item">
      <a href="../payroll_management/view_salary.php"
         class="nav-link text-white <?php echo ($currentPage=='view_salary.php')?'active':''; ?>">
        Payroll Management
      </a>
    </li>

    <li class="nav-item">
      <a href="../books_management/view_book.php"
         class="nav-link text-white <?php echo ($currentPage=='view_book.php')?'active':''; ?>">
        Books Management
      </a>
    </li>

    <li class="nav-item">
      <a href="../certificates/view_certificate.php"
         class="nav-link text-white <?php echo ($currentPage=='view_certificate.php')?'active':''; ?>">
        Certificates (CC / TC)
      </a>
    </li>

    <li class="nav-item">
      <a href="../franchise/view_franchise.php"
         class="nav-link text-white <?php echo ($currentPage=='view_franchise.php')?'active':''; ?>">
        Franchise
      </a>
    </li>

    <li class="nav-item">
      <a href="../course_material/view_material.php"
         class="nav-link text-white <?php echo ($currentPage=='view_material.php')?'active':''; ?>">
        Course & Study Material
      </a>
    </li>

    <li class="nav-item">
      <a href="../user_management/view_user.php"
         class="nav-link text-white <?php echo ($currentPage=='view_user.php')?'active':''; ?>">
        User Management
      </a>
    </li>

    <li class="nav-item border-top mt-3">
      <a href="../../logout.php" class="nav-link text-danger">
        Logout
      </a>
    </li>

  </ul>
</div>
