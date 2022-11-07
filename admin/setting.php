<?php 
include('top.php');

if(isset($_POST['submit'])){
	$website_close=get_safe_value($_POST['website_close']);
	$website_close_msg=get_safe_value($_POST['website_close_msg']);
	
	mysqli_query($con,"update setting set website_close='$website_close', website_close_msg='$website_close_msg' where id='1'");
}

$row=mysqli_fetch_assoc(mysqli_query($con,"select * from setting where id='1'"));

$website_close=isset($row) ? $row['website_close'] : null;
$website_close_msg=isset($row) ? $row['website_close_msg'] : null;

$websiteCloseArr=array('No','Yes');
?>
        <div class="row">
			<h1 class="grid_title ml10 ml15">Setting</h1>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" method="post">   
					<div class="form-group">
                      <label for="exampleInputEmail3" required>Website Close</label>
                      <select name="website_close" class="form-control">
						<option value="">Select Option</option>
						<?php foreach($websiteCloseArr as $key=>$val){
							if($website_close==$key){
								echo "<option value='$key' selected='selected'>$val</option>";
							}else{
								echo "<option value='$key'>$val</option>";
							}
						} ?>	
					  <select>
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail3" required>Website Close Msg</label>
                      <input type="textbox" class="form-control" placeholder="Website close msg" name="website_close_msg"  value="<?php echo $website_close_msg?>">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>
            
		 </div>



<?php 
include('footer.php');
?>