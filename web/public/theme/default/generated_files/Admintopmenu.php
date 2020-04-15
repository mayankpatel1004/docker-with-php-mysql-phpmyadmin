<?php
global $cf;
$arrAccessModules = $cf->checkPermittedModules();
$item_menu = array();
$dashboard_menu = array();
$task_menu = array();
$report_menu = array();
$logs_menu = array();
$user_menu = array();
$customer_menu = array();
$ecommerce_menu = array();
$inventory_menu = array();

$all_dashboard_menu = array(
    'dashboard' => 'Dashboard'
);

if(isset($all_dashboard_menu) && $all_dashboard_menu != false) {
    foreach($all_dashboard_menu as $alias => $title) {
        if(in_array($alias,$arrAccessModules)){
            $dashboard_menu[$alias] = $title;
        }
    }
}

$all_items_menu = array(
    'allmedia' => 'Media',
    'allpages' => 'Pages',
    'calendar' => 'Calendar',
    'allevents' => 'Events',
    'allgalleries' => 'Gallery',
    'allblogs' => 'Blogs',
    'blog_category' => 'Blog Category',
    'allbanners' => 'Banners',
    'portfolio_category' => 'Portfolio Category',
    'portfolio' => 'Portfolio'
);

if(isset($all_items_menu) && $all_items_menu != false) {
    foreach($all_items_menu as $alias => $title) {
        if(in_array($alias,$arrAccessModules)){
            $item_menu[$alias] = $title;
        }
    }
}

$all_tasks_menu = array(
    'clients' => 'Clients',
    'projects' => 'Projects',
    'alltasks' => 'Tasks',
    'allleaves' => 'Leaves',
    'alltimecard' => 'Timecard'
);

if(isset($all_tasks_menu) && $all_tasks_menu != false) {
    foreach($all_tasks_menu as $alias => $title) {
        if(in_array($alias,$arrAccessModules)){
            $task_menu[$alias] = $title;
        }
    }
}

$all_report_menu = array(
    'reportitem' => 'Items',
    'reportsections' => 'Sections',
    'reportactivities' => 'Activities',
    'reporttimecard' => 'Timecard',
    'reportvisitors' => 'Visitors',
    'reporttasks' => 'Tasks'
);

if(isset($all_report_menu) && $all_report_menu != false) {
    foreach($all_report_menu as $alias => $title) {
        if(in_array($alias,$arrAccessModules)){
            $report_menu[$alias] = $title;
        }
    }
}


$all_logs_menu = array(
    'allvisitors' => 'Visitor',
    'allloginlogs' => 'Login',
    'allactivities' => 'Activities'
);

if(isset($all_logs_menu) && $all_logs_menu != false) {
    foreach($all_logs_menu as $alias => $title) {
        if(in_array($alias,$arrAccessModules)){
            $logs_menu[$alias] = $title;
        }
    }
}


$all_user_menu = array(
    'siteconfiguration' => 'Site Configuration',
    'allroles' => 'Roles',
    'allusers' => 'Users'
);

if(isset($all_user_menu) && $all_user_menu != false) {
    foreach($all_user_menu as $alias => $title) {
        if(in_array($alias,$arrAccessModules)){
            $user_menu[$alias] = $title;
        }
    }
}


$all_customer_menu = array(
    'allsubscribers' => 'Subscribers',
    'allnewsletters' => 'Send Newsletter',
    'allcontacts' => 'Contacts',
    'allcomments' => 'Comments'
);

if(isset($all_customer_menu) && $all_customer_menu != false) {
    foreach($all_customer_menu as $alias => $title) {
        if(in_array($alias,$arrAccessModules)){
            $customer_menu[$alias] = $title;
        }
    }
}


$all_ecommerce_menu = array(
    'allproducts' => 'Product List',
    'product_category' => 'Product Categories',
    'allorders' => 'Placed Orders'
);

if(isset($all_ecommerce_menu) && $all_ecommerce_menu != false) {
    foreach($all_ecommerce_menu as $alias => $title) {
        $ecommerce_menu[$alias] = $title;
    }
}

$all_inventory_menu = array(
    'allinventories' => 'In Store',
    'inventorystock' => 'Manage Stock',
    'alldispatches' => 'Dispatched',
    'allreturnitems' => 'Return Item',
    'inventoryactivities' => 'Activities',
    'inventoryreports' => 'Reports'
);

if(isset($all_inventory_menu) && $all_inventory_menu != false) {
    foreach($all_inventory_menu as $alias => $title) {
        $inventory_menu[$alias] = $title;
    }
}
?>