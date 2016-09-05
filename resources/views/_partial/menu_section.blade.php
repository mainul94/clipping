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
                                'label' => 'New'
                        ]),
                        collect([
                                'title'=>'Article',
                                'icon' => 'fa fa-list-alt',
                                'children'=>collect([
                                        collect([
                                            'title' =>'Articles',
                                                'link'=>action('ArticleController@index'),
                                                'label_class' => 'label label-success pull-right',
                                                'label' => 'All'
                                        ]),
                                        collect([
                                            'title' =>'Create Article',
                                                'link'=>action('ArticleController@create'),
                                                'label_class' => 'label label-info pull-right',
                                                'label' => 'New'
                                        ])
                                ])
                        ]),
                        collect([
                                'title'=>'Category',
                                'icon' => 'fa fa-tags',
                                'children'=>collect([
                                        collect([
                                            'title' =>'Categories',
                                                'link'=>action('CategoryController@index'),
                                                'label_class' => 'label label-success pull-right',
                                                'label' => 'All'
                                        ]),
                                        collect([
                                            'title' =>'Create Category',
                                                'link'=>action('CategoryController@create'),
                                                'label_class' => 'label label-info pull-right',
                                                'label' => 'New'
                                        ])
                                ])
                        ]),
                        collect([
                                'title'=>'Page',
                                'icon' => 'fa fa-file',
                                'children'=>collect([
                                        collect([
                                            'title' =>'Pages',
                                                'link'=>action('PageController@index'),
                                                'label_class' => 'label label-success pull-right',
                                                'label' => 'All'
                                        ]),
                                        collect([
                                            'title' =>'Create Page',
                                                'link'=>action('PageController@create'),
                                                'label_class' => 'label label-info pull-right',
                                                'label' => 'New'
                                        ])
                                ])
                        ]),
                        collect([
                                'title'=>'Slide',
                                'icon' => 'fa fa-play-circle-o',
                                'children'=>collect([
                                        collect([
                                            'title' =>'Slides',
                                                'link'=>action('SlideController@index'),
                                                'label_class' => 'label label-success pull-right',
                                                'label' => 'All'
                                        ]),
                                        collect([
                                            'title' =>'Create Slide',
                                                'link'=>action('SlideController@create'),
                                                'label_class' => 'label label-info pull-right',
                                                'label' => 'New'
                                        ])
                                ])
                        ]),
                        collect([
                                'title'=>'Media',
                                'icon' => 'fa fa-play-circle-o',
                                'children'=>collect([
                                        collect([
                                            'title' =>'Media',
                                                'link'=>action('MediaController@index'),
                                                'label_class' => 'label label-success pull-right',
                                                'label' => 'All'
                                        ]),
                                        collect([
                                            'title' =>'Add Media',
                                                'link'=>action('MediaController@create'),
                                                'label_class' => 'label label-info pull-right',
                                                'label' => 'New'
                                        ])
                                ])
                        ])
                ])
        ]),
        collect([
                'title'=>'Setup',
                'menu' => collect([
                        collect([
                                'title'=>'Region',
                                'icon' => 'fa fa-globe',
                                'children' => collect([
                                        collect([
                                                'title'=>'Region',
                                                'link'=>action('RegionController@index'),
                                                'label_class' => 'label label-success pull-right',
                                                'label' => 'All'
                                        ]),
                                        collect([
                                                'title'=>'Create Region',
                                                'link'=>action('RegionController@create'),
                                                'label_class' => 'label label-info pull-right',
                                                'label' => 'New'
                                        ])
                                ])
                        ]),
                        collect([
                                'title'=>'Country',
                                'icon' => 'fa fa-map',
                                'children' => collect([
                                        collect([
                                                'title'=>'Country',
                                                'link'=>action('CountryController@index'),
                                                'label_class' => 'label label-success pull-right',
                                                'label' => 'All'
                                        ]),
                                        collect([
                                                'title'=>'Create Country',
                                                'link'=>action('CountryController@create'),
                                                'label_class' => 'label label-info pull-right',
                                                'label' => 'New'
                                        ])
                                ])
                        ]),
                        collect([
                                'title'=>'Division',
                                'icon' => 'fa fa-map-o',
                                'children' => collect([
                                        collect([
                                                'title'=>'Division',
                                                'link'=>action('DivisionController@index'),
                                                'label_class' => 'label label-success pull-right',
                                                'label' => 'All'
                                        ]),
                                        collect([
                                                'title'=>'Create Division',
                                                'link'=>action('DivisionController@create'),
                                                'label_class' => 'label label-info pull-right',
                                                'label' => 'New'
                                        ])
                                ])
                        ]),
                        collect([
                                'title'=>'User',
                                'icon' => 'fa fa-users',
                                'label_class' => 'fa fa-chevron-down',
                                'label' => '',
                                'children' => collect([
                                        collect([
                                                'title'=>'Users',
                                                'link'=>action('UserController@index'),
                                                'label_class' => 'label label-success pull-right',
                                                'label' => 'All'
                                        ]),
                                        collect([
                                                'title'=>'Create Role',
                                                'link'=>action('UserController@create'),
                                                'label_class' => 'label label-info pull-right',
                                                'label' => 'New'
                                        ])
                                ])
                        ]),
                        collect([
                                'title'=>'Roles',
                                'icon' => 'fa fa-cogs',
                                'label_class' => 'fa fa-chevron-down',
                                'label' => '',
                                'children' => collect([
                                        collect([
                                                'title'=>'Roles',
                                                'link'=>'admin/role',
                                                'label_class' => 'label label-success pull-right',
                                                'label' => 'All'
                                        ]),
                                        collect([
                                                'title'=>'Create Role',
                                                'link'=>'admin/role/create',
                                                'label_class' => 'label label-info pull-right',
                                                'label' => 'New'
                                        ])
                                ])
                        ]),
                        collect([
                                'title'=>'Permissions',
                                'icon' => 'fa fa-user-secret',
                                'label_class' => 'fa fa-chevron-down',
                                'label' => '',
                                'children' => collect([
                                        collect([
                                                'title'=>'Permissions',
                                                'link'=>'admin/permission',
                                                'label_class' => 'label label-success pull-right',
                                                'label' => 'All'
                                        ]),
                                        collect([
                                                'title'=>'Create Permission',
                                                'link'=>'admin/permission/create',
                                                'label_class' => 'label label-info pull-right',
                                                'label' => 'New'
                                        ])
                                ])
                        ]),
                        collect([
                                'title'=>'Settings',
                                'icon' => 'fa fa-cogs',
                                'link' => action('SettingController@index'),
                                'label_class' => 'label label-warning pull-right',
                                'label' => 'config'
                        ])
                ])
        ])
]);
?>

{!! Html::menuGenerator($menus) !!}