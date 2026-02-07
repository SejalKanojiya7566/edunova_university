<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../login.php");
    exit();
}

include("../../config/db.php");
include("../includes/admin_header.php");
include("../includes/admin_sidebar.php");

$result = mysqli_query($conn, "SELECT * FROM admissions ORDER BY id DESC");
?>

<div class="admin-content">
  <h2 class="dashboard-heading">Admissions</h2>

  <div class="table-wrapper">
    <table class="admin-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Program</th>
          <th>Course</th>
          <th>Fees</th>
          <th>Status</th>
          <th>Date</th>
          <th width="170">Action</th>
        </tr>
      </thead>
      <tbody>

      <?php if(mysqli_num_rows($result)>0){ ?>
        <?php while($row=mysqli_fetch_assoc($result)){ ?>
        <tr>
          <td><?= $row['id']; ?></td>
          <td>
            <b><?= htmlspecialchars($row['student_name']); ?></b><br>
            <small><?= $row['email']; ?><br><?= $row['mobile']; ?></small>
          </td>

          <td><?= $row['program']; ?></td>
          <td><?= $row['course']; ?></td>

          <td>
            &#8377;<?= number_format($row['annual_fees']); ?><br>
            <small><?= $row['fees_type']; ?> | <?= $row['total_semesters']; ?> Sem</small>
          </td>

          <td>
            <span class="status-badge 
              <?= ($row['status']=='Approved')?'approved':(($row['status']=='Rejected')?'rejected':'pending'); ?>">
              <?= $row['status']; ?>
            </span>
          </td>

          <td><?= date("d M Y", strtotime($row['created_at'])); ?></td>

          <td>
  <div class="action-btns">
    <a href="approve.php?id=<?= $row['id']; ?>&status=Approved"
       class="btn-success-sm">Approve</a>

    <a href="approve.php?id=<?= $row['id']; ?>&status=Rejected"
       class="btn-warning-sm">Reject</a>

    <a href="delete.php?id=<?= $row['id']; ?>"
       onclick="return confirm('Delete this admission?')"
       class="btn-danger-sm">Delete</a>
  </div>
</td>        </tr>
        <?php } ?>
      <?php } else { ?>
        <tr>
          <td colspan="8" class="text-center">No Admissions Found</td>
        </tr>
      <?php } ?>

      </tbody>
    </table>
  </div>
</div>

<?php include("../includes/admin_footer.php"); ?>
