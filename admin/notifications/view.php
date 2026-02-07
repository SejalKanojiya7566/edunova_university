<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

include("../../config/db.php");
include("../includes/admin_header.php");
include("../includes/admin_sidebar.php");

$result = mysqli_query($conn, "SELECT * FROM notifications ORDER BY id DESC");
?>

<div class="admin-content">

  <!-- Heading + Add Button -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="dashboard-heading">Notifications</h2>

    <a href="add.php" class="btn-success-sm">
      + Add Notification
    </a>
  </div>

  <div class="table-wrapper">
    <table class="admin-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Type</th>
          <th>Date</th>
          <th width="120">Action</th>
        </tr>
      </thead>

      <tbody>
      <?php if(mysqli_num_rows($result) > 0){ ?>
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
          <tr>
            <td><?= $row['id']; ?></td>

            <td>
              <b><?= htmlspecialchars($row['title']); ?></b>
            </td>

            <td>
              <span class="status-badge pending">
                <?= htmlspecialchars($row['type']); ?>
              </span>
            </td>

            <td>
              <?= date("d M Y", strtotime($row['created_at'])); ?>
            </td>

            <td>
              <div class="action-btns">
                <a href="delete.php?id=<?= $row['id']; ?>"
                   onclick="return confirm('Delete this notification?')"
                   class="btn-danger-sm">
                  Delete
                </a>
              </div>
            </td>
          </tr>
        <?php } ?>
      <?php } else { ?>
        <tr>
          <td colspan="5" class="text-center">
            No notifications found
          </td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<?php include("../includes/admin_footer.php"); ?>
