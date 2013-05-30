    <div class="contentTop">
        <span class="pageTitle"><span class="icon-user-3"></span>Modifying user: <?php echo $user->username; ?></span>
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
                    <div class="whead"><h6>User Details</h6><a class="buttonH bRed" title="Compose Message" id="compose_msg">Message</a></div>
                    <?php echo form_open('users/edit/'.$user->id, array('class'=>'validate', 'id' => 'user_edit')); ?>
                    <div class="formRow">
                        <div class="grid3"><label for="user_id">User ID</label></div>
                        <div class="grid2"><input class="grid2" type="text" disabled="disabled" name="user_id" id="user_id" value="<?php echo $user->id;?>" /></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label for="username">Username</label></div>
                        <div class="grid9"><input type="text" name="username" id="username" value="<?php echo $user->username;?>"/></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label for="password">Password <span class="note">Leave blank to keep current one</span></label></div>
                        <div class="grid9"><input type="password" name="password" id="password" /></div>
                    </div>
                    
                    <div class="formRow">
                        <div class="grid3"><label for="full_name">Full Name</label></div>
                        <div class="grid9"><input type="text" name="full_name" id="full_name" value="<?php echo $user->name;?>"/></div>
                    </div>
                    
                    <div class="formRow">
                        <div class="grid3"><label for="email">E-Mail Address</label></div>
                        <div class="grid9"><input type="text" name="email" id="email" value="<?php echo $user->email;?>"/></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label for="status">Enabled 
                        <?php
                        if($this->user->id == $user->id){
                            echo('<span class="note">This is your own user record. Be careful!</span>');
                        }?></label></div>
                        <div class="grid9 on_off"><input type="checkbox" id="status" <?php if($user->active) { echo 'checked="checked"'; }?> name="status" /></div>
                    </div>
                    <div class="formRow" style="text-align:center;">
                        <input type="submit" class="buttonS bDefault icon-checkmark-3" value="Save changes" />
                    </div>
                    </form>
                </div>
            
        </div>
        <!-- Send message widget -->
                   <div style="visibility:hidden;" id="msgdialog">
                   <?php echo form_open('messages/send_xhr', array('id' => 'send_message_form')); ?>
                   <input type="hidden" name="receiver" value="<?php echo $user->id;?>"/>
                    <div class="body">
                        <div class="messageTo">
                            <a href="#" title="" class="uName"><img width="37" height="36" src="<?php echo base_url();?>images/avatars/<?php echo $user->get_avatar();?>" alt="" /></a>
                                <span> Send message to <strong><?php echo ucfirst($user->username);?></strong></span>
                            <a href="#" title="" class="uEmail"><?php echo $user->email;?></a>
                        </div>
                        <input style="width: 97%;" type="text" name="subject" id="msg_subject" placeholder="Your message subject"/>
                        <textarea id="message_area" rows="5" cols="" name="message" class="auto" placeholder="Write your message"></textarea>
                        <label id="msg_error" style="visibility: hidden;" class="error" for="message" generated="true">Message is too short.</label>
                        <div class="mesControls">
                            <span><span class="iconb" data-icon="&#xe20d;"></span>Some basic <a href="#" title="">HTML</a> is OK</span>
                            
                            <div class="sendBtn sendwidget">
                                <a href="#" title="" class="attachPhoto"></a>
                                <a href="#" title="" class="attachLink"></a>
                                <input id="send_msg_btn" type="submit" name="sendMessage" class="buttonM bLightBlue" value="Send message" />
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
    </div>
    <!-- Main Content End -->
    <script>
    $(function() {
        $(".validate").validate({
            rules: {
    			username: "required",
                email: "required",
                full_name: "required"		
    		}
    	});
        $('#compose_msg').click(function () {
            $('#msgdialog').css('visibility','visible');
            $('#msgdialog').dialog('open');
            return false;
        });
        
        $('#msgdialog').dialog({
        autoOpen: false,
        modal: true,
        width: 400
        });
        $('#send_msg_btn').click(function(e){
            e.preventDefault();
            $("#msg_error").css('visibility','hidden');
            if($("#message_area").val().length < 1){
                $('#msg_error').text("Message is too short!");
                $("#msg_error").css('visibility','visible');
                return false;
            }
            var jqxhr = $.ajax({
                type: "POST",
                url: "<?php echo site_url('messages/send_xhr');?>",
                data:$('#send_message_form').serialize(),
                success: function(data){
                    if(data.success){
                        $.jGrowl("Message was sent!", { position : "bottom-right" });
                        $('#msgdialog').dialog('close');
                    } else {
                        $('#msg_error').text(data.msg);
                        $("#msg_error").css('visibility','visible');
                    }
                },
                dataType: "json"
            });
            jqxhr.fail(function() { alert("error"); });
        });
    });
    </script>