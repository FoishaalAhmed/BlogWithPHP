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
    if (!isset($_GET['delpage']) || $_GET['delpage'] == NULL) {
        echo "<script>window.location = 'index.php'; </script>";     
    } else {
        $pageid = $_GET['delpage'];
        $delquery = "delete from tbl_page where id = '$pageid'";
        $delpage = $db->delete($delquery);
        if ($delpage) {
        	echo "<script>alert('Page Deleted Successfully.');</script>";
        	echo "<script>window.location = 'index.php'; </script>";
        }else{
        	echo "<script>alert('Page Not Deleted.');</script>";
        	echo "<script>window.location = 'index.php'; </script>";
        }
    }  
?>