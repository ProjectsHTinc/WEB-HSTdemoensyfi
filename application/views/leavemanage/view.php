<div class="main-panel">
  <div class="content">
    <?php if($this->session->flashdata('msg')): ?>
      <div class="alert alert-success">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
    ×</button> <?php echo $this->session->flashdata('msg'); ?>
    </div>

<?php endif; ?>
    <div class="col-md-12">
      <div class="card">
        <div class="header">
            <legend>View  Leaves<span><a href="<?php echo base_url(); ?>leavemanage/home" class="pull-right btn btn-wd" style="margin-top:-10px;">Create Leaves</a></span></legend>

        </div>
        <div class="content">
          <h4 class="title">Regular Holiday</h4><br>
          <table id="bootstrap-table" class="table">
              <thead>
                    <th data-field="id">S.No</th>
                    <th data-field="year">Year</th>
                    <th data-field="no">Day</th>
                    <th data-field="name">week</th>
                    <th data-field="status">Status</th>
                    <th data-field="Section">Actions</th>
              </thead>
              <tbody>
                <?php
                $i=1;
              // print_r($regular);
                foreach ($regular as $rows) {

                ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                      <td><?php echo $rows->leave_year; ?></td>
                      <td><?php echo $rows->days; ?></td>
                        <td><?php echo $rows->week; ?></td>
                      <td><?php  if($rows->status=='Active'){ ?>
                        <button class="btn btn-success btn-fill btn-wd">Active</button>
                    <?php  }else{  ?>
                      <button class="btn btn-danger btn-fill btn-wd">Inactive</button>
                    <?php  } ?></td>
                    <td>
                      <!-- <a rel="tooltip" title="View" class="btn btn-simple btn-info btn-icon table-action view" href="javascript:void(0)"><i class="fa fa-image"></i>
                        </a> -->
                      <a href="<?php echo base_url(); ?>leavemanage/edit/<?php echo $rows->leave_id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                      <a href="<?php echo base_url(); ?>leavemanage/viewdates/<?php echo $rows->leave_id; ?>" rel="tooltip" title="View Dates" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-list-ol" aria-hidden="true"></i></a>



                      <a rel="tooltip" title="" class="btn btn-simple btn-danger btn-icon table-action remove"  data-original-title="Remove" onclick="deleteLeaves(<?php  echo $rows->leave_id; ?>)"><i class="fa fa-remove"></i></a>

                        </td>
                  </tr>
                  <?php $i++;  }  ?>
              </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card">
        <div class="content">
          <h4 class="title">Special Holiday</h4> <br>
          <table id="bootstrap-table1" class="table">
              <thead>
                    <th data-field="id">S.No</th>

                    <th data-field="no">Date</th>
                    <th data-field="name">Title</th>
                    <th data-field="status">Status</th>
                    <th data-field="Section">Actions</th>
              </thead>
              <tbody>
                <?php
                $i=1;
                //print_r($regular);
                foreach ($special as $rows) {

                ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                     
                      <td><?php $date=date_create($rows->leave_date);
                      echo date_format($date,"d-m-Y");  ?></td>
                        <td><?php echo $rows->leaves_name; ?></td>
                        <td><?php  if($rows->status=='Active'){ ?>
                          <button class="btn btn-success btn-fill btn-wd">Active</button>
                      <?php  }else{  ?>
                        <button class="btn btn-danger btn-fill btn-wd">Inactive</button>
                      <?php  } ?></td>
                    <td>

  <a href="<?php echo base_url(); ?>leavemanage/specialedit/<?php echo $rows->id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
  <a rel="tooltip" title="" class="btn btn-simple btn-danger btn-icon table-action remove" href="javascript:void(0)" onclick="functionSpecial(<?php echo $rows->leave_id; ?>)" data-original-title="Remove"><i class="fa fa-remove"></i></a>
</td>
                  </tr>
                  <?php $i++;  }  ?>
              </tbody>
          </table>
        </div>
      </div>
    </div>


  </div>
</div>
<script type="text/javascript">
function deleteLeaves(id){
  swal({
              title: "Are you sure?",
              text: "You wnt to delete this date",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: '#DD6B55',
              confirmButtonText: 'Yes',
              cancelButtonText: "No",
              closeOnConfirm: false,
              closeOnCancel: false
          },
          function(isConfirm) {
              if (isConfirm) {
                $.ajax({
                         type: "POST",
                         url: "<?php echo base_url(); ?>leavemanage/delete_regular",
                         data : {  id : id },
                         success: function(data){
                           //alert(data)
                         if(data=='success'){
                           swal({title: "Done", text: "Deleted Successfully!", type: "success"},
                              function(){
                                  location.reload();
                              }
                           );
                         }else{
                           sweetAlert("Oops...", "Something went wrong!", "error");
                         }
                         }
                     });

              } else {
                  swal("Cancelled", "Process Cancel :)", "error");
              }
          });

}

function functionSpecial(id){
  swal({
              title: "Are you sure?",
              text: "You want to delete this date",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: '#DD6B55',
              confirmButtonText: 'Yes',
              cancelButtonText: "No",
              closeOnConfirm: false,
              closeOnCancel: false
          },
          function(isConfirm) {
              if (isConfirm) {
                $.ajax({
                         type: "POST",
                         url: "<?php echo base_url(); ?>leavemanage/specialdate_delete",
                         data : {  id : id },
                         success: function(data){
                           //alert(data)
                         if(data=='success'){
                           swal({title: "Done", text: "Deleted Successfully!", type: "success"},
                              function(){
                                  location.reload();
                              }
                           );
                         }else{
                           sweetAlert("Oops...", "Something went wrong!", "error");
                         }
                         }
                     });

              } else {
                  swal("Cancelled", "Process Cancel :)", "error");
              }
          });

}



 $('#bootstrap-table').DataTable();
  $('#bootstrap-table1').DataTable();
$('#eventmenu').addClass('collapse in');
$('#event').addClass('active');
$('#leave1').addClass('active');
</script>
