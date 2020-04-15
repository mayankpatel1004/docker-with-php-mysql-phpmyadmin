<?php
global $url,$back_session_name,$page_data,$action,$cf,$theme_path;
$login_user_name = "Guest";
$login_user_id = "0";
$logout_link = "";
$controller = "";
$body_item_type = "";
$body_action = "";
$body_controller = "";
$body_id = "";
$body_alias = "";
$body_class = "";

if(isset($_SESSION[$back_session_name]['user_id']) && !empty($_SESSION[$back_session_name]['user_id'])){
  $login_user_name = $_SESSION[$back_session_name]['first_name']." ".$_SESSION[$back_session_name]['last_name'];
  $login_user_id = $_SESSION[$back_session_name]['user_id'];
  $logout_link = "1";
}
//print_r($page_data);
if(isset($page_data['item_alias']) && $page_data['item_alias'] != '') {
  $controller = $page_data['item_alias'];
  $body_item_type = $page_data['item_type'];
  $body_action = $page_data['action'];
  $body_controller = $page_data['controller'];
  $body_id = $page_data['item_id'];
  $body_alias = $page_data['item_alias'];
  $body_class = $body_id.'_alias_'.$body_alias.'_controller_'.$body_controller.'_action_'.$body_action.'_type_'.$body_item_type;
}
?>
<?php require_once $theme_path.'generated_files/Admintopmenu.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Administrator</title>
  <?php if(isset($action) && $action == 'form1'):?>
  <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/jquery-tags-input/jquery.tagsinput.min.css" />
  <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/select2/select2.min.css">
  <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/css/vendor.bundle.base.css" />
  <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/flag-icon-css/css/flag-icon.min.css" />
  <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/simple-line-icons/css/simple-line-icons.css" />
  <?php endif;?>
  <?php if(isset($action) && $action == 'form' || $action == 'inventorystock' || $action == 'dispatchimtems'):?>
  <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/select2/select2.min.css">
  <?php endif;?>
  <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/mdi/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="<?php echo $theme_url;?>css/horizontal-layout-light/style.css" />
  <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="<?php echo $theme_url;?>css/horizontal-layout-light/custom.css" />
  <link rel="shortcut icon" href="<?php echo $theme_url;?>images/favicon.png" />
