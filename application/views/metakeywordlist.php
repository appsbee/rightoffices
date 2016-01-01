<!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                 <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                        <?php if ($this->session->flashdata('msgtype') && $this->session->flashdata('msgtype')=='success'){?>
                <div class="alert alert-success alert-block fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <?php echo $this->session->flashdata('msg'); ?>
                </div>
                <?php }?> 
                  <!--  <header class="panel-heading">
                        Metakeyword List  <a  href='<?php echo base_url('metakeyword/add_metakeyword');?>' class='btn btn-success' style="margin-left: 800px;">Add</a>
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header> -->
                    <header class="panel-heading">
                        <div class="col-sm-12">
                        <div class="col-sm-10 no-margin" style="padding-left:0;">
                        <h4>Metakeyword List</h4></div>
                        <div class="col-sm-2">
                        <div class="pull-left"><a  href='<?php echo base_url('metakeyword/add_metakeyword');?>' class='btn btn-success'>Add</a>  </div>

                         </div>
                         
                         </div> <div class="clearfix"></div>           
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  id="example" class="display table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Page</th>
                        <th>Keyword</th> 
                        <th>Content</th>
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
        var table=$('#example').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "<?php echo base_url('metakeyword/get_all_metakeyword_list'); ?>",
                    "columnDefs": [ {
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<a data-toggle='modal' class='todo-edit' href='#'><i class='ico-pencil'></i></a><a class='todo-remove' href='#' style='margin-left:20px;'><i class='ico-close'></i></a>"
                     } ]

                });
        var dtable = $("#example").dataTable().api();
        $(".dataTables_filter input")
            .unbind() 
            .bind("input", function(e) { 
                if(this.value.length >= 3 || e.keyCode == 13) {
                    dtable.search(this.value).draw();
                }
                if(this.value == "") {
                    dtable.search("").draw();
                }
                return;
            });
     $('#example tbody').on( 'click', '.todo-edit', function () {
        var data = table.row( $(this).parents('tr') ).data();
        var url="<?php echo base_url('metakeyword/edit_metakeyword/'); ?>"+'/'+data[0];
        window.location=url;   
    } );
   $('#example tbody').on( 'click', '.todo-remove', function () {
        var data = table.row( $(this).parents('tr') ).data();
        result=confirm("Would you like to proceed ?");
        if(result){
            $.ajax({
                      url: "<?php echo base_url('metakeyword/delete_metakeyword'); ?>",
                      cache: false,
                      type: 'POST',
                      dataType:'text',
                      data : 'id='+data[0],
                      success: function(msg){
                        alert(msg);
                        window.location="<?php echo base_url('metakeyword/get_metakeyword_list'); ?>";
                      }
                });    
        }
    }); 
});
</script>