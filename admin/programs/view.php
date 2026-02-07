<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../login.php");
    exit();
}

include("../../config/db.php");
include("../includes/admin_header.php");
include("../includes/admin_sidebar.php");

$result = mysqli_query($conn, "SELECT * FROM programs ORDER BY id DESC");
?>

<div class="admin-content">

  <!-- Heading + Add Button -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="dashboard-heading">All Programs</h2>

    <a href="add.php" class="btn-success-sm">
      + Add Program
    </a>
  </div>

  <div class="table-wrapper">
    <table class="admin-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Level</th>
          <th>Program</th>
          <th>Specialization</th>
          <th>Duration</th>
          <th>Fees</th>
          <th width="160">Action</th>
        </tr>
      </thead>

      <tbody>
      <?php if(mysqli_num_rows($result) > 0){ ?>
        <?php while($row = mysqli_fetch_assoc($result)){ ?>
          <tr>
            <td><?= $row['id']; ?></td>

            <td><?= htmlspecialchars($row['program_level']); ?></td>

            <td>
              <b><?= htmlspecialchars($row['program_name']); ?></b>
            </td>

            <td><?= htmlspecialchars($row['specialization']); ?></td>

            <td><?= htmlspecialchars($row['duration']); ?></td>

            <td>
              &#8377;<?= number_format($row['fees']); ?>
            </td>

            <td>
              <div class="action-btns">
                <a href="edit.php?id=<?= $row['id']; ?>"
                   class="btn-success-sm">Edit</a>

                <a href="delete.php?id=<?= $row['id']; ?>"
                   onclick="return confirm('Delete this program?')"
                   class="btn-danger-sm">Delete</a>
              </div>
            </td>
          </tr>
        <?php } ?>
      <?php } else { ?>
        <tr>
          <td colspan="7" class="text-center">
            No programs added yet
          </td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<?php include("../includes/admin_footer.php"); ?>
