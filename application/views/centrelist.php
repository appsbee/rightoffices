<!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                 <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Centre List
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  id="example" class="display table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Description</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    </tfoot>
                    </table>
                    </div>
                    </div>
                </section>
                 <!-- Modal -->
                            <div class="modal fade" id="abcd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
                                <div class="modal-dialog" style="width:1000px;">
                                    <div class="modal-content" >
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Centre Details</h4>
                                        </div>
                                        <div class="modal-body" id="centredata" style="max-height: 500px; overflow-y: scroll;">
                                        </div>
                                        <div class="modal-footer">
                                            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                            <!-- <button class="btn btn-success" type="button">Save changes</button>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal -->
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
                    "ajax": "<?php echo base_url('centre/get_all_centre_list'); ?>",
                    "columnDefs": [ {
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<a class='btn btn-success test' data-toggle='modal' href='#abcd'>View</a>"
                     } ]

                });
        $('#example tbody').on( 'click', '.test', function () {
            var data = table.row( $(this).parents('tr') ).data();
            var CenterId= data[0];
            var Centrecontent="";
            var json;
            $.ajax({
                      url: "<?php echo base_url('centre/get_centre_details'); ?>",
                      cache: false,
                      type: 'POST',
                      dataType:'text',
                      data : 'CenterId='+CenterId,
                      success: function(response){
                      json = $.parseJSON(response);
                      if(json){
                          Centrecontent+='<table class="table table-bordered">';
                              $.each( json, function( key, value ) {
                                        if(key){
                                        Centrecontent+='<tr >';
                                        Centrecontent+='<td>'+key+'</td>';
                                        Centrecontent+='<td>'+value+'</td>';
                                        Centrecontent+='</tr>';
                                        }
                                  });
                             Centrecontent+='</table>';
                             $('#centredata').html(Centrecontent);
                            }    
                     }
                }); 
    } );
  /*  $('.test').click(function(){
        var CenterId= $(this).attr('name');
        var Centrecontent="";
        var json;
          $.ajax({
                      url: "< ?php echo base_url('centre/get_centre_details'); ?>",
                      cache: false,
                      type: 'POST',
                      dataType:'text',
                      data : 'CenterId='+CenterId,
                      success: function(response){
                      json = $.parseJSON(response);
                      if(json){
                          Centrecontent+='<table class="table table-bordered">';
                              $.each( json, function( key, value ) {
                                        if(key){
                                        Centrecontent+='<tr >';
                                        Centrecontent+='<td>'+key+'</td>';
                                        Centrecontent+='<td>'+value+'</td>';
                                        Centrecontent+='</tr>';
                                        }
                                  });
                             Centrecontent+='</table>';
                             $('#centredata').html(Centrecontent);
                            }    
                     }
                });    
    }); */
});
</script>            
            
            
            