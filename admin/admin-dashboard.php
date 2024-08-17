<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    


<?php
    require_once 'package/admin-header.php';
    require_once 'package/admin-db.php';
    $count = new Admin();

?>

<div class="row">
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center fw-bold d-flex justify-content-between">
            <div class="card bg-primary" style="width: 24%;">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <div class="display-4"><?php echo $count->totalCount('users'); ?></div>
                </div>
            </div>
            <div class="card bg-warning" style="width: 24%;">
                <div class="card-header">Verified Users</div>
                <div class="card-body">
                    <div class="display-4"><?= $count->countVerified(1); ?></div>
                </div>
            </div>
            <div class="card bg-success" style="width: 24%;">
                <div class="card-header">Unverified Users</div>
                <div class="card-body">
                    <div class="display-4"><?= $count->countVerified(0); ?></div>
                </div>
            </div>
            <div class="card bg-danger" style="width: 24%;">
                <div class="card-header">Website Views</div>
                <div class="card-body">
                    <div class="display-4">
                        <?php $data = $count->visitor(); echo $data['hits']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card-deck mt-3 text-light text-center fw-bold d-flex justify-content-between">
            <div class="card bg-danger" style="width: 32%;">
                <div class="card-header">Total Notes</div>
                <div class="card-body">
                    <div class="display-4"><?= $count->totalCount('notes'); ?></div>
                </div>
            </div>
            <div class="card bg-secondary" style="width: 32%;">
                <div class="card-header">Total Feedbacks</div>
                <div class="card-body">
                    <div class="display-4"><?= $count->totalCount('feedbacks'); ?></div>
                </div>
            </div>
            <div class="card bg-info" style="width: 32%;">
                <div class="card-header">Total Notifications</div>
                <div class="card-body">
                    <div class="display-4"><?= $count->totalCount('notifications'); ?></div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<div class="row d-flex justify-content-between">
    <div class="col-lg-6">
        <div class="card my-3 border border-1 ">
        <div class="card-deck text-light text-center fw-bold" >
            <div class="card bg-success rounded-0" >
                <div class="card-header">Male/Female User's Percentage</div>
                <div class="bg-white" id="chartOne" style="width: 100%; height: 400px; "></div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card my-3 border border-1 ">
        <div class="card-deck text-light text-center fw-bold" >
            <div class="card bg-dark rounded-0" >
                <div class="card-header">Verified/Unverified User's Percentage</div>
                <div class="bg-white" id="chartTwo" style="width:100%; height: 400px;"></div>
            </div>
        </div>
        </div>
    </div>
</div>


        </div>
    </div>
</div>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
      
        var data = google.visualization.arrayToDataTable([
            ['Gender','Number'],
            <?php
            $gender = $count->genderPer();
                foreach($gender as $row){
                    echo '["'.$row['gender'].'",'.$row['number'].'],';
                }
            ?>
        ]);

        var options = {
          title: 'My Daily Activities',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('chartOne'));
        chart.draw(data, options);
      }

      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(colChart);
      function colChart() {
        var data = google.visualization.arrayToDataTable([
         ['Verified','Number'],
         <?php
            $verified = $count->verifiedPer();
            foreach($verified as $row){
                if($row['verified'] == 0){
                    $row['verified']= "Unverified";
                }else{
                    $row['verified'] = "Verified";
                }
                echo '["'.$row['verified'].'",'.$row['number'].'],';
            }
         ?>
        ]);

        var options = {
          title: 'View all gender!',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('chartTwo'));
        chart.draw(data, options);
      }
      checkNotification();
        // check Notification 
        function checkNotification(){
            $.ajax({
                url: "package/admin-action.php",
                type: "POST",
                data: {action: "checkNotification"},
                success: function(response){
                    $("#checkAlertNotification").html(response);
                }
            });
        }


    </script>

</body>
</html>