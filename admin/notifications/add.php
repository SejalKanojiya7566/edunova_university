<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

include("../../config/db.php");
include("../includes/admin_header.php");
include("../includes/admin_sidebar.php");
?>

<div class="admin-content">

  <h2 class="dashboard-heading">Add Notification</h2>

  <div class="table-wrapper mt-3">

    <form method="POST">

      <table class="admin-table">

        <thead>
          <tr>
            <th width="25%">Field</th>
            <th>Value</th>
          </tr>
        </thead>

        <tbody>

          <tr>
            <td><b>Title</b></td>
            <td>
              <input type="text"
                     name="title"
                     class="form-control"
                     placeholder="Enter notification title"
                     required>
            </td>
          </tr>

          <tr>
            <td><b>Description</b></td>
            <td>
              <textarea name="description"
                        class="form-control"
                        rows="4"
                        placeholder="Enter notification description"
                        required></textarea>
            </td>
          </tr>

          <tr>
            <td><b>Type</b></td>
            <td>
              <select name="type" class="form-control" required>
                <option value="Notice">Notice</option>
                <option value="Holiday">Holiday</option>
                <option value="Announcement">Announcement</option>
              </select>
            </td>
          </tr>

          <tr>
            <td></td>
            <td>
              <button type="submit" name="save"
                      class="btn-success-sm">
                Save Notification
              </button>
            </td>
          </tr>

        </tbody>

      </table>

    </form>

    <?php
    if (isset($_POST['save'])) {

        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);

        mysqli_query($conn,"
          INSERT INTO notifications (title, description, type, created_at)
          VALUES ('$title','$description','$type',NOW())
        ");

        echo "<p class='text-success mt-3'>
              âœ” Notification Added Successfully
              </p>";
    }
    ?>

  </div>

</div>

<?php include("../includes/admin_footer.php"); ?>
