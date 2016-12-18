<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/24/16
 * Time: 12:26 PM
 */
$menus = collect([
		collect([
				'title'=>'General',
				'link'=>'',
				'menu' => collect([
						collect([
								'title'=>'Dashboard',
								'link'=>'dashboard',
								'icon' => 'fa fa-dashboard',
								'label_class' => 'label label-success pull-right',
								'label' => 'New',
								'permission' => 'dashboard'
						]),
						collect([
								'title'=>'Task',
								'icon' => 'fa fa-list-alt',
								'permission' => 'view.task',
								'children'=>collect([
										collect([
												'title' =>'Tasks',
												'link'=>action('TaskController@index'),
												'label_class' => 'label label-success pull-right',
												'label' => 'All',
												'permission' => 'view.task'
										]),
										/*collect([
												'title' =>'Tasks',
												'link'=>action('TaskController@index'),
												'filters'=>'[{"fieldname":"status","value":"Wating for Review"}]',
												'label_class' => 'label label-success pull-right',
												'label' => 'Pending',
												'permission' => 'view.task'
										]),*/
										collect([
												'title' =>'Create Task',
												'link'=>action('TaskController@create'),
												'label_class' => 'label label-info pull-right',
												'label' => 'New',
												'permission' => 'create.task'
										])
								])
						]),
						collect([
								'title'=>'Quotation',
								'icon' => 'fa fa-list-alt',
								'permission' => 'view.quotation',
								'children'=>collect([
										collect([
												'title' =>'Quotations',
												'link'=>action('QuotationController@index'),
												'label_class' => 'label label-success pull-right',
												'label' => 'All',
												'permission' => 'view.quotation',
										]),
										collect([
												'title' =>'Create Quotation',
												'link'=>action('QuotationController@create'),
												'label_class' => 'label label-info pull-right',
												'label' => 'New'
										])
								])
						]),
						collect([
								'title'=>'Trail',
								'icon' => 'fa fa-list-alt',
								'permission' => 'view.trail',
								'children'=>collect([
										collect([
												'title' =>'Trails',
												'link'=>action('TrailController@index'),
												'label_class' => 'label label-success pull-right',
												'label' => 'All',
												'permission' => 'view.trail'
										]),
										collect([
												'title' =>'Create Trail',
												'link'=>action('TrailController@create'),
												'label_class' => 'label label-info pull-right',
												'label' => 'New'
										])
								])
						]),
						collect([
								'title'=>'Invoice',
								'permission' => 'view.invoice',
								'icon' => 'fa fa-list-alt',
								'children'=>collect([
										collect([
												'title' =>'Invoices',
												'link'=>action('InvoiceController@index'),
												'label_class' => 'label label-success pull-right',
												'label' => 'All',
												'permission' => 'view.invoice'
										]),
										collect([
												'title' =>'Create Invoice',
												'link'=>action('InvoiceController@create'),
												'label_class' => 'label label-info pull-right',
												'label' => 'New',
												'permission' => 'create.invoice'
										])
								])
						])

				])
		]),
		collect([
				'title'=>'Report',
				'menu' => collect([
						collect([
								'title'=>'Client',
								'link'=>action('ReportController', 'client'),
								'label_class' => 'label label-success pull-right',
								'label' => 'Report',
								'permission' => 'view.user'
						])
				])
		]),
		collect([
				'title'=>'Setup',
				'menu' => collect([
						collect([
								'title'=>'User',
								'icon' => 'fa fa-users',
								'label_class' => 'fa fa-chevron-down',
								'label' => '',
								'permission' => 'view.user',
								'children' => collect([
										collect([
												'title'=>'Users',
												'link'=>action('UserController@index'),
												'label_class' => 'label label-success pull-right',
												'label' => 'All',
												'permission' => 'view.user'
										]),
										collect([
												'title'=>'Create User',
												'link'=>action('UserController@create'),
												'label_class' => 'label label-info pull-right',
												'label' => 'New',
												'permission' => 'create.user'
										])
								])
						]),
						collect([
								'title'=>'FTPs',
								'icon' => 'fa fa-cloud-upload',
								'label_class' => 'fa fa-chevron-down',
								'label' => '',
								'permission' => 'view.ftp',
								'children' => collect([
										collect([
												'title'=>'FTPs',
												'link'=>action('FTPController@index'),
												'label_class' => 'label label-success pull-right',
												'label' => 'All',
												'permission' => 'view.ftp'
										]),
										collect([
												'title'=>'Create FTP Account',
												'link'=>action('FTPController@create'),
												'label_class' => 'label label-info pull-right',
												'label' => 'New',
												'permission' => 'create.ftp'
										])
								])
						]),
						collect([
								'title'=>'Roles',
								'icon' => 'fa fa-cogs',
								'label_class' => 'fa fa-chevron-down',
								'label' => '',
								'permission' => 'view.role',
								'children' => collect([
										collect([
												'title'=>'Roles',
												'link'=>'admin/role',
												'label_class' => 'label label-success pull-right',
												'label' => 'All',
												'permission' => 'view.role'
										]),
										collect([
												'title'=>'Create Role',
												'link'=>'admin/role/create',
												'label_class' => 'label label-info pull-right',
												'label' => 'New',
												'permission' => 'create.role'
										])
								])
						]),
						collect([
								'title'=>'Permissions',
								'icon' => 'fa fa-user-secret',
								'label_class' => 'fa fa-chevron-down',
								'label' => '',
								'permission' => 'view.permission',
								'children' => collect([
										collect([
												'title'=>'Permissions',
												'link'=>'admin/permission',
												'label_class' => 'label label-success pull-right',
												'label' => 'All',
												'permission' => 'view.permission'
										]),
										collect([
												'title'=>'Create Permission',
												'link'=>'admin/permission/create',
												'label_class' => 'label label-info pull-right',
												'label' => 'New',
												'permission' => 'create.permission'
										])
								])
						]),
						collect([
								'title'=>'Settings',
								'icon' => 'fa fa-cogs',
								'link' => action('SettingController@index'),
								'label_class' => 'label label-warning pull-right',
								'label' => 'config',
								'permission' => ''
						])
				])
		])
]);
?>

{!! Html::menuGenerator($menus) !!}