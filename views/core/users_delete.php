 <div class="contentTop">
        <span class="pageTitle"><span class="icon-user-3"></span>User Removal</span>
    </div>
    
    <!-- Main content -->
    <?php echo form_open('users/delete/'.$user->id, array('class'=>'validate', 'id' => 'user_edit')); ?>
    <div class="wrapper">
        <div class="fluid">
            <div class="grid4">&nbsp;</div>
            <div class="widget fluid grid4">
            <div class="whead"><h6>Confirm Removal</h6></div>
                <br/>
                <div style="text-align:center;">Are you sure you would like to delete this user?</div>
                <div style="padding:10px;">The following items will be removed permanently: <br/>
                <ul>
                    <li>- All messages sent by this account.</li>
                    <li>- All messages received by this account.</li>
                    <li>- All ACL database records for this account.</li>
                    <li>- The account record itself.</li>
                </ul>
                </div>
                <div style="text-align:center;">
                    <input type="hidden" name="task" value="delete" />
                    <input type="submit" class="buttonS bRed" value="Yes, proceed" />
                </div>
                <br/>
            </div>
        </div>
    </div>
    </form>
    <!-- Main Content End -->