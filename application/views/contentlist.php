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
                        Content List
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>   -->
                    <header class="panel-heading">
                        <div class="col-sm-12">
                        <div class="col-sm-10 no-margin" style="padding-left:0;">
                         <h4>Content List   </h4> </div>
                        <div class="col-sm-2">
                        <div class="pull-left"></div>

                         </div>
                         
                         </div> <div class="clearfix"></div>           
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  id="example" class="display table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Description</th>
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
                    "ajax": "<?php echo base_url('content/get_all_content_list'); ?>",
                    "columnDefs": [ {
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<a data-toggle='modal' class='todo-edit' href='#'><i class='ico-pencil'></i></a>"
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
        var url="<?php echo base_url('content/edit_content/'); ?>"+'/'+data[0];
        window.location=url;   
    } );
 /*   $('#example tbody').on( 'click', '.todo-remove', function () {
        var data = table.row( $(this).parents('tr') ).data();
        result=confirm("Would you like to proceed ?");
        if(result){
            $.ajax({
                      url: "< ?php echo base_url('content/delete_content'); ?>",
                      cache: false,
                      type: 'POST',
                      dataType:'text',
                      data : 'id='+data[0],
                      success: function(msg){
                        alert(msg);
                        window.location="< ?php echo base_url('content/get_content_list'); ?>";
                      }
                });    
        }
    } );  */
});
</script>