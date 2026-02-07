<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../login.php");
    exit();
}

include("../../config/db.php");
include("../includes/admin_header.php");
include("../includes/admin_sidebar.php");

/* SAVE */
if (isset($_POST['save'])) {

    mysqli_query($conn, "
        INSERT INTO programs
        (program_level, program_name, specialization, duration, fees)
        VALUES (
            '{$_POST['program_level']}',
            '{$_POST['program_name']}',
            '{$_POST['specialization']}',
            '{$_POST['duration']}',
            '{$_POST['fees']}'
        )
    ");

    echo "<p class='text-success mt-3'>Program Added Successfully</p>";
}
?>

<div class="admin-content">

<h2 class="dashboard-heading">Add New Program</h2>

<div class="table-wrapper">
<form method="POST">

<table class="admin-table">

<thead>
<tr>
    <th width="30%">Field</th>
    <th width="70%" style="text-align:center;">Value</th>
</tr>
</thead>

<tbody>

<tr>
    <th>Program Level</th>
    <td>
        <select name="program_level" class="form-control" required>
            <option value="">Select Level</option>
            <option>Undergraduate</option>
            <option>Postgraduate</option>
            <option>Doctoral</option>
        </select>
    </td>
</tr>

<tr>
    <th>Program Name</th>
    <td>
        <input type="text" name="program_name" class="form-control" required>
    </td>
</tr>

<tr>
    <th>Specialization</th>
    <td>
        <input type="text" name="specialization" class="form-control">
    </td>
</tr>

<tr>
    <th>Duration</th>
    <td>
        <input type="text" name="duration" class="form-control"
               placeholder="4 Years / 8 Semesters">
    </td>
</tr>

<tr>
    <th>Fees (&#8377;)</th>
    <td>
        <input type="number" name="fees" class="form-control">
    </td>
</tr>

<tr>
    <td colspan="2" class="action-row">
        <button type="submit" name="save" class="btn-success-sm">
            Save Program
        </button>

        <a href="view.php" class="btn-danger-sm">
            Cancel
        </a>
    </td>
</tr>

</tbody>
</table>

</form>
</div>

</div>

<?php include("../includes/admin_footer.php"); ?>
