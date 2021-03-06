<script>
$(document).ready(function() {
var oTable = $('.dTable').dataTable( {
            "oLanguage": {
        	        "sLengthMenu": "<span class='showentries'>Show entries:</span> _MENU_"
		        },
            "sPaginationType": "full_numbers",
            "sDom": 'r<"tablePars"f<"dataTables_length"<"selector"l>>>t<"tableFooter"ip>',
            "bProcessing": true,
            "bJQueryUI": false,
            "bAutoWidth": false,
            "bServerSide": true,
            "sServerMethod": "POST",
            "sAjaxSource": "<?php echo site_url('users/users_xhr');?>",
            "fnServerParams": function ( aoData ) {
                  aoData.push( { "name": "ajax_request", "value": true } , 
                  { "name" : "<?php echo $this->security->get_csrf_token_name();?>", "value" : "<?php echo $this->security->get_csrf_hash();?>"}
                      );
            }
        });
oTable.fnSetFilteringDelay(1000);
});
</script>

<div class="contentTop">
        <span class="pageTitle"><span class="icon-user-3"></span>User Management</span>
    </div>
    
    <!-- Main content -->
    <div class="wrapper">
        <div class="fluid">
            <div class="grid2">&nbsp;</div>
            <div class="widget grid8">
                <div class="whead"><h6>Table with hidden toolbar</h6></div>
                <div id="dyn" class="hiddenpars">
                    <a class="tOptions" title="Options"><img src="<?php echo base_url();?>images/icons/options" alt="" /></a>
                    <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dynamic">
                        <thead>
                            <tr>
                            	<th width="5%">ID</th>
                    			<th width="15%">Username</th>
                    			<th width="20%">E-Mail</th>
                    			<th width="15%">Full Name</th>
                                <th width="30%"></th>
                    		</tr>
                    	</thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        
        
        
        
        
        </div>
    </div>
    <!-- Main Content End -->