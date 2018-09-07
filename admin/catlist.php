<?php include'inc/header.php'; ?>
<?php include'inc/sideber.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
       <?php 
       		if (isset($_GET['delid'])) {
       			$delId = $_GET['delid'];
       			$query = "delete from tbl_catagory where id = '$delId'";
	            $delcat = $db->delete($query);
	            if ($delcat) {
	                echo "<span class='success'>Category Deleted Successfully!!</span>";
	            } else {
	                echo "<span class='error'>Category Not Deleted!!</span>";
	            }
       		}
       ?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Category Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$query = "select * from tbl_catagory order by id desc";
					$catagory = $db->select($query);

					if ($catagory) {
						$i = 0;
						while ($result = $catagory->fetch_assoc()) {
						$i++;			
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['name']; ?></td>
					
					<td><a href="catedit.php?catid=<?php echo $result['id']; ?>">View</a>
					<?php if (Session::get("userRole") == '0') { ?>
					 ||<a onclick = "return confirm('are you sure to delete??');" href="?delid=<?php echo $result['id']; ?>">Delete</a>
					 <?php } ?>
					</td>
					
				</tr>
				<?php } } ?>
			</tbody>
		</table>
       </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function () {
    setupLeftMenu();

    $('.datatable').dataTable();
    setSidebarHeight();
});
</script>

<?php include'inc/footer.php'; ?>
