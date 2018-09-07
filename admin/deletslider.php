<?php 
    $filepath = realpath(dirname(__FILE__)); 
    include '$filepath./../../lib/Session.php';
    Session::checkSession();
?>
<?php 
    $filepath = realpath(dirname(__FILE__)); 
    include '$filepath./../../config/config.php';
    include '$filepath./../../lib/Database.php';
?>
<?php 
    $db = new Database();
 ?>

 <?php 
    if (!isset($_GET['deletsliderid']) || $_GET['deletsliderid'] == NULL) {
        echo "<script>window.location = 'sliderlist.php'; </script>";     
    } else {
        $sliderid = $_GET['deletsliderid'];
        $query = "select * from tbl_slider where id = '$sliderid'";
        $deletimg = $db->select($query);
        if ($deletimg) {
        	while ($result = $deletimg->fetch_assoc()) {
        		$delimg = $result['image'];
        		unlink($delimg);
        	}
        }

        $delquery = "delete from tbl_slider where id = '$sliderid'";
        $delslider = $db->delete($delquery);
        if ($delslider) {
        	echo "<script>alert('Data Deleted Successfully.');</script>";
        	echo "<script>window.location = 'sliderlist.php'; </script>";
        }else{
        	echo "<script>alert('Data Not Deleted.');</script>";
        	echo "<script>window.location = 'sliderlist.php'; </script>";
        }
    }  
?>