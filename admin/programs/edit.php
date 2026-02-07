<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../login.php");
    exit();
}

include("../../config/db.php");
include("../includes/admin_header.php");
include("../includes/admin_sidebar.php");

/* UPDATE */
if (isset($_POST['update'])) {
    $id = $_POST['id'];

    mysqli_query($conn, "
        UPDATE programs SET
        program_level = '{$_POST['program_level']}',
        program_name  = '{$_POST['program_name']}',
        specialization= '{$_POST['specialization']}',
        duration      = '{$_POST['duration']}',
        fees          = '{$_POST['fees']}'
        WHERE id = $id
    ");

    echo "<p class='text-success mt-2'>Program ID $id Updated</p>";
}

/* FETCH ALL */
$result = mysqli_query($conn, "SELECT * FROM programs ORDER BY id DESC");
?>

<div class="admin-content">

<h2 class="dashboard-heading">Edit Programs</h2>

<div class="table-wrapper">
<table class="admin-table">

<thead>
<tr>
    <th>ID</th>
    <th>Level</th>
    <th>Program</th>
    <th>Specialization</th>
    <th>Duration</th>
    <th>Fees (â‚¹)</th>
    <th width="120">Action</th>
</tr>
</thead>

<tbody>
<?php while($row = mysqli_fetch_assoc($result)) { ?>
<form method="POST">
<tr>
    <td><?= $row['id']; ?></td>

    <td>
        <select name="program_level" class="form-control" required>
            <option value="Undergraduate" <?= ($row['program_level']=='Undergraduate')?'selected':'' ?>>Undergraduate</option>
            <option value="Postgraduate" <?= ($row['program_level']=='Postgraduate')?'selected':'' ?>>Postgraduate</option>
            <option value="Doctoral" <?= ($row['program_level']=='Doctoral')?'selected':'' ?>>Doctoral</option>
        </select>
    </td>

    <td>
        <input type="text" name="program_name"
               value="<?= htmlspecialchars($row['program_name']); ?>"
               class="form-control" required>
    </td>

    <td>
        <input type="text" name="specialization"
               value="<?= htmlspecialchars($row['specialization']); ?>"
               class="form-control">
    </td>

    <td>
        <input type="text" name="duration"
               value="<?= htmlspecialchars($row['duration']); ?>"
               class="form-control">
    </td>

    <td>
        <input type="number" name="fees"
               value="<?= $row['fees']; ?>"
               class="form-control">
    </td>

    <td>
        <input type="hidden" name="id" value="<?= $row['id']; ?>">
        <button type="submit" name="update" class="btn-success-sm">
            Update
        </button>
    </td>
</tr>
</form>
<?php } ?>
</tbody>

</table>
</div>
</div>

<?php include("../includes/admin_footer.php"); ?>
