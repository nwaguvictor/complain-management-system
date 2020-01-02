<?php 
    // Scripts for the dashboard overview
    
    // all complain
    $all_complain = $conn->query("select * from complain");
    $all_complain_counts = $all_complain->num_rows;

    // Pending complain
    $pending_complain = $conn->query("select * from complain where status = 'Pending'");
    $pending_complain_counts = $pending_complain->num_rows;

    // all subjects
    $all_subject = $conn->query("select * from subject");
    $all_subject_counts = $all_subject->num_rows;

    // all users
    $all_users = $conn->query("select * from users");
    $all_users_counts = $all_users->num_rows;

?>


<div class="container-fluid">
<div class="breadcrumb d-flex">
    <p>Admin / <a href="">Overview</a></p>
</div>
<div class="row py-3">
    <div class="col-md-3">
        <div class="card card-success">
            <div class="card-header">
                <div>
                    <i class="fa fa-list-ol fa-3x pull-left"></i>
                </div>
                <div class="pull-right">
                    <h1 class="text-right"><?php echo $all_complain_counts ?></h1>
                    <h3 class="text-right">Complains</h3>
                </div>
            </div>

            <div class="card-footer">
                <a href="all_complains.php" class="stretched-link">View more</a>    
                <i class="fa fa-angle-double-right pull-right"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <div>
                    <i class="fa fa-users fa-3x pull-left"></i>
                </div>
                <div class="pull-right">
                    <h1 class="text-right"><?php echo $all_users_counts ?></h1>
                    <h3 class="text-right">Users</h3>
                </div>
            </div>

            <div class="card-footer">
                <a href="users.php" class="stretched-link">View more</a>    
                <i class="fa fa-angle-double-right pull-right"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-danger">
            <div class="card-header">
                <div>
                    <i class="fa fa-list-alt fa-3x pull-left"></i>
                </div>
                <div class="pull-right">
                    <h1 class="text-right"><?php echo $all_subject_counts ?></h1>
                    <h3 class="text-right">Subjects</h3>
                </div>
            </div>

            <div class="card-footer">
                <a href="all_subjects.php" class="stretched-link">View more</a>    
                <i class="fa fa-angle-double-right pull-right"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-warning">
            <div class="card-header">
                <div>
                    <i class="fa fa-clock-o fa-3x pull-left"></i>
                </div>
                <div class="pull-right">
                    <h1 class="text-right"><?php echo $pending_complain_counts ?></h1>
                    <h3 class="text-right">Pending</h3>
                </div>
            </div>

            <div class="card-footer">
                <a href="all_complains.php" class="stretched-link">View more</a>    
                <i class="fa fa-angle-double-right pull-right"></i>
            </div>
        </div>
    </div>
</div>
</div>

<div class="container">
<h2>Charts</h2>
    <div class="row">
        <div class="col-md-6">
            <canvas id="myChart1"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="myChart2"></canvas>
        </div>
    </div>
</div>


<script>
    var myChart = document.getElementById('myChart1').getContext('2d');

    // Global Options
    Chart.defaults.global.defaultFontFamily = 'sans-serif';
    Chart.defaults.global.defaultFontSize = 12;
    Chart.defaults.global.defaultFontColor = '#777';

    var adminChart = new Chart(myChart, {
        type:'bar',
        data:{
            labels: ['Complains', 'Users', 'Subjects', 'Pending'],
            datasets:[{
                label:'Counts',
                data:[
                    <?php echo $all_complain_counts ?>,
                    <?php echo $all_users_counts ?>,
                    <?php echo $all_subject_counts ?>,
                    <?php echo $pending_complain_counts ?>
                ],
                backgroundColor:[
                    'green',
                    'blue',
                    'red',
                    'yellow'
                ]
            }]
        },
        options:{
            legend:{
                display:true,
                position:'right'
                
            }
        }
    });
</script>

<script>
    var myChart = document.getElementById("myChart2").getContext('2d');
    var AdminChart = new Chart(myChart, {
        type:'polarArea',
        data:{
            labels:['Complain','Users','Subjects','Pending'],
            datasets:[{
                label:'Counts',
                data:[
                    <?php echo $all_complain_counts ?>,
                    <?php echo $all_users_counts ?>,
                    <?php echo $all_subject_counts ?>,
                    <?php echo $pending_complain_counts ?>
                ],
                backgroundColor:[
                    'green',
                    'blue',
                    'red',
                    'yellow'
                ]
            }]
        },
        options:{
            legend:{
                display:true,
                position:'right'
                
            }
        }
    });
</script>
				
		
		
