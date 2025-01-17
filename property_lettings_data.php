<?php
    require 'functions.php';
    auth();
    require 'dbconfig.php';

    if (!$conn){
        die("Connection failed: ". mysqli_connect_error());
    }
    $query = "SELECT * FROM lettings_properties ORDER BY user_id DESC";
    $init_result = mysqli_query($conn, $query);
    if(isset($_GET['delete_id']))
        {
            $sql_query="DELETE FROM lettings_properties WHERE user_id=".$_GET['delete_id'];
            mysqli_query($conn, $sql_query);
            header("Location: $_SERVER[PHP_SELF]");
        }
?>

<script type="text/javascript">
       
        function edt_id(id) {
            window.location.href = 'edit_lettings_property.php?edit_id=' + id;
        }
        function delete_id(id) {
            if (confirm('Sure to Delete ?')) {
                if(confirm('Confirm twice')){
                    window.location.href = 'property_lettings_data.php?delete_id=' + id;
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
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
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
                <div class="table table-bordered table-striped table-hover">
                    <h2 class = "text-center text-dark pt-2">Lettings Properties</h2>
                    <hr>
                    <input style="font-size: 14px; position: fixed; top:100px; left:100px;" type="submit" value="Finish Selection" " />
                            <table class="table table-bordered table-striped table-hover" style="width:100%;" id="example">
                            <thead>
                                <tr> 
                                    <th></th>
                                    <th style="display:none"></th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                       Address
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Postcode
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Property Level
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Dwelling Type
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Price
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Bedrooms
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Bathrooms
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Receptions
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Garden
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Parking
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Access Through
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Floor Area
                                    </th>
                                    <th style = "font-size: 14px; white-space: nowrap;">
                                        Lettings Availability
                                    </th>
                                    <th>
                                        
                                    </th>
                                    <th>
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($row = mysqli_fetch_assoc($init_result)) {
                                ?>
                                <tr>
                                    <td>
                                        <a href="#" onclick="bollocks('<?=$row["user_id"]?>')"> <img src="https://img.icons8.com/pastel-glyph/2x/plus.png" style="width:20px; height:20px"> </a>
                                    </td>
                                    <td id="bollocks<?=$row['user_id']?>" style="display:none">
                                        
                                        <ul style="list-style-type:none;">
                                            <li style = "font-size: 14px;"><?php echo $row['property_level']." ".$row['dwelling_type']." in ".$row['postcode'] ." for £". $row['price']; ?></li>
                                        </ul>
                                        <ul>
                                            <li style = "font-size: 14px;"><?php echo $row['feature_1']?></li>
                                            <li style = "font-size: 14px;"><?php echo $row['feature_2']?></li>
                                            <li style = "font-size: 14px;"><?php echo $row['feature_3']?></li>
                                            <li style = "font-size: 14px;"><?php echo $row['feature_4']?></li>
                                            <li style = "font-size: 14px;"><?php echo $row['feature_5']?></li>
                                            <li style = "font-size: 14px;"><?php echo $row['feature_6']?></li>
                                            <li style = "font-size: 14px;"><?php echo $row['feature_7']?></li>
                                            <li style = "font-size: 14px;"><?php echo $row['feature_8']?></li>
                                            <li style = "font-size: 14px;"><?php echo $row['feature_9']?></li>
                                            <li style = "font-size: 14px;"><?php echo $row['feature_10']?></li>
                                            <li style = "font-size: 14px;"><?php echo "Outside Space: ".$row['garden']." (".$row['outside_space'].")"?></li>
                                            <li style = "font-size: 14px;"><?php echo "Parking: ".$row['parking']." (".$row['parking_details'].")"?></li>
                                            <li style = "font-size: 14px;"><?php echo "Floor Area: ".$row['floor_area']."m<sup>2</sup>"?></li>
                                            ----------------------------<br>
                                            <text style = "font-size: 14px;"><?php echo "Pets Accepted: ".$row['pets_allowed']?><br>
                                            <?php echo "Children Accepted: ".$row['children_allowed']?><br>
                                            <?php echo "Sharers Accepted: ".$row['sharers_allowed']?><br>
                                            <?php echo "Students Accepted: ".$row['students_allowed']?></text>
                                            <br>----------------------------<br>
                                            <li style = "font-size: 14px;"><?php echo "Access Through: ".$row['access_through']."<br> ".$row['viewing_arrangements_name']."<br>".$row['viewing_arrangements_contact_number']."<br>".$row['viewing_arrangements_notes']?></li>
                                            ----------------------------<br>
                                            <text style = "font-size: 14px;"><?php echo "Landlord Details: ".$row['landlord_fn']." ".$row['landlord_ln']."<br>".$row['landlord_contact']."<br>".$row['landlord_email']?><br>
                                        </ul>
                                        
                                        <a style="align:center;" href="javascript:edt_id('<?php echo $row['user_id']; ?>')"><img src="https://cdn0.iconfinder.com/data/icons/thin-reading-writing/57/thin-001_compose_write_pencil_new-512.png" style="width:20px; height:20px"></a>
                                        <a href="javascript:delete_id('<?php echo $row['user_id']; ?>')"><img src="https://cdn0.iconfinder.com/data/icons/network-technology-2-3/48/72-512.png" style="width:20px; height:20px"></a>
                                       
                                    </td>
                                    <td style = "font-size: 14px; white-space: nowrap;"><?php echo $row['Address1'].$row['Address2'].$row['Address3']; ?></td>
                                    <td style = "font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['postcode']; ?>
                                    </td>
                                    
                                    <td style = "font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['property_level']; ?>
                                    </td>
                                    <td style = "font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['dwelling_type']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['price']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['bedrooms']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                       <?php echo $row['bathrooms']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                       <?php echo $row['receptions']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['garden']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['parking']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['access_through']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['floor_area']; ?>
                                    </td>
                                    <td style="font-size: 14px; white-space: nowrap;">
                                        <?php echo $row['lettings_availability']; ?>
                                    </td>
                                    <td>
                                        <a href="javascript:edt_id('<?php echo $row['user_id']; ?>')"><img src="https://cdn0.iconfinder.com/data/icons/thin-reading-writing/57/thin-001_compose_write_pencil_new-512.png" style="width:20px; height:20px"></a>
                                    </td>
                                    <td>
                                        <a href="javascript:delete_id('<?php echo $row['user_id']; ?>')"><img src="https://cdn0.iconfinder.com/data/icons/network-technology-2-3/48/72-512.png" style="width:20px; height:20px"></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                 
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