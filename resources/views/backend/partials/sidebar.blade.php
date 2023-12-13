<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset("admin_assets") }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="{{ Request::route()->getName() == 'admin.dashboard' ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="treeview {{ in_array(Request::route()->getName(), ['admin.posts.list', 'admin.posts.create']) ? 'active' : '' }}">
          <a href="#"><i class="fa fa-link"></i> <span>Posts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::route()->getName() == 'admin.posts.list' ? 'active' : '' }}">
                <a href="{{ route('admin.posts.list') }}">Show Posts</a>
            </li>
            <li class="{{ Request::route()->getName() == 'admin.posts.create' ? 'active' : '' }}">
                <a href="{{ route('admin.posts.create') }}">Create Post</a>
            </li>
          </ul>
        </li>
        <li class="treeview {{ in_array(Request::route()->getName(), ['admin.categories.list', 'admin.categories.create']) ? 'active' : '' }}">
          <a href="#"><i class="fa fa-link"></i> <span>Categories</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::route()->getName() == 'admin.categories.list' ? 'active' : '' }}">
                <a href="{{ route('admin.categories.list') }}">Show Categories</a>
            </li>
            <li class="{{ Request::route()->getName() == 'admin.categories.create' ? 'active' : '' }}">
                <a href="{{ route('admin.categories.create') }}">Create Category</a>
            </li>
          </ul>
        </li>
        <li class="treeview {{ in_array(Request::route()->getName(), ['admin.tags.list', 'admin.tags.create']) ? 'active' : '' }}">
          <a href="#"><i class="fa fa-link"></i> <span>Tags</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::route()->getName() == 'admin.tags.list' ? 'active' : '' }}">
                <a href="{{ route('admin.tags.list') }}">Show Tags</a>
            </li>
            <li class="{{ Request::route()->getName() == 'admin.tags.create' ? 'active' : '' }}">
                <a href="{{ route('admin.tags.create') }}">Create Tag</a>
            </li>
          </ul>
        </li>
        <li class="treeview {{ Request::is('admin/roles*') ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-link"></i>
                <span>Roles</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ Request::routeIs('admin.roles.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.roles.index') }}">Show Roles</a>
                </li>
                <li class="{{ Request::routeIs('admin.roles.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.roles.create') }}">Create Role</a>
                </li>
            </ul>
        </li>
        <li class="treeview {{ Request::is('admin/Permission*') ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-link"></i>
                <span>Permissions</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ Request::routeIs('admin.permissions.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.permissions.index') }}">Show Permissions</a>
                </li>
                <li class="{{ Request::routeIs('admin.permissions.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.permissions.create') }}">Create Permission</a>
                </li>
            </ul>
        </li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
