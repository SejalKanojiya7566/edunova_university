<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../login.php");
    exit();
}

include("../../config/db.php");
include("../includes/admin_header.php");
include("../includes/admin_sidebar.php");

$result = mysqli_query($conn, "SELECT * FROM enquiries ORDER BY id DESC");
?>

<div class="admin-content">
  <h2 class="dashboard-heading">Student Enquiries</h2>

  <div class="table-wrapper">
    <table class="admin-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Mobile</th>
          <th>Message</th>
          <th>Date</th>
          <th width="120">Action</th>
        </tr>
      </thead>
      <tbody>

      <?php if(mysqli_num_rows($result)>0){ ?>
        <?php while($row=mysqli_fetch_assoc($result)){ ?>
          <tr>
            <td><?= $row['id']; ?></td>
            <td><?= htmlspecialchars($row['name']); ?></td>
            <td><?= htmlspecialchars($row['email']); ?></td>
            <td><?= htmlspecialchars($row['phone']); ?></td>

            <td class="msg" title="<?= htmlspecialchars($row['message']); ?>">
              <?= strlen($row['message']) > 50 
                    ? substr($row['message'],0,50).'...' 
                    : $row['message']; ?>
            </td>

            <td>
              <?= isset($row['created_at']) 
                    ? date("d M Y",strtotime($row['created_at'])) 
                    : date("d M Y",strtotime($row['enquiry_date'])); ?>
            </td>

            <td>
              <a href="delete.php?id=<?= $row['id']; ?>"
                 onclick="return confirm('Delete this enquiry?')"
                 class="btn-danger-sm">
                 Delete
              </a>
            </td>
          </tr>
        <?php } ?>
      <?php } else { ?>
        <tr>
          <td colspan="7" class="text-center">No Enquiries Found</td>
        </tr>
      <?php } ?>

      </tbody>
    </table>
  </div>
</div>

<?php include("../includes/admin_footer.php"); ?>
