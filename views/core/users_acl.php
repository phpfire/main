 <div class="contentTop">
        <span class="pageTitle"><span class="icon-user-3"></span>Access Control</span>
    </div>
    
    <!-- Main content -->
    <div class="wrapper">
        <?php echo form_open('users/acl/'.$user->id, array('class'=>'validate', 'id' => 'user_acl')); ?>
            <div class="widget">
                    <div class="whead"><span class="icon-glass"></span><h6>Access Control Management Tool</h6></div>
                    <div class="body dualBoxes">
            
                        <div class="leftBox">
                            <div style="text-align:center;"><strong>Denied Actions</strong></div>
                         
                            <input type="text" id="box1Filter" class="boxFilter" placeholder="Filter entries..." /><button type="button" id="box1Clear" class="dualBtn fltr" style="top: 27px;">x</button><br />
                            
                            <select id="box1View" multiple="multiple" class="multiple" style="height:300px; background: none repeat scroll 0 0 rgba(255, 90, 44, 0.4);">
                            <?php
                                foreach($available as $rule=>$desc){
                                    echo('<option value="'.$rule.'">'.$desc.'</option>');
                                }
                            ?>
                            </select>
                            <br/>
                            <span id="box1Counter" class="countLabel"></span>
                            
                            <div class="displayNone"><select id="box1Storage"></select></div>
                        </div>
                                
                        <div class="dualControl">
                            <button id="to2" type="button" class="dualBtn mr5 mb15">&nbsp;&gt;&nbsp;</button>
                            <button id="allTo2" type="button" class="dualBtn">&nbsp;&gt;&gt;&nbsp;</button><br />
                            <button id="to1" type="button" class="dualBtn mr5">&nbsp;&lt;&nbsp;</button>
                            <button id="allTo1" type="button" class="dualBtn">&nbsp;&lt;&lt;&nbsp;</button>
                        </div>
                                
                        <div class="rightBox">
                            <div style="text-align:center;"><strong>Allowed Actions</strong></div>
                            <input type="text" id="box2Filter" class="boxFilter" placeholder="Filter entries..." /><button type="button" id="box2Clear" class="dualBtn fltr" style="top: 27px;">x</button><br />
                            <select name="allow_acl[]" id="box2View" multiple="multiple" class="multiple" style="height:300px; background: none repeat scroll 0 0 rgba(158, 255, 0, 0.4);">
                                <?php
                                foreach($current as $rule=>$desc){
                                    echo('<option value="'.$rule.'">'.$desc.'</option>');
                                }
                                ?>
                            </select><br/>
                            <span id="box2Counter" class="countLabel"></span>
                            
                            <div class="displayNone"><select id="box2Storage"></select></div>
                        </div>
                    </div>
                    <input type="hidden" name="task" value="save" />
                    <div style="text-align:center"><input id="acl_submit" class="buttonS bDefault icon-checkmark-3" type="submit" value="Save Changes" /></div>
                    <br/>
            </div>
        </form>
    </div>
    <!-- Main Content End -->