<div id="content" class="app-content box-shadow-z3" role="main">
    <div class="app-header white box-shadow">
        <div class="navbar navbar-toggleable-sm flex-row align-items-center">
            <!-- Open side - Naviation on mobile -->
            <a data-toggle="modal" data-target="#aside" class="hidden-lg-up mr-3">
              <i class="material-icons">&#xe5d2;</i>
            </a>
            <!-- / -->
        
            <!-- Page title - Bind to $state's title -->
            <div class="mb-0 h5 no-wrap" ng-bind="$state.current.data.title" id="pageTitle"></div>
        
  
            <!-- / navbar collapse -->
        
            <!-- navbar right -->
            <ul class="nav navbar-nav ml-auto flex-row">
           
              <li class="nav-item dropdown">
                <a class="nav-link p-0 clear" href="#" data-toggle="dropdown">
                  <span class="avatar w-50">
                    <p class="font-weight-bold border p-2"> <a href="/logout"> Logout</a> </p>
                  
                  </span>
                </a>
                <div ui-include="'/../views/blocks/dropdown.user.html'"></div>
              </li>
             
            </ul>
            <!-- / navbar right -->
        </div>
    </div>