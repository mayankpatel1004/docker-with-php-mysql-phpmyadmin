<?php
global $url,$front_session_name,$page_data,$theme_url,$theme_path,$cnonical_prefix,$currancy;
$login_user_name = "Guest";
$logout_link = "";
$controller = "";
$body_item_type = "";
$body_action = "";
$body_controller = "";
$body_id = "";
$body_alias = "";
$body_class = "";

if(isset($_SESSION[$front_session_name]['customer_id']) && !empty($_SESSION[$front_session_name]['customer_id'])){
  $login_user_name = $_SESSION[$front_session_name]['first_name']." ".$_SESSION[$front_session_name]['last_name'];
  $logout_link = "1";
}
//echo "<pre>";print_r($page_data);exit;
if(isset($page_data['item_alias']) && $page_data['item_alias'] != '') {
  $controller = $page_data['item_alias'];
  $body_item_type = $page_data['item_type'];
  $body_action = $page_data['action'];
  $body_controller = $page_data['controller'];
  $body_id = $page_data['item_id'];
  $body_alias = $page_data['item_alias'];
  $rich_snippets = stripslashes($page_data['snippets_code']);
  $body_class = $body_id.'_alias_'.$body_alias.'_controller_'.$body_controller.'_action_'.$body_action.'_type_'.$body_item_type;
}
require_once $theme_path."generated_files/configdata.php";

