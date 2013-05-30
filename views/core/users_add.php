    <div class="contentTop">
        <span class="pageTitle"><span class="icon-user-3"></span>Create new user</span>
    </div>
    
    <!-- Main content -->
    <div class="wrapper">
        <?php
        if(strlen(validation_errors()) > 0){
            ?>
             <div class="fluid">
                <div class="grid4">&nbsp;</div>
                <div class="grid4 nNote nWarning">
            <?php
                echo(validation_errors());
            ?></div>
            </div><?php
            }?>
        <div class="fluid">
            <div class="grid2">&nbsp;</div>
            <div class="widget fluid grid8">
                    <div class="whead"><h6>User Details</h6></div>
                    <?php echo form_open('users/add/', array('class'=>'validate', 'id' => 'user_add')); ?>
                    <div class="formRow">
                        <div class="grid3"><label for="username">Username</label></div>
                        <div class="grid9"><input type="text" name="username" id="username" /></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label for="password">Password</label></div>
                        <div class="grid9"><input type="password" name="password" id="password" /></div>
                    </div>
                    
                    <div class="formRow">
                        <div class="grid3"><label for="full_name">Full Name</label></div>
                        <div class="grid9"><input type="text" name="full_name" id="full_name" /></div>
                    </div>
                    
                    <div class="formRow">
                        <div class="grid3"><label for="email">E-Mail Address</label></div>
                        <div class="grid9"><input type="text" name="email" id="email" /></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label for="status">Enabled </label></div>
                        <div class="grid9 on_off"><input type="checkbox" id="status" checked="checked" name="status" /></div>
                    </div>
                    <div class="formRow" style="text-align:center;">
                        <input type="submit" class="buttonS bDefault icon-checkmark-3" value="Save &amp; Continue to ACL Setup" />
                    </div>
                    </form>
                </div>
            
        </div>
    </div>
    <!-- Main Content End -->
    <script>
    $(function() {
        $(".validate").validate({
            rules: {
        		username: "required",
                email: "required",
                password: "required",
                full_name: "required"		
    		}
    	});
    });
    </script>