<style>
   .txt{
   font-weight: 200;
   }
   th{text-align: center;}
   td{text-align: center;}
</style>
<div class="main-panel">
   <div class="content">
      <div class="col-md-12">

         <div class="card">
            <div class="content">
               <div class="row">
                  <div class="col-md-12">
                     <div class="">
                        <div class="">
                             <h4 class="title">Monthwise Class Attendance</h4><br>
                           <div class="fresh-datatables">
                              <table id="bootstrap-table" class="table">
                                 <thead>
                                    <th data-field="id">S.No</th>
                                    <th data-field="year"  data-sortable="true">Class Name</th>
                                    <th data-field="status"  data-sortable="true">Class Strength</th>
                                    <th data-field="Section" data-sortable="true">Actions</th>
                                 </thead>
                                 <tbody>
                                    <?php
                                       $i=1;
                                       foreach ($res as $rows) {
                                       ?>
                                    <tr>
                                       <td><?php echo $i; ?></td>
                                       <td><?php echo $rows->class_name.'&nbsp;'.$rows->sec_name; ?></td>
                                       <td><?php echo $rows->total_count;  ?></td>
                                       <td><a href="<?php echo base_url(); ?>adminattendance/month_view_class/<?php echo $rows->class_id;  ?>" class="btn btn-default">VIEW</a></td>
                                    </tr>
                                    <?php $i++; } ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">

$('#bootstrap-table').DataTable();
         $('#attend').addClass('collapse in');
         $('#attendance').addClass('active');
         $('#attend2').addClass('active');
</script>
