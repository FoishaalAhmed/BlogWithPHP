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
    if (!isset($_GET['deletpostid']) || $_GET['deletpostid'] == NULL) {
        echo "<script>window.location = 'postlist.php'; </script>";     
    } else {
        $postid = $_GET['deletpostid'];
        $query = "select * from tbl_post where id = '$postid'";
        $deletimg = $db->select($query);
        if ($deletimg) {
        	while ($result = $deletimg->fetch_assoc()) {
        		$delimg = $result['image'];
        		unlink($delimg);
        	}
        }

        $delquery = "delete from tbl_post where id = '$postid'";
        $delpost = $db->delete($delquery);
        if ($delpost) {
        	echo "<script>alert('Data Deleted Successfully.');</script>";
        	echo "<script>window.location = 'postlist.php'; </script>";
        }else{
        	echo "<script>alert('Data Not Deleted.');</script>";
        	echo "<script>window.location = 'postlist.php'; </script>";
        }
    }  
?>