<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
  <div class="brand-logo">
    <a href="index.html">
      <img src="{{url('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
      <h5 class="logo-text">Cost Management</h5>
    </a>
  </div>
  <div class="user-details">
    <div class="media align-items-center user-pointer collapsed" data-toggle="collapse" data-target="#user-dropdown">
      <div class="avatar"><img class="mr-3 side-user-img" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
      <div class="media-body">
        <h6 class="side-user-name"><?php echo session('Userfullname');?></h6>
      </div>
    </div>
    <div id="user-dropdown" class="collapse">
      <ul class="user-setting-menu">
        <!-- <li><a href="javaScript:void();"><i class="icon-user"></i> My Profile</a></li> -->
        <li><a href="/setting"><i class="icon-settings"></i> Setting</a></li>
        <li><a href="/logout"><i class="icon-power"></i> Logout</a></li>
      </ul>
    </div>
  </div>
  <ul class="sidebar-menu do-nicescrol">
    <li class="sidebar-header">MAIN NAVIGATION</li>
    <li class="Planning">
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-view-dashboard"></i> <span>Planning</span><i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li id="Planning1"><a href="/project"><i class="zmdi zmdi-long-arrow-right"></i> Projects</a></li>
        <li id="Planning2"><a href="/boq"><i class="zmdi zmdi-long-arrow-right"></i> BoQs</a></li>
        <li id="Planning3"><a href="/baseline"><i class="zmdi zmdi-long-arrow-right"></i> Baseline WBS</a></li>
        <li id="Planning4"><a href="/equipment"><i class="zmdi zmdi-long-arrow-right"></i> Contractor Equipments</a></li>
        <li id="Planning5"><a href="/mobilization"><i class="zmdi zmdi-long-arrow-right"></i> Mobilization of Consultants</a></li>
        <li id="Planning6"><a href="/risk"><i class="zmdi zmdi-long-arrow-right"></i> Risk Management</a></li>
      </ul>
    </li>
    <li class="Execute">
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-layers"></i>
        <span>Execution & Controlling</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li id="Execute1"><a href="/currentwbs"><i class="zmdi zmdi-long-arrow-right"></i> WBS Current</a></li>
        <li id="Execute2_parent"><a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-long-arrow-right"></i><span>Project Progress</span><i class="fa fa-angle-left pull-right"></i></a>
          <ul class="sidebar-submenu">
          <li id="Execute2"><a href="/actualprogress"><i class="zmdi zmdi-long-arrow-right"></i> Actual Progress</a></li>
            <li id="Execute3"><a href="/stationprogress"><i class="zmdi zmdi-long-arrow-right"></i> Station Progress</a></li>
            <li id="Execute4"><a href="/visualprogress"><i class="zmdi zmdi-long-arrow-right"></i> Visual Progress</a></li>
            <li id="Execute5"><a href="/performanceanalysis"><i class="zmdi zmdi-long-arrow-right"></i> Performance Analysis</a></li>
          </ul>
        </li>

        <li id="Execute6"><a href="/payment-certificate"><i class="zmdi zmdi-long-arrow-right"></i> Payment Certificates</a></li>
        <li id="Execute7"><a href="/issue-management"><i class="zmdi zmdi-long-arrow-right"></i> Issue Management</a></li>
        <li id="Execute8"><a href="/weather-info"><i class="zmdi zmdi-long-arrow-right"></i> Weather Info</a></li>
        <li id="Execute9"><a href="/monthly-meeting"><i class="zmdi zmdi-long-arrow-right"></i> Monthly Meeting</a></li>
      </ul>
    </li>
    <li class="Report">
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-card-travel"></i>
        <span>Info & Reporting</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li id="Report1"><a href="/progress-report"><i class="zmdi zmdi-long-arrow-right"></i> Progress Report</a></li>
      </ul>
    </li>
    <li class="Master">
      <a href="javaScript:void();" class="waves-effect">
        <i class="zmdi zmdi-chart"></i> <span>Tools</span>
        <i class="fa fa-angle-left float-right"></i>
      </a>
      <ul class="sidebar-submenu">
        <li><a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-long-arrow-right"></i> <span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>
          <ul class="sidebar-submenu">
            <li id="Master1"><a href="/manage-user"><i class="zmdi zmdi-long-arrow-right"></i> Manage User</a>
            <li id="Master2"><a href="/profile-group"><i class="zmdi zmdi-long-arrow-right"></i> Profile Group</a>
          </ul>
        </li>
        <li><a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-long-arrow-right"></i> <span>Master Data Management</span><i class="fa fa-angle-left pull-right"></i></a>
          <ul class="sidebar-submenu">
            <li id="Master3"><a href="/business-type"><i class="zmdi zmdi-long-arrow-right"></i> Business Type</a>
            <li id="Master4"><a href="/business-partner"><i class="zmdi zmdi-long-arrow-right"></i> Business Partner</a>
            <li id="Master5"><a href="/position-category"><i class="zmdi zmdi-long-arrow-right"></i> Position Category</a>
            <li id="Master6"><a href="/position"><i class="zmdi zmdi-long-arrow-right"></i> Position</a>
            <li id="Master7"><a href="/human-resources"><i class="zmdi zmdi-long-arrow-right"></i> Human Resources</a>
            <li id="Master8"><a href="/weather-conditions"><i class="zmdi zmdi-long-arrow-right"></i> Weather Conditions</a>
            <li id="Master9"><a href="/country"><i class="zmdi zmdi-long-arrow-right"></i> Country</a>
            <li id="Master10"><a href="/city"><i class="zmdi zmdi-long-arrow-right"></i> City</a>
            <li id="Master11"><a href="/currency"><i class="zmdi zmdi-long-arrow-right"></i> Currency</a>
            <li id="Master12"><a href="/units"><i class="zmdi zmdi-long-arrow-right"></i> Units</a>
          </ul>
        </li>
      </ul>
    </li>
  </ul>

</div>