</head>
<body class="<?php echo $body_alias." ".$body_class;?>">
  <div class="container-scroller">
    <div class="horizontal-menu">
      <input type="hidden" id="site_url" value="<?php echo $url;?>" />
      <input type="hidden" id="page_controller" value="<?php echo $controller;?>" />
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container">
          <div class="text-left navbar-brand-wrapper d-flex align-items-center justify-content-between">
            <a class="navbar-brand brand-logo" href="<?php echo $url.'dashboard';?>"><img src="<?php echo $theme_url;?>images/admin-logo.png" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="<?php echo $url.'dashboard';?>"><img src="<?php echo $theme_url;?>images/logo-mini.png" alt="logo"/></a> 
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-user-icon d-xs-none hidden-sm">
                    <a class="nav-link" href="#">Welcome <?php echo $login_user_name;?></a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
                    <img src="<?php echo $theme_url;?>images/37x37.png" alt="profile"/>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">

                    <?php if(isset($user_menu) && count($user_menu) > 0):?>
                      <?php foreach($user_menu as $alias => $title) {?>
                            <a class="dropdown-item preview-item" href="<?php echo $url;?><?php echo $alias;?>">
                              <div class="preview-item-content flex-grow">
                                <h6 class="preview-subject ellipsis font-weight-normal"><?php echo $title;?></h6>
                              </div>
                            </a>
                      <?php }?>
                    <?php endif;?>
                    <a class="dropdown-item preview-item" href="<?php echo $url.'allusers/form/?id='.$login_user_id;?>">
                      <div class="preview-item-content flex-grow">
                        <h6 class="preview-subject ellipsis font-weight-normal">Profile</h6>
                      </div>
                    </a>
                    <a class="dropdown-item preview-item" onclick="memberlogout()">
                      <div class="preview-item-content flex-grow">
                        <h6 class="preview-subject ellipsis font-weight-normal">Logout</h6>
                      </div>
                    </a>
                  </div>
                </li>
                <?php if($logout_link != ''):?>
                <li class="nav-item nav-user-icon">
                <a class="nav-link" onclick="memberlogout()" style="cursor:pointer;">Logout</a>
                </li>
                <?php endif;?>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
      </nav>
      <nav class="bottom-navbar">
        <div class="container">
          <ul class="nav page-navigation">
            <li class="nav-item">
              
            <?php
            if(isset($dashboard_menu) && count($dashboard_menu) > 0) {
              foreach($dashboard_menu as $alias => $title) {
                ?>
                <li class="nav-item"><a class="nav-link" href="<?php echo $url;?><?php echo $alias;?>">
                    <i class="mdi mdi mdi-home menu-icon"></i>
                    <span class="menu-title"><?php echo $title;?></span>
                  </a>
                </li>    
                <?php
              }
            }
            ?>

            <?php if(isset($item_menu) && count($item_menu) > 0){?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="mdi fa-file-photo-o menu-icon"></i>
                <span class="menu-title">CMS</span>
                <i class="menu-arrow"></i></a>
              <div class="submenu">                
                <ul class="submenu-item">
                  <?php foreach($item_menu as $alias => $title) {?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $url;?><?php echo $alias;?>"><?php echo $title;?></a></li>
                  <?php }?>
                </ul>
              </div>
            </li>
            <?php }?>

            <?php if(isset($task_menu) && count($task_menu) > 0):?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="mdi mdi-av-timer menu-icon"></i>
                <span class="menu-title">Employee</span>
                <i class="menu-arrow"></i></a>
              <div class="submenu">
                <ul class="submenu-item">
                <?php foreach($task_menu as $alias => $title) {?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $url;?><?php echo $alias;?>"><?php echo $title;?></a></li>
                  <?php }?>
                </ul>
              </div>
            </li>
            <?php endif;?>


            <?php if(isset($report_menu) && count($report_menu) > 0):?>      
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="mdi mdi-trello menu-icon"></i>
                <span class="menu-title">Reports</span>
                <i class="menu-arrow"></i></a>
              <div class="submenu">
                <ul class="submenu-item">
                  <?php foreach($report_menu as $alias => $title) {?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $url;?><?php echo $alias;?>"><?php echo $title;?></a></li>
                  <?php }?>
                </ul>
              </div>
            </li>
            <?php endif;?>

            <?php if(isset($logs_menu) && count($logs_menu) > 0):?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="mdi mdi-view-headline menu-icon"></i>
                <span class="menu-title">Logs</span>
                <i class="menu-arrow"></i></a>
              <div class="submenu">
                <ul class="submenu-item">
                  <?php foreach($logs_menu as $alias => $title) {?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $url;?><?php echo $alias;?>"><?php echo $title;?></a></li>
                  <?php }?>
                </ul>
              </div>
            </li>
            <?php endif;?>

            <?php /*?>
            <?php if(isset($user_menu) && count($user_menu) > 0):?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="mdi mdi-contact-mail menu-icon"></i>
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i></a>
              <div class="submenu">
                <ul class="submenu-item">
                  <?php foreach($user_menu as $alias => $title) {?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $url;?><?php echo $alias;?>"><?php echo $title;?></a></li>
                  <?php }?>
                </ul>
              </div>
            </li>
            <?php endif;?>
            <?php */?>
            
            <?php if(isset($customer_menu) && count($customer_menu) > 0):?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="mdi mdi-image-filter menu-icon"></i>
                <span class="menu-title">Customers</span>
                <i class="menu-arrow"></i></a>
              <div class="submenu">
                <ul class="submenu-item">
                  <?php foreach($customer_menu as $alias => $title) {?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $url;?><?php echo $alias;?>"><?php echo $title;?></a></li>
                  <?php }?>
                </ul>
              </div>
            </li>
            <?php endif;?>

            <?php if(isset($ecommerce_menu) && count($ecommerce_menu) > 0):?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="mdi mdi-basket menu-icon"></i>
                <span class="menu-title">E-commerce</span>
                <i class="menu-arrow"></i></a>
              <div class="submenu">
                <ul class="submenu-item">
                  <?php foreach($ecommerce_menu as $alias => $title) {?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $url;?><?php echo $alias;?>"><?php echo $title;?></a></li>
                  <?php }?>
                </ul>
              </div>
            </li>
            <?php endif;?>


            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="mdi mdi mdi-recycle menu-icon"></i>
                <span class="menu-title">Inventory</span>
                <i class="menu-arrow"></i></a>
              <div class="submenu">
                <ul class="submenu-item">
                  <?php foreach($inventory_menu as $alias => $title) {?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $url;?><?php echo $alias;?>"><?php echo $title;?></a></li>
                  <?php }?>
                </ul>
              </div>
            </li>

          </ul>
        </div>
      </nav>
    </div>
    <div class="container-fluid page-body-wrapper">