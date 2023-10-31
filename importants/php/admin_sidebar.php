<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $userIsLoggedIn = true;
    $dashboardActiveClass = (basename($_SERVER['PHP_SELF']) === 'dashboard.php') ? 'active' : '';
} else {
    $userIsLoggedIn = false;
    $dashboardActiveClass = '';
}
?>

<div class="wrapper">
     
        <div class="body-overlay"></div>
       
       <!-------sidebar--design------------>
       
       <div id="sidebar">
          <div class="sidebar-header">
             <h3><img src="assets/logo.jpg" class="img-fluid"/><span>Cafe Consuelo</span></h3>
          </div>
          <ul class="list-unstyled component m-0">
          <li class="sidebar-item <?= $dashboardActiveClass ?> <?php if (basename($_SERVER['PHP_SELF']) === 'dashboard.php') echo 'active'; ?>">
            <a href="dashboard.php" class="dashboard"><i class="material-icons">dashboard</i> Dashboard </a>
        </li>

            <li class="sidebar-item <?php if (basename($_SERVER['PHP_SELF']) === 'inventory.php') echo 'active'; ?>">
               <a href="inventory.php" class="inventory"><i class="material-icons">inventory</i> Inventory </a>
            </li>

            <li class="sidebar-item <?php if (basename($_SERVER['PHP_SELF']) === 'employee.php') echo 'active'; ?>">
               <a href="employee.php" class="employee"><i class="material-icons">group</i>Employees </a>
            </li>
            
            <li class="sidebar-item <?php if (basename($_SERVER['PHP_SELF']) === '.php') echo 'active'; ?>">
               <a href="" class="stocks"><i class="material-icons">equalizer</i> Stocks </a>
            </li>

            <li class="sidebar-item <?php if (basename($_SERVER['PHP_SELF']) === '.php') echo 'active'; ?>">
               <a href="" class="supplier"><i class="material-icons">business</i>Supplier </a>
            </li>
             
            <li class="sidebar-item <?php if (basename($_SERVER['PHP_SELF']) === 'history.php') echo 'active'; ?>">
            <a href="history.php" class=""><i class="material-icons">date_range</i>History </a>
            </li>
            <li class="sidebar-item <?php if (basename($_SERVER['PHP_SELF']) === '.php') echo 'active'; ?>">
            <a href="#" class=""><i class="material-icons">library_books</i>Ewan </a>
            </li>
          
          </ul>
       </div>

       <div id="content">
	     
        <!------top-navbar-start-----------> 
           
        <div class="top-navbar">
           <div class="xd-topbar">
               <div class="row">
                   <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
                      <div class="xp-menubar">
                          <span class="material-icons text-white">signal_cellular_alt</span>
                      </div>
                   </div>
                   
                   <div class="col-md-5 col-lg-3 order-3 order-md-2">
                      <!-- Only for empty space -->
                   </div>
                   
                   
                   <div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
                       <div class="xp-profilebar text-right">
                          <nav class="navbar p-0">
                             <ul class="nav navbar-nav flex-row ml-auto">
                             
                             
                             <li class="nav-item">
                               <a class="nav-link" href="#">
                                 <span class="material-icons">question_answer</span>
                               </a>
                             </li>
                             
                             <li class="dropdown nav-item">
                               <a class="nav-link" href="#" data-toggle="dropdown">
                                <img src="img/user.jpg" style="width:40px; border-radius:50%;"/>
                                <span class="xp-user-live"></span>
                               </a>
                                <ul class="dropdown-menu small-menu">
                                   <li><a href="#">
                                   <span class="material-icons">person_outline</span>
                                   Profile
                                   </a></li>
                                   <li><a href="#">
                                   <span class="material-icons">settings</span>
                                   Settings
                                   </a></li>
                                   <li><a href="#">
                                   <span class="material-icons">logout</span>
                                   Logout
                                   </a></li>
                                   
                                </ul>
                             </li>
                             
                             
                             </ul>
                          </nav>
                       </div>
                   </div>
                   
               </div>
               
               <div class="xp-breadcrumbbar text-center">
                  <h4 class="page-title">Dashboard</h4>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Cafe Consuelo</a></li>
                    <li class="breadcrumb-item active" aria-curent="page">Dashboard</li>
                  </ol>
               </div>
               
               
           </div>
           
        </div>
