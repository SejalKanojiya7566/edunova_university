<?php
session_start();
if(!isset($_SESSION['admin'])){
  header("Location: ../../login.php");
  exit();
}

include("../../config/db.php");
include("../includes/admin_header.php");
include("../includes/admin_sidebar.php");

$result = mysqli_query($conn,"SELECT * FROM scholarships ORDER BY id DESC");
?>

<div class="admin-content">
<h2 class="dashboard-heading">Scholarship Applications</h2>

<div class="table-wrapper">
<table class="admin-table">

<thead>
<tr>
  <th>ID</th>
  <th>Student</th>
  <th>Course</th>
  <th>Category</th>
  <th>Income</th>
  <th>Certificates</th>
  <th>Status</th>
  <th>Date</th>
  <th>Action</th>
</tr>
</thead>

<tbody>
<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>

<td><?= $row['id']; ?></td>

<td>
<b><?= htmlspecialchars($row['name']); ?></b><br>
<small><?= $row['email']; ?><br><?= $row['phone']; ?></small>
</td>

<td><?= $row['course']; ?></td>
<td><?= $row['category']; ?></td>
<td>&#8377;<?= number_format($row['income']); ?></td>

<td>
<a target="_blank"
 href="../../uploads/scholarship/<?= $row['income_certificate']; ?>">
Income</a>

<?php if($row['caste_certificate']){ ?>
 | <a target="_blank"
 href="../../uploads/scholarship/<?= $row['caste_certificate']; ?>">
Caste</a>
<?php } ?>
</td>

<td>
<span class="status-badge <?= strtolower($row['status']); ?>">
<?= $row['status']; ?>
</span>
</td>

<td><?= date("d M Y",strtotime($row['apply_date'])); ?></td>

<td class="action-btns">
<a href="approve.php?id=<?= $row['id']; ?>&status=Approved"
 class="btn-success-sm">Approve</a>

<a href="approve.php?id=<?= $row['id']; ?>&status=Rejected"
 class="btn-warning-sm">Reject</a>

<a href="delete.php?id=<?= $row['id']; ?>"
 onclick="return confirm('Delete?')"
 class="btn-danger-sm">Delete</a>
</td>

</tr>
<?php } ?>
</tbody>

</table>
</div>
</div>

<?php include("../includes/admin_footer.php"); ?>
