<?php 
require_once('authentication.php');
include('includes/header.php'); 
include('./includes/sidebar.php'); 
?>

<main id="main" class="main" data-aos="fade-down">
    <div class="pagetitle">
        <h1>Report</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=".">Home</a></li>
                <li class="breadcrumb-item active">Report</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link <?=$page == 'report' || $page == 'report_faculty' ? 'active': '' ?>" href="report">All Transaction</a>
                            </li>
                            <li class="nav-item border border-info border-start-0 rounded-end">
                                <a class="nav-link <?=$page == 'report_penalty' ? 'active': '' ?>" href="report_penalty">Penalty Report</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="nav-item">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#student-tab-pane">Students</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#faculty-tab-pane">Faculty Staff</button>
                                </li>
                            </ul>
                            <div class="tab-content mt-3" id="myTabContent">
                                <div class="tab-pane fade show active" id="student-tab-pane">
                                    <table class="display nowrap student-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Book Title</th>
                                                <th>Task</th>
                                                <th>Person In Charge</th>
                                                <th>Date Transaction</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result = mysqli_query($con,"SELECT * from report 
                                            LEFT JOIN book ON report.book_id = book.book_id 
                                            LEFT JOIN user ON report.user_id = user.user_id
                                            order by report.report_id DESC ");
                                            while ($row = mysqli_fetch_array($result)) {
                                                if (isset($row['user_id'])) {
                                                    $user_name = $row['firstname']." ".$row['lastname'];
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $user_name; ?></td>
                                                        <td style="width:20px;"><?php echo $row['title']; ?></td>
                                                        <td><?php echo $row['detail_action']; ?></td>
                                                        <td><?php echo $row['admin_name']; ?></td>
                                                        <td><?php echo date("M d, Y h:i:s a", strtotime($row['date_transaction'])); ?></td>
                                                    </tr>
                                                    <?php 
                                                }
                                            } 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="faculty-tab-pane">
                                    <table class="display nowrap faculty-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Book Title</th>
                                                <th>Task</th>
                                                <th>Person In Charge</th>
                                                <th>Date Transaction</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result = mysqli_query($con,"SELECT * from report 
                                            LEFT JOIN book ON report.book_id = book.book_id 
                                            LEFT JOIN faculty ON report.faculty_id = faculty.faculty_id
                                            order by report.report_id DESC ");
                                            while ($row = mysqli_fetch_array($result)) {
                                                if (isset($row['faculty_id'])) {
                                                    $faculty_name = $row['firstname']." ".$row['lastname'];
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $faculty_name; ?></td>
                                                        <td style="width:20%;"><?php echo $row['title']; ?></td>
                                                        <td><?php echo $row['detail_action']; ?></td>
                                                        <td><?php echo $row['admin_name']; ?></td>
                                                        <td><?php echo date("M d, Y h:i:s a", strtotime($row['date_transaction'])); ?></td>
                                                    </tr>
                                                    <?php 
                                                }
                                            } 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize DataTable for both student and faculty tables
        const studentTable = new DataTable('.student-table', {
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            layout: {
                topStart: {
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                }
            }
        });

        const facultyTable = new DataTable('.faculty-table', {
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            layout: {
                topStart: {
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                }
            }
        });
    });
</script>

<?php 
include('./includes/footer.php');
include('./includes/script.php');
include('../message.php');   
?>
