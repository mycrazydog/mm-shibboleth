<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! Sentinel::getUser()->gravatar !!}" class="img-circle" alt="User Image" height="160" width="160" />
            </div>
            <div class="pull-left info">
                <p>Hello {{ Sentinel::getUser()->last_name }}  </p>
                <!-- Status -->
                <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
            </div>
        </div>



        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MANAGE</li>
            <!-- Optionally, you can add icons to the links -->
            <!--<li class="{{ set_active('/') }}"><a href="{{ url('/') }}">Home</a></li>-->
            
            <li class="{{ set_active('manage/posts') }}"><a href="{{ url('manage/posts') }}"><i class="fa fa-home"></i> Home</a></li>   
                        
            <li class="{{ set_active('manage/posts/create') }}"><a href="{{ url('manage/posts/create') }}"><i class="fa fa-plus text-green"></i> Add New</a></li>  
            

            
            <!--<li class="{{ set_active('userProtected') }}"><a href="{{ url('userProtected') }}">Registered Users Only</a></li>-->
                        			
			
			<li class="treeview {{ set_active('manage/departments') }} {{ set_active('manage/sources') }} {{ set_active('manage/staff') }}">
			    <a href="#"><span><i class="fa fa-book"></i> Manage Options<br/></span> <i class="fa fa-angle-left pull-right"></i></a>
			    <ul class="treeview-menu">
			        <li class="{{ set_active('manage/departments') }}"><a href="{{ url('manage/departments') }}">Organizations/Departments</a></li>
			        <li class="{{ set_active('manage/sources') }}"><a href="{{ url('manage/sources') }}">Sources</a></li>
			        <li class="{{ set_active('manage/staff') }}"><a href="{{ url('manage/staff') }}">Staff</a></li>
			    </ul>
			</li>
			
			@if(Sentinel::getUser()->inRole('admins'))			
			<li class="{{ set_active_admin('manage/admin/profiles') }}"><a href="/manage/admin/profiles"><i class="fa fa-users"></i> List Users</a></li>
			
            <li class="treeview {{ set_active('manage/reports') }}">
                <a href="#"><span><i class="fa fa-book"></i> Reports</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
			        <li class="{{ set_active('manage/reports') }}"><a href="{{ url('manage/reports') }}">Full Report</a></li>
                </ul>
            </li>
            @endif
            
        </ul><!-- /.sidebar-menu -->
        

                      

        

    </section>
    <!-- /.sidebar -->
</aside>