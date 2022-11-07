<?php
include('top.php');

if( isset($_GET['type']) && $_GET['type'] !=='' && isset($_GET['id']) && $_GET['id'] !=='' ) {
    $type=get_safe_value($_GET['type']);
    $id=get_safe_value($_GET['id']);
    if($type=='delete'){
        mysqli_query($con,"delete from contact_us where id='$id'");
        redirect('contact_us.php');
    }
}
$sql="select * from contact_us order by id";
$res=mysqli_query($con,$sql);

?>

<div class="card">
  <div class="card-body">
    <h2 class="grid_title">Contact Us</h2>
    <div class="row grid_box">
      <div class="col-12">
        <div class="table-responsive">
          <table id="order-listing" class="table">
            <thead>
              <tr>
                <th width="10%">S.No #</th>
                <th width="10%">Name</th>
                <th width="10%">Email</th>
                <th width="10%">Mobile</th>
                <th width="19%">Subject</th>
                <th width="40%">Message</th>
                <th width="10%">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if(mysqli_num_rows($res)>0) :
                $i=1;
                while($row=mysqli_fetch_assoc($res)) : ?> 
                  <tr>
                    <td><?= $i ?></td>
                    <td><?= $row['name']?></td>
                    <td><?= $row['email']?></td>
                    <td><?= $row['mobile']?></td>
                    <td><?= $row['subject']?></td>
                    <td><?= $row['message']?></td>
                    <td>
                        <a href="?id=<?= $row['id']?>&type=delete"><label class="badge badge-danger delete_red hand_cursor">Delete</label></a>
                    </td>
                  </tr>
                <?php
                  $i++;
                endwhile;
              else : ?>
                <tr>
                    <td colspan="5">No data found</td> 
                </tr>
              <?php 
              endif;
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
        
<?php
include('footer.php');
?>