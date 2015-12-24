<!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Admin List
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">     <!--  id="dynamic-table"   class="display table table-bordered table-striped"-->
                    <table  id="example" class="display table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>   
                        <th>Email</th>
                        <th>Name</th>
                        <th>Phone No</th>
                        <th>Action</th>   
                       
                    </tr>
                    </thead>
                    <tfoot>
                        
                    </tfoot>
                    </table>
                    </div>
                    </div>
                </section>
            </div>
        </div>                   
                </section>
            </section>
            <!--main content end-->
            
<script>
$(document).ready(function(){
    
    /*$('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {
                "url": "< ?php echo base_url('admin/get_all_admin_list'); ?>", //<--- place dataSrc here instead
                "type": "POST"
                }
    } );   */
    var table=$('#example').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "<?php echo base_url('admin/get_all_admin_list'); ?>",
                    "columnDefs": [ {
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<a data-toggle='modal' class='todo-edit' href='#'><i class='ico-pencil'></i></a><a class='todo-remove' href='#' style='margin-left:20px;'><i class='ico-close'></i></a>"
                     } ]

                });
     $('#example tbody').on( 'click', '.todo-remove', function () {
        var data = table.row( $(this).parents('tr') ).data();
        result=confirm("Would you like to proceed ?");
        if(result){
            $.ajax({
                      url: "<?php echo base_url('admin/delete_admin'); ?>",
                      cache: false,
                      type: 'POST',
                      dataType:'text',
                      data : 'user_id='+data[0],
                      success: function(msg){
                        alert(msg);
                        window.location="<?php echo base_url('admin/get_admin_list'); ?>";
                      }
                });    
        }
    } );
     $('#example tbody').on( 'click', '.todo-edit', function () {
        var data = table.row( $(this).parents('tr') ).data();
        var url="<?php echo base_url('admin/edit_admin/'); ?>"+'/'+data[0];
        window.location=url;   
    } );
    
   /* $('.todo-remove').click(function(){
        var result;
       // var user_id=$(this).attr('name');
        result=confirm("Would you like to proceed ?");
        if(result){
            $.ajax({
                      url: "<?php echo base_url('admin/delete_admin'); ?>",
                      cache: false,
                      type: 'POST',
                      dataType:'text',
                      data : 'user_id='+user_id,
                      success: function(msg){
                        alert(msg);
                        window.location="<?php echo base_url('admin/get_admin_list'); ?>";
                      }
                });    
        }
    }); */
});
</script>