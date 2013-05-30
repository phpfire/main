<!-- Top line begins -->
<div id="top">
    <div class="wrapper">
    	<a href="<?php echo base_url();?>" title="" class="logo brand">PHPFirewall</a>
        
        <!-- Right top nav -->
        <div class="topNav">
            <ul class="userNav">
                <li><a title="" class="search"></a></li>
                <li><a href="#" title="Live Stats" class="screen tipN"></a></li>
                <li><a href="#" title="Settings" class="settings tipN"></a></li>
                <li><a href="#" title="Logout" class="logout tipN"></a></li>
            </ul>
            <a title="" class="iButton"></a>
            <a title="" class="iTop"></a>
            <div class="topSearch">
            	<div class="topDropArrow"></div>
                <form action="">
                    <input type="text" placeholder="search..." name="topSearch" />
                    <input type="submit" value="" />
                </form>
            </div>
        </div>
        
        <!-- Responsive nav 
        <ul class="altMenu">
            <li><a href="#" title="">Dashboard</a></li>
            <li><a href="other_calendar.html" title="" class="exp" id="current">Other pages</a>
                <ul>
                    <li><a href="other_calendar.html" class="active">Calendar</a></li>
                    <li><a href="other_gallery.html">Images gallery</a></li>
                </ul>
            </li>
            <li><a href="messages.html" title="">Messages</a></li>
            <li><a href="statistics.html" title="">Statistics</a></li>
        </ul>-->
    </div>
</div>
<!-- Top line ends -->

<!-- Sidebar begins -->
<div id="sidebar">

    <!-- Main nav -->
    <div class="mainNav">
        <div class="user">
            <a title="" class="leftUserDrop" id="user_avatar"><img width="70" height="70" src="<?php echo base_url();?>images/avatars/<?php echo $this->user->get_avatar();?>" alt="User Avatar" /><span>
            <strong><?php echo $this->user->get_new_messages();?></strong></span></a><span><?php echo $this->user->name;?></span>
            <ul class="leftUser">
                <li><a href="#" title="" class="sProfile">My profile</a></li>
                <li><a href="#" title="" class="sMessages">Messages</a></li>
                <li><a href="#" title="" class="sSettings">Settings</a></li>
                <li><a href="#" title="" class="sLogout">Logout</a></li>
            </ul>
        </div>
        
        <!-- Responsive nav -->
        <div class="altNav">
            <div class="userSearch">
                <form action="">
                    <input type="text" placeholder="search..." name="userSearch" />
                    <input type="submit" value="" />
                </form>
            </div>
            
            <!-- User nav -->
            <ul class="userNav">
                <li><a href="#" title="" class="profile"></a></li>
                <li><a href="#" title="" class="messages"></a></li>
                <li><a href="#" title="" class="settings"></a></li>
                <li><a href="#" title="" class="logout"></a></li>
            </ul>
        </div>
        
        <!-- Main nav -->
        <ul class="nav">
            <li><a href="#" title=""><img src="<?php echo base_url();?>images/icons/mainnav/dashboard.png" alt=""/><span>Dashboard</span></a></li>
            <li><a href="#" title=""><img src="<?php echo base_url();?>images/icons/is/32/light/Settings/32-Cog.png" alt=""/><span>Settings</span></a></li>
            <li><a href="#" title=""><img src="<?php echo base_url();?>images/icons/mainnav/ui.png" alt="" /><span>Users</span></a></li>
            <li><a href="#" title="" class="exp"><img src="<?php echo base_url();?>images/icons/is/32/light/Misc/32-Strategy.png" alt="" /><span>Firewall Rules</span></a>
                <ul>
                    <li><a href="other_calendar.html" class="active">Filter Rules</a></li>
                    <li><a href="other_gallery.html">Whitelisted IP Addresses</a></li>
                    <li><a href="other_gallery.html">Blacklisted IP Addresses</a></li>
                    <li><a href="other_gallery.html">BotScout Rules</a></li>
                </ul>
            </li>
            <li><a href="#" title=""><img src="<?php echo base_url();?>images/icons/is/32/light/Misc/32-Magnifying-Glass.png" alt="" /><span>Malware Scan</span></a></li>
            <li><a href="#" title=""><img src="<?php echo base_url();?>images/icons/is/32/light/Files/32-PowerPoint-Document.png" alt="" /><span>Logs</span></a>
                <ul>
                    <li><a href="other_calendar.html" class="active">Calendar</a></li>
                    <li><a href="other_gallery.html">Images gallery</a></li>
                </ul>
            </li>
            <li><a href="#" title="" class="exp"><img src="<?php echo base_url();?>images/icons/mainnav/other.png" alt="" /><span>Extensions</span></a>
                <ul>
                    <li><a href="other_calendar.html" class="active">Calendar</a></li>
                    <li><a href="other_gallery.html">Images gallery</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- Sidebar ends -->
<div id="content">