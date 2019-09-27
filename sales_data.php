<?php
    require 'functions.php';
    auth();
    require 'dbconfig.php';

    if (!$conn){
        die("Connection failed: ". mysqli_connect_error());
    }
    $query = "SELECT * FROM sales_applicant ORDER BY id DESC";
    $init_result = mysqli_query($conn, $query);
    if(isset($_GET['delete_id']))
        {
            $sql_query="DELETE FROM sales_applicant WHERE id=".$_GET['delete_id'];
            mysqli_query($conn, $sql_query);
            header("Location: $_SERVER[PHP_SELF]");
        }
?>
<script type="text/javascript">
        function book_viewing(id) {
            window.location.href = 'viewing_sales_handler.php?book_viewing=' + id;
        }
        function edt_id(id) {
            window.location.href = 'edit_sales_applicant_handler.php?sales_client=' + id;
        }
        function property_match(id){
            window.location.href= 'property_matcher.php?property_match=' + id, '_blank' ;
        }
        function delete_id(id) {
            if (confirm('Two step confirmation required to prevent accidental deletion')) {
                if(confirm('Please confirm twice')){
                        window.location.href = 'sales_data.php?delete_id=' + id;
                }
            }
        }
        
        function bollocks(id){
            
            var bollocks = document.getElementById('bollocks'+id);
            
            if (bollocks.style.display=="block")  {
                bollocks.style.display="none"; 
            } else {
                bollocks.style.display="block";
            }
        }    
</script>

