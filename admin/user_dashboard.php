<?php 
    // Scripts for the dashboard overview
    $user_id = $_SESSION['user']['user_id'];
    
    // all complain
    $user_complain = $conn->query("select * from complain where complainant_id = $user_id");
    $user_complain_counts = $user_complain->num_rows;

    // Pending complain
    $user_pending_complain = $conn->query("select * from complain where complainant_id = $user_id and status = 'Pending'");
    $user_pending_complain_counts = $user_pending_complain->num_rows;

?>


<div class="container-fluid">
<div class="breadcrumb d-flex">
    <p>User / <a href="">Overview</a></p>
</div>
<div class="row py-3">
        <div class="col-md-6">
            <div class="card card-success">
                <div class="card-header">
                    <div>
                        <i class="fa fa-list-ol fa-3x pull-left"></i>
                    </div>
                    <div class="pull-right">
                        <h1 class="text-right"><?php echo $user_complain_counts ?></h1>
                        <h3 class="text-right">Complains</h3>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="user_complains.php" class="stretched-link">View more</a>    
                    <i class="fa fa-angle-double-right pull-right"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-warning">
                <div class="card-header">
                    <div>
                        <i class="fa fa-clock-o fa-3x pull-left"></i>
                    </div>
                    <div class="pull-right">
                        <h1 class="text-right"><?php echo $user_pending_complain_counts ?></h1>
                        <h3 class="text-right">Pending</h3>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="user_complains.php" class="stretched-link">View more</a>    
                    <i class="fa fa-angle-double-right pull-right"></i>
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
            labels: ['Complains', 'Pending'],
            datasets:[{
                label:'Counts',
                data:[
                    <?php echo $user_complain_counts ?>,
                    <?php echo $user_pending_complain_counts ?>
                ],
                backgroundColor:[
                    'green',
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
            labels:['Complain','Pending'],
            datasets:[{
                label:'Counts',
                data:[
                    <?php echo $user_complain_counts ?>,
                    <?php echo $user_pending_complain_counts ?>
                ],
                backgroundColor:[
                    'green',
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
				
		
		
