 <nav class="navbar navbar-static-top" role="navigation">
     <!-- Sidebar toggle button-->
     <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
         <span class="sr-only">Toggle navigation</span>
     </a>
     <div class="navbar-custom-menu">
         <ul class="nav navbar-nav">
             <li class="dropdown user user-menu">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <img src="{{ asset('storage/foto/' . Auth::user()->foto) }}" class="user-image" alt="User Image">
                     <span class="hidden-xs">{{ Auth::user()->name }}</span>
                 </a>
                 <ul class="dropdown-menu">
                     <!-- User image -->
                     <li class="user-header">
                         <img src="{{ asset('storage/foto/' . Auth::user()->foto) }}" class="img-circle"
                             alt="User Image">
                         <p>
                             {{ Auth::user()->name }}
                         </p>
                     </li>
                     <!-- Menu Footer-->
                     <li class="user-footer">
                         <div class="pull-left">
                             <a href="{{ route('profil.edit') }}" class="btn btn-default btn-flat">Profile</a>
                         </div>
                         <div class="pull-right">
                             <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                 @csrf
                                 <button type="submit" class="btn btn-default btn-flat">Keluar</button>
                             </form>
                         </div>
                     </li>
                 </ul>
             </li>
         </ul>
     </div>
 </nav>
