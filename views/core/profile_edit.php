    <div class="contentTop">
        <span class="pageTitle"><span class="icon-user-3"></span>Edit Profile</span>
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
                    <div class="whead"><h6>My Details</h6></div>
                    <?php echo form_open('profile/', array('class'=>'validate', 'id' => 'user_edit')); ?>
                    <div class="formRow">
                        <div class="grid3"><label for="username">Username</label></div>
                        <div class="grid9"><input type="text" disabled="disabled" name="username" id="username" value="<?php echo $this->user->username;?>"/></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label for="password">Password <span class="note">Leave blank to keep current one</span></label></div>
                        <div class="grid9"><input type="password" name="password" id="password" /></div>
                    </div>
                    
                    <div class="formRow">
                        <div class="grid3"><label for="full_name">Full Name</label></div>
                        <div class="grid9"><input type="text" name="full_name" id="full_name" value="<?php echo $this->user->name;?>"/></div>
                    </div>
                    
                    <div class="formRow">
                        <div class="grid3"><label for="email">E-Mail Address</label></div>
                        <div class="grid9"><input type="text" name="email" id="email" value="<?php echo $this->user->email;?>"/></div>
                    </div>
                    <div class="formRow" style="text-align:center;">
                        <input type="submit" class="buttonS bDefault icon-checkmark-3" value="Save changes" />
                    </div>
                    </form>
                </div>
        </div>
        <!-- Avatar Widget -->
            <?php
            if(isset($upload_error)){
                ?>
                 <div class="fluid">
                    <div class="grid4">&nbsp;</div>
                    <div class="grid4 nNote nWarning">
                <?php
                    echo($upload_error);
            ?></div> 
            </div>
            <?php } ?>
        <div class="fluid">
            <div class="grid2">&nbsp;</div>
            <div class="widget fluid grid8">
                    <div class="whead"><h6>My Avatar Image</h6></div>
                    <div class="fluid">
                        <div class="grid3 avatar-display">
                            <?php echo form_open('profile/remove_avatar_xhr', array('id' => 'remove_avatar_form')); ?>
                            <p id="cur_avatar"><img width="70" height="70" src="<?php echo base_url();?>images/avatars/<?php echo $this->user->get_avatar();?>" alt="My Avatar" /></p>
                            <div class="formRow" style="text-align:center;">
                                <a id="remove_avatar_btn" class="buttonS  bRed">Delete</a>
                            </div>
                            </form>
                        </div>
                        <div class="grid9 avatar-upload">
                        <?php echo form_open_multipart('profile/avatar', array('id' => 'avatar_upload')); ?>
                            Upload a new avatar image:<br/>
                            <input type="file" name="userfile" class="styled" id="fileInput" />
                            <p><input type="submit" class="buttonS bDefault icon-checkmark-3" value="Upload Image" /></p>
                        </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <!-- Main Content End -->
    <script>
    $(function() {
        $(".validate").validate({
            rules: {
                email: "required",
                full_name: "required"		
    		}
    	});
        $('#remove_avatar_btn').click(function(e){
            e.preventDefault();
            var jqxhr = $.ajax({
                type: "POST",
                url: "<?php echo site_url('profile/remove_avatar_xhr');?>",
                data:$('#remove_avatar_form').serialize(),
                success: function(data){
                    if(data.success){
                        $.jGrowl("Avatar removed!", { position : "bottom-right" });
                    } else {
                        $.jGrowl("There was a problem removing the avatar!", { position : "bottom-right" });
                    }
                },
                dataType: "json"
            });
            jqxhr.fail(function() { $.jGrowl("There was an error communicating with the server!", { position : "bottom-right" }); });
        });
    });
    </script>