$meta_title = FRONT_APPLICATION_TITLE;
$meta_description = FRONT_META_DESCRIPTION;
$robots = FRONT_DEFAULT_ROBOTS;
//echo "<pre>";print_r($page_data);exit;
if(isset($page_data['item_title']) && $page_data['item_title'] != ''){
  $meta_title = $page_data['item_title'];
  
  $robots = $page_data['robots'];
}
if(isset($page_data['item_description']) && $page_data['item_description'] != ''){
  $meta_description = strip_tags($page_data['item_description']);
}
if(isset($page_data['meta_title']) && $page_data['meta_title'] != ''){
  $meta_title = $page_data['meta_title'];
  $robots = $page_data['robots'];
}
if(isset($page_data['meta_description']) && $page_data['meta_description'] != ''){
  $meta_description = strip_tags($page_data['meta_description']);
}
//echo $meta_description;exit;
//echo $robots;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php if(isset($cnonical_prefix) && $cnonical_prefix != ""){ ?><link rel="canonical" href="<?php echo $cnonical_prefix.$body_alias;?>" /><?php }?>
  <title><?php echo $meta_title;?></title>
  <?php if(SHOW_META_DETAILS == 'Yes'){?>
    <meta name="robots" content="<?php echo $robots;?>" />
    <meta name=author content="<?php echo COMPANY_NAME;?>" />
    <meta name=allow-search content=yes>
    <meta name=googlebot content="index,follow">
    <meta name=yahooSeeker content="index, follow">
    <meta name=msnbot content="index, follow">
    <meta name="description" content="<?php echo $meta_description;?>" />
    <?php if($meta_title):?><meta property="og:title" content="<?php echo $meta_title;?>" /><?php endif;?>
    <?php if($meta_description):?><meta property="og:description" content="<?php echo $meta_description;?>" /><?php endif;?>
    <meta property="og:image" content="<?php echo $theme_url;?>images/logo.png" />
    <meta property="og:url" content="<?php echo $url;?>" />
    <meta property="og:type" content="Website" />
    <?php if(FBAPP_ID):?><meta property="fb:page_id" content="<?php echo FBAPP_ID;?>" /><?php endif;?>
    <?php if(FBADMINS):?><meta property="fb:admins" content="<?php echo FBADMINS;?>" /><?php endif;?>
    <?php if(FRONT_APPLICATION_NAME):?><meta property="og:sitename" content="<?php echo FRONT_APPLICATION_NAME;?>" /><?php endif;?>
    <meta name="twitter:card" content="Summary" />
    <meta name="twitter:title" content="<?php echo $meta_title;?>" />
    <meta name="twitter:description" content="<?php echo $meta_description;?>" />
    <meta name="twitter:url" content="<?php echo $url;?>" />
    <meta name="twitter:image" content="<?php echo $theme_url;?>images/logo.png" />
    <meta name="yandex-verification" content="87907069a3dd566d" />
    <link rel='dns-prefetch' href='https://www.google.com' />
    <link rel='dns-prefetch' href='https://maxcdn.bootstrapcdn.com' />
    <link rel='dns-prefetch' href='https://s.w.org' />
    <?php if(APPLICATION_JSON_SCRIPT):echo APPLICATION_JSON_SCRIPT;endif;?>
<script type="application/ld+json">{"@context":"http://www.schema.org","@type":"ProfessionalService","name":"<?php echo stripslashes(FRONT_APPLICATION_TITLE);?>","url":"<?php echo $url?>","logo":"<?php echo $theme_url?>images/logo.png","image":"<?php echo $theme_url?>images/logo.png","description":"<?php echo stripslashes(FRONT_META_DESCRIPTION);?>","priceRange":"<?php echo $currancy;?>","aggregateRating":{"@type":"AggregateRating","ratingValue":"4.2/5","reviewCount":"25"},"address":{"@type":"PostalAddress","streetAddress":"<?php echo stripslashes(COMPANY_ADDRESS1);?> <?php echo stripslashes(COMPANY_ADDRESS2);?>,<?php echo COMPANY_CITY;?>, <?php echo COMPANY_STATE;?>, <?php echo COMPANY_ZIPCODE;?>","addressLocality":"<?php echo COMPANY_CITY;?>","addressRegion":"<?php echo COMPANY_STATE;?>","postalCode":"<?php echo COMPANY_ZIPCODE;?>","addressCountry":"<?php echo COMPANY_COUNTRY;?>"},"telephone":"<?php echo COMPANY_CONTACT_NUMBER;?>","geo":{"@type":"GeoCoordinates","latitude":"<?php echo COMPANY_LATITUDE;?>","longitude":"<?php echo COMPANY_LONGITUDE;?>"},"openingHours":"<?php echo COMPANY_OPENING_HOURS;?>","contactPoint":[{"@type":"ContactPoint","telephone":"<?php echo COMPANY_CONTACT_NUMBER;?>","contactType":"<?php echo stripslashes(COMPANY_CONTACT_TYPE);?>","areaServed":["<?php echo COMPANY_COUNTRY;?>"],"availableLanguage":["English"]},{"@type":"ContactPoint","telephone":"<?php echo COMPANY_CONTACT_NUMBER;?>","contactType":"Technical support","areaServed":["<?php echo COMPANY_COUNTRY;?>"],"availableLanguage":["English"]}],"sameAs":["<?php echo FACEBOOK_URL;?>","<?php echo TWITTER_URL;?>","<?php echo LINKEDIN_URL;?>","<?php echo PINTEREST_URL;?>","<?php echo INSTAGRAM_URL;?>"]}</script>
  <script type="application/ld+json">
  {"@context":"http://schema.org","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"item":{"@id":"<?php echo $url;?>","name":"Home"}},{"@type":"ListItem","position":2,"item":{"@id":"<?php echo $url.$controller;?>","name":"<?php echo $controller;?>"}}]}
  </script>
  <?php }?>
  <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/mdi/css/materialdesignicons.min.css" />
  <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/css/vendor.bundle.base.css" />
  <link rel="stylesheet" href="<?php echo $theme_url;?>css/horizontal-layout-light/style.css" />
  <link rel="stylesheet" href="<?php echo $theme_url;?>vendors/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="<?php echo $theme_url;?>css/horizontal-layout-light/custom.css" />
  <link rel="shortcut icon" href="<?php echo $theme_url;?>images/favicon.png" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $theme_url;?>images/favicon.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $theme_url;?>images/favicon.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $theme_url;?>images/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="<?php echo $theme_url;?>images/favicon.png">
  
  <?php echo stripslashes(FRONT_GOOGLE_TAG_MANAGER);?>
</head>
<body class="<?php echo $body_alias." ".$body_class;?>">
<?php  //echo $cf->sentOrderEmail(1);exit;?>
  <div class="container-scroller">
<div class="horizontal-menu">
      <input type="hidden" id="site_url" value="<?php echo $url;?>" />
      <input type="hidden" id="page_controller" value="<?php echo $controller;?>" />
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container">
          <div class="text-left navbar-brand-wrapper d-flex align-items-center justify-content-between">
            <a class="navbar-brand brand-logo" href="<?php echo $url;?>"><img src="<?php echo $theme_url;?>images/logo.png" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="<?php echo $url;?>"><img src="<?php echo $theme_url;?>images/logo-mini.png" alt="logo"/></a> 
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-user-icon">
                  <a href="mailto:<?php echo FROM_EMAIL_ADDRESS;?>" class="text-white text-md mdi mdi-email-outline text-decoration-none">&nbsp;<?php echo FROM_EMAIL_ADDRESS;?></a>
                </li>
                <li class="nav-item nav-user-icon">
                  <a href="tel://<?php echo COMPANY_CONTACT_NUMBER;?>" class="text-white mdi mdi-whatsapp text-decoration-none" style="font-weight:14px;">&nbsp;<?php echo COMPANY_CONTACT_NUMBER;?></a>
                </li> 
                <?php if($login_user_name != 'Guest'):?>
                <li class="nav-item nav-user-icon">
                    <a class="nav-link" rel="nofollow" href="#"><small>Welcome <?php echo $login_user_name;?></small></a>
                </li>
                <?php endif;?>
                <li class="nav-item dropdown">
                  <!-- <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
                    <img src="< ?php echo $theme_url;?>images/37x37.png" alt="profile"/>
                  </a> -->
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                    <a class="dropdown-item preview-item" href="<?php echo $url.'customerdashboard';?>">
                      <div class="preview-item-content flex-grow">
                        <h6 class="preview-subject ellipsis font-weight-normal">Profile</h6>
                      </div>
                    </a>
                    <a class="dropdown-item preview-item" rel="nofollow" onclick="customerlogout()">
                      <div class="preview-item-content flex-grow">
                        <h6 class="preview-subject ellipsis font-weight-normal"><small>Logout</small></h6>
                      </div>
                    </a>
                  </div>
                </li>
                <?php if($logout_link != ''):?>
                <li class="nav-item nav-user-icon">
                <a class="nav-link" onclick="customerlogout()" rel="nofollow" style="cursor:pointer;"><small>Logout</small></a>
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
              <a class="nav-link" href="<?php echo $url;?>">
                <i class="mdi mdi mdi-home menu-icon"></i>
                <span class="menu-title">Home</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $url.'ourwork';?>">
                <i class="mdi mdi mdi-ungroup menu-icon"></i>
                <span class="menu-title">Our Work</span>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="mdi mdi mdi-office menu-icon"></i>
                <span class="menu-title">Our Products</span>
                <i class="menu-arrow"></i></a>
                <div class="submenu">
                      <ul class="submenu-item">
                        <li class="nav-item"><a rel="nofollow" class="nav-link" href="<?php echo 'https://www.thakarfertilizersandchemicals.com/';?>" target="_blank">Live Demonstration</a></li>
                        <li class="nav-item"><a rel="nofollow" class="nav-link" href="<?php echo 'https://play.google.com/store/apps/details?id=com.thakar_fertilizer';?>" target="_blank">Live Application</a></li>
                        <li class="nav-item"><a rel="nofollow" class="nav-link" href="<?php echo 'https://shop.jaykrishnasoftware.com/';?>" target="_blank">E-commerce Demo</a></li>
                        <li class="nav-item"><a rel="nofollow" class="nav-link" href="<?php echo 'https://play.google.com/store/apps/details?id=com.jksoftwareshop';?>" target="_blank">Android Application</a></li>
                      </ul>
                </div>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="mdi mdi mdi-clipboard-check menu-icon"></i>
                <span class="menu-title">Technologies</span>
                <i class="menu-arrow"></i></a>
                <div class="submenu">
                      <ul class="submenu-item">
                        <li class="nav-item"><a class="nav-link" href="<?php echo $url.'customize-services-provider';?>">Overall</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $url.'laravel-development-company';?>">Laravel</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $url.'search-engine-optimization-company';?>">SEO</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $url.'wordpress-services-company';?>">Wordpress</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $url.'angular-development-company';?>">Angular</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $url.'react-native-development-company';?>">React Native</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $url.'core-framework-development-company';?>">Core Framework</a></li>
                      </ul>
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $url.'contact';?>">
                <i class="mdi mdi-email-open-outline menu-icon"></i>
                <span class="menu-title">Reach</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">Account</span>
                <i class="menu-arrow"></i></a>
              <div class="submenu">
                    <ul class="submenu-item">
                      <?php
                      if(isset($_SESSION[$front_session_name]['customer_id']) && !empty($_SESSION[$front_session_name]['customer_id'])){
                        $login_user_name = $_SESSION[$front_session_name]['first_name']." ".$_SESSION[$front_session_name]['last_name'];
                        ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $url.'customerdashboard';?>" rel="nofollow">My Account</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $url.'customerprofile';?>" rel="nofollow">My Profile</a></li>
                        <?php /*?><li class="nav-item"><a class="nav-link" href="<?php echo 'guestpost';?>" rel="nofollow">Guest Post</a></li><?php */?>
                      <?php
                      } else { ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $url.'login';?>" rel="nofollow">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $url.'customerdashboard';?>" rel="nofollow">My Account</a></li>
                      <?php } ?>
                    </ul>
              </div>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $url.'blogs';?>">
                <i class="mdi mdi mdi-blogger menu-icon"></i>
                <span class="menu-title">Blog</span>
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="container-fluid page-body-wrapper">