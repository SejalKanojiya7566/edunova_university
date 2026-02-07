<?php
include("../includes/admin_header.php");
include("../../config/db.php");

function getCount($conn,$table){
    $check = mysqli_query($conn,"SHOW TABLES LIKE '$table'");
    if(mysqli_num_rows($check)==1){
        $q = mysqli_query($conn,"SELECT COUNT(*) total FROM $table");
        return mysqli_fetch_assoc($q)['total'];
    }
    return 0;
}

$enquiries    = getCount($conn,"enquiries");
$admissions   = getCount($conn,"admissions");
$scholarships = getCount($conn,"scholarships");
?>

<?php include("../includes/admin_sidebar.php"); ?>

<div class="admin-content">
    <h4 class="mb-4 fw-bold">Dashboard Overview</h4>

    <div class="row g-4">

        <!-- Enquiries -->
        <div class="col-md-4">
            <div class="stat-card d-flex justify-content-between align-items-center">
                <div>
                    <small>Total Enquiries</small>
                    <h2><?= $enquiries ?></h2>
                </div>
                <i class="fas fa-envelope stat-icon"></i>
            </div>
        </div>

        <!-- Admissions -->
        <div class="col-md-4">
            <div class="stat-card d-flex justify-content-between align-items-center">
                <div>
                    <small>Total Admissions</small>
                    <h2><?= $admissions ?></h2>
                </div>
                <i class="fas fa-user-graduate stat-icon"></i>
            </div>
        </div>

        <!-- Scholarships -->
        <div class="col-md-4">
            <div class="stat-card d-flex justify-content-between align-items-center">
                <div>
                    <small>Scholarships</small>
                    <h2><?= $scholarships ?></h2>
                </div>
                <i class="fas fa-award stat-icon"></i>
            </div>
        </div>

    </div>
</div>

<?php include("../includes/admin_footer.php"); ?>