<!DOCTYPE html>
<html>
    <head>

        <title>Lettings Applicants</title>
        <link rel="shortcut icon" href="https://image.flaticon.com/icons/png/512/37/37502.png" type="image/x-icon" />
        <!-- this stylesheet contains background colour, table colour, but also disrubts the HEADER.PHP, Try implementing it into other 2. 
        http://iceyboard.no-ip.org/projects/css_compressor/combine
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css"/>
        
       -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/fontawesome/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="css/DTstyle.css"/> 
       
    </head>
    
    <body class="bg-info" style="width:100%">
    
        <?php include "header.php"; ?>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

        <div>
            <div class="table-responsive" style="overflow-x: auto; width:100%;">
                <div class="table table-bordered table-hover">
                    <h2 class = "text-center text-dark pt-2">Sales Applicants</h2>
                    <hr>
                    <form action="functionality_handler2.php" method="POST">
                    <input style="font-size: 14px; position: fixed; top:100px; left:100px;" type="submit" value="Finish Selection" " />
                        <table class="table table-bordered table-hover" style="width:100%;" id="example">
                            <thead>
                                <tr> 
                                
                                    
                                    <th><img src="http://www.myiconfinder.com/uploads/iconsets/256-256-924590246403a197a00e4a64c3e46da4-accept.png" style="width:22px; height:22px"></th>
                                    <th><img src="https://cdn3.iconfinder.com/data/icons/office-set-pack-1/512/12-512.png" style="width:20px; height:20px"></th>
                                    <th><img src="https://image.flaticon.com/icons/png/512/69/69544.png" style="width:20px; height:20px"></th>
                                    <th id="bollocks<?=$row['id']?>" style="display:none">Additional Information </th>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Contact No</th>
                                    <th>Bedrooms</th>
                                    <th>Max Budget</th>
                                    <th>Mortgage Status</th>
                                    <th style="display:none">Special Conditions</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($row = mysqli_fetch_assoc($init_result)) {
                                /*$sql="SELECT * FROM users ORDER BY user_id DESC";
                                $res=$conn->query($sql);
                                while($row=$res->fetch_assoc()){*/
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="functionality[]" value="<?= $row['id'] ?>"></td>
                                    <td>
                                        <?php 
                                            $date = date('Y-m-d');
                                            $strtodata = $row['reg_date'];
                                            $string = date('Y-m-d', strtotime($strtodata));
                                                if ($string == $date){ 
                                                  ?> <i class="fas fa-check"></i> <?php
                                                }
                                        ?>
                                    </td>
                                    
                                    <td>
                                    <a href="#" onclick="bollocks('<?=$row["id"]?>')"> <i class="far fa-plus-square"></i> </a>
                                    </td>
                                    <td id="bollocks<?=$row['id']?>" style="display:none">
                                        <a href="javascript:edt_id('<?php echo $row['id']; ?>')"><i class="far fa-edit"></i></a>
                                        <?php
                                        $date = date("H");
                                        if ($date < "12:00") {
                                            $body = "Good%20Morning%20" . $row['firstname'] . ",%0A%0Afollowing%20your%20property%20enquiry%20in%20regards%20to%20a%20" . $row['bedrooms'] . "%20bedroom%20property%20to%20rent,%20please%20see%20below%20properties%20matching%20your%20criteria.";
                                            $subject = "Property%20Enquiry%20-%20Benson%20and%20Partners";
                                        } else {
                                            $body = "Good%20Afternoon%20" . $row['firstname'] . ",%0A%0Afollowing%20your%20property%20enquiry%20in%20regards%20to%20a%20" . $row['bedrooms'] . "%20bedroom%20property%20to%20rent,%20please%20see%20below%20properties%20matching%20your%20criteria.";
                                            $subject = "Property%20Enquiry%20-%20Benson%20and%20Partners";
                                        } ?>
                                        <a href="mailto:<?php echo $row['email']; ?>?subject=<?php echo $subject ?>&body=<?php echo $body; ?>"><i class="far fa-envelope"></i></a>
                                        <a href="javascript:book_viewing('<?php echo $row['id']; ?>')" style="font-size: 14px; white-space: nowrap;" id="book_viewing_handler">
                                            <i class="far fa-calendar-alt"></i>
                                        </a>
                                        <a href="javascript:property_match('<?php echo $row['id']; ?>')" style="font-size: 14px; white-space: nowrap;" id="property_match">
                                            <i class="fas fa-cogs"></i>
                                        </a>
                                        <a href="javascript:delete_id('<?php echo $row['id']; ?>')"><i class="far fa-trash-alt"></i></a>
                                        <ul >
                                        <li><?=$row['firstname']." ".$row['lastname']?></li>
                                        <li><?=$row['contact_number']?></li>
                                        <li>Budget: <?php echo "£".$row['maximum_budget']?></li>
                                        
                                        </ul>
                                        <br><pre><?=$row['special_conditions']?></pre>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['id'] ?>
                                       
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['title'] ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['firstname'] ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['lastname'] ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['email']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo str_replace(" ","",$row['contact_number']); ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['bedrooms']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['maximum_budget']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php
                                            echo $row['mortgage_status'];
                                        ?>
                                    </td>
                                    <td style="display:none">
                                         <?php echo $row['special_conditions']; ?>  
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <a href="javascript:edt_id('<?php echo $row['id']; ?>')"><i class="far fa-edit"></i></a>                                                            
                                    </td>
                                    <td>
                                        
                                   
                                        <a href="mailto:<?php echo $row['email']; ?>?subject=<?php echo $subject ?>&body=<?php echo $body; ?>"><i class="far fa-envelope"></i></a>
                                    </td>
                                    <td>
                                        <a href="javascript:book_viewing('<?php echo $row['id']; ?>')" style="font-size: 14px; white-space: nowrap;" id="book_viewing_handler">
                                            <i class="far fa-calendar-alt"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:property_match('<?php echo $row['id']; ?>')" style="font-size: 14px; white-space: nowrap;" id="property_match">
                                            <i class="fas fa-cogs"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:delete_id('<?php echo $row['id']; ?>')"><i class="far fa-trash-alt"></i></a>                                                          
                                    </td>
                                </tr>
                                 <?php } ?>
                               
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>   
        </div>
                <script>
                        $('table').DataTable({
                                order:[[3,'desc']],
                                pagingType:'full_numbers',
                                scrollY: '50vh',
                                scrollX: true,
                                scrollCollapse: true,
                                autoFill:true,
                                stateSave: true,
                        });
                </script>
                    
                    
       
    </body>
</html>