<?php include'inc/header.php'; ?>
<?php include'inc/sideber.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="10%">No.</th>
					<th width="30%">Link</th>
					<th width="25%">Title</th>
					<th width="20%">Image</th>
					<th width="15%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$query = "select * from tbl_slider order by id desc ";
					$slider = $db->select($query);
					if ($slider) {
						$i = 0;
						while ($result = $slider->fetch_assoc()) {
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result ['link']; ?></td>
					<td><a href="viewpost.php?viewpostid=<?php echo $result['id']; ?>"><?php echo $result ['title']; ?></a></td>
					<td><img src="<?php echo $result ['image']; ?>" height="40px" width="60px"></td>
					<td>
						<?php if (Session::get("userRole") == '0') { ?>
							<a href="editslider.php?editsliderid=<?php echo $result['id']; ?>">Edit</a> || 
								<a onclick = "return confirm('are you sure to delete??');" href="deletslider.php?deletsliderid=<?php echo $result['id']; ?>">Delete</a>
						<?php	} ?> 
						
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