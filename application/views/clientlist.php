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
          <!-- <header class="panel-heading">
            Client List
            <table>
              <form method="POST" action="< ?php echo base_url('client/client_search');?>">
                <tr>
                  <td>Start Date</td><td><input type="text" name="start_date" id="start_date" /></td>
                  <td>End Date</td><td><input type="text" name="end_date" id="end_date" /></td>
                  <td></td><td><input type="submit" name="submit" id="submit" value="Search" /></td>
                </tr>
              </form>
            </table>
            <span class="tools pull-right">
              <a href="javascript:;" class="fa fa-chevron-down"></a>
              <a href="javascript:;" class="fa fa-cog"></a>
              <a href="javascript:;" class="fa fa-times"></a>
            </span>
          </header> -->
          <header class="panel-heading">
            <div class="col-sm-12">
              <div class="col-sm-10 no-margin" style="padding-left:0;">
                <h4>Client List </h4>
                <form>
                  <tr>
                    <td>Start Date</td><td><input type="text" name="start_date" id="start_date" /></td>
                    <td>End Date</td><td><input type="text" name="end_date" id="end_date" /></td>
                    <td></td><td><input type="button" name="submit" id="clientsearch" value="Search" /></td>
                  </tr>
                </form>
              </div>
              <div class="col-sm-2">
                <div class="pull-left"> </div>
              </div>              
              </div> <div class="clearfix"></div>
            </header>
            <div class="panel-body">
              <div class="adv-table">
                <div class="clearfix">
                  <div class="btn-group pull-right">
                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right">
                      <li><a href="#abcd" class='dash' name='1' data-toggle='modal'>With selected email</a></li>
                    </ul>
                  </div>
                </div>
                <div class="space15"></div>
                <table   id="example" class="display table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>No</th>
                      <th>Firstname</th>
                      <th>Lastname</th>
                      <th>Email</th>
                      <th>Company</th>
                      <th>Date</th>
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
  
  <!-- Modal client details -->
  <div class="modal fade" id="clientview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width:1000px;">
      <div class="modal-content" >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Client Details</h4>
        </div>
        <div class="modal-body" id="clientdata" style="max-height: 500px; overflow-y: scroll;">
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
          <!-- <button class="btn btn-success" type="button">Save changes</button>-->
        </div>
      </div>
    </div>
  </div>
  <!-- modal -->
  
  
  
  <!-- Modal email -->
  <div class="modal fade" id="abcd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width:1000px;">
      <div class="modal-content" >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Send Email</h4>
          <div class="modal-body" id="centredata" style="max-height: 500px; overflow-y: scroll;">
            <!-- Mail form-->
            <div class="panel-body">
              <div class="position-center">
                <form role="form" name='mailform'>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Message</label>
                    <textarea class="form-control" id="msg" name="msg" placeholder="Message"></textarea>
                  </div>
                  <input type="hidden" name="user_id" id="user_id" value="" />
                  <input type="hidden" name="formtype" id="formtype" value="popup" />
                  <button type="button" class="btn btn-info" id='sendemail'>Send</button>
                </form>
              </div>
            </div>
            <!-- Mail form-->
          </div>
          <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
            <!-- <button class="btn btn-success" type="button">Save changes</button>-->
          </div>
        </div>
      </div>
    </div>
    <!-- modal -->
    <!--main content end-->
    <script>
    $(document).ready(function() {
      var table = $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
          url: "<?php echo base_url('client/get_all_client_list'); ?>",
          data: function(d) {
            d.start_date = $('#start_date').val();
            d.end_date = $('#end_date').val();
          }
        },
        "columnDefs": [{
          "targets": -1,
          "defaultContent": "<a data-toggle='modal' class='todo-edit' href='#'><i class='ico-pencil'></i></a><a class='todo-remove' href='#' style='margin-left:20px;'><i class='ico-close'></i></a><a class='clientview' data-toggle='modal' href='#clientview' style='margin-left:20px;'><i class='glyphicon glyphicon-list'></i></a>"
        }]

      });

      var dtable = $("#example").dataTable().api();
      $(".dataTables_filter input")
        .unbind()
        .bind("input", function(e) {
          if (this.value.length >= 3 || e.keyCode == 13) {
            dtable.search(this.value).draw();
          }
          if (this.value == "") {
            dtable.search("").draw();
          }
          return;
        });

      $('#example tbody').on('click', '.todo-remove', function() {
        var data = table.row($(this).parents('tr')).data();
        result = confirm("Would you like to proceed ?");
        if (result) {
          $.ajax({
            url: "<?php echo base_url('client/delete_client'); ?>",
            cache: false,
            type: 'POST',
            dataType: 'text',
            data: 'user_id=' + data[1],
            success: function(msg) {
              alert(msg);
              window.location = "<?php echo base_url('client/get_client_list'); ?>";
            }
          });
        }
      });

      $('#example tbody').on('click', '.todo-edit', function() {
        var data = table.row($(this).parents('tr')).data();
        var url = "<?php echo base_url('client/edit_client/'); ?>" + '/' + data[1];
        window.location = url;
      });

      $('#example tbody').on('click', '.clientview', function() {
        var data = table.row($(this).parents('tr')).data();
        var id = data[1];
        var Clientcontent = "";
        var json;
        $.ajax({
          url: "<?php echo base_url('client/get_client_all_details'); ?>",
          cache: false,
          type: 'POST',
          dataType: 'text',
          data: 'id=' + id,
          success: function(response) {
            json = $.parseJSON(response);
            if (json) {
              Clientcontent += '<table class="table table-bordered">';
              $.each(json, function(key, value) {
                if (key != 'password' && key != 'status') {
                  Clientcontent += '<tr >';
                  Clientcontent += '<td>' + key + '</td>';
                  Clientcontent += '<td>' + value + '</td>';
                  Clientcontent += '</tr>';
                }
              });
              Clientcontent += '</table>';
              $('#clientdata').html(Clientcontent);
            }
          }
        });
      });

      $("#start_date").datepicker({
        dateFormat: 'yy-mm-dd'
      });

      $("#end_date").datepicker({
        dateFormat: 'yy-mm-dd'
      });

      $('#clientsearch').click(function() {
        table.draw();
      });

      /*    $.fn.dataTable.ext.search.push( function( oSettings, aData, iDataIndex ) {
      var fromDateG = $('#start_date').val();
      var toDateG = $('#end_date').val();
      var iDate=aData[6];
      if ( fromDateG == "" && toDateG == "" ){
      return true;
      }else if ( fromDateG == "" && iDate < toDateG ){
      return true;
      }else if ( fromDateG <= iDate && toDateG == ""  ){
      return true;
      }else if ( fromDateG <= iDate && iDate <= toDateG ){
      return true;
      }
      return false;
      });*/
      $('.dash').click(function() {
        var name = this.name;
        var id = new Array();
        if (name == 1) {
          $('input[name="mail"]:checked').each(function() {
            id.push(this.value);
          });
        }
        $('#user_id').val(id.toString());
      });
      $('#sendemail').click(function() {
        var form = $('form').get(0);
        var user_id = $('#user_id').val();
        var sub = $('#subject').val();
        var msg = $('#msg').val();
        if (sub == '' || sub === null) {
          alert('Please enter subject');
          document.mailform.subject.focus();
          return false;
        }
        if (msg == '' || msg === null) {
          alert('Please enter message');
          document.mailform.msg.focus();
          return false;
        }
        if (user_id == '' || user_id === null) {
          alert('Please select client to send mail');
          return false;
        }
        $.ajax({
          type: "POST",
          data: new FormData(form),
          contentType: false,
          cache: false,
          processData: false,
          url: "<?php echo base_url('client/send_mail_notification')?>",
          success: function(data) {
            alert(data);
            $("input[name='mail']:checkbox").prop('checked', false);
          },
          error: function(data) {
            alert(data);
          }
        });
      });
    });
    </script>
