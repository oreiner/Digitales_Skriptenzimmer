<!DOCTYPE html><html lang="en"><head> 
   <meta charset="utf-8">   
   <meta name="viewport" content="width=device-width, initial-scale=1">    
   <meta http-equiv="x-ua-compatible" content="ie=edge">    <!-- CSRF Token -->    
   <meta name="csrf-token" content="{{ csrf_token() }}">    
   <title>Skripte.koeln | Administratorkonsol</title>   
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">  
   <script type="text/javascript">        var base_path = '{{URL::to('/')}}';  
   </script>  
   <script>  
   window.Laravel = '<?php echo json_encode(['csrfToken' => csrf_token()]); ?>'   
   </script></head>
   <body class="hold-transition sidebar-mini" ><div class="wrapper" id="app">    
   
   <!-- Navbar -->   
		<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">   
			   <!-- Left navbar links -->      
			   <ul class="navbar-nav">       
					<li class="nav-item">             
						   <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>   
						   </li>     
			   </ul>        <!-- SEARCH FORM -->        <form @submit.prevent="searchit" class="form-inline ml-3">            <div class="input-group input-group-sm">   
						   <input class="form-control form-control-navbar" v-model="search" @keyup="searchit" type="search" placeholder="Search" aria-label="Search">            
						   <div class="input-group-append">                    <button class="btn btn-navbar" @click="searchit">                        <i class="fa fa-search"></i>              
						   </button>                </div>            </div>        </form>    </nav>    <!-- /.navbar -->    <!-- Main Sidebar Container -->    <aside class="main-sidebar sidebar-dark-primary elevation-4"> 
						   <!-- Brand Logo -->        <a href="{{url('/admin')}}" class="brand-link">            <img src="{{asset('img/logo.png')}}" alt="Lara Start Logo" class="brand-image img-circle elevation-3"    
						   style="opacity: .8">            <span class="brand-text font-weight-light">Skripte.Koeln</span>        </a>        <!-- Sidebar -->        <div class="sidebar">        
						   <!-- Sidebar user panel (optional) -->            <div class="user-panel mt-3 pb-3 mb-3 d-flex">                <div class="image">                    <img src="{{asset('img/profile.png')}}" class="img-circle elevation-2" alt="User Image">                </div>                <div class="info">                    <a href="#" class="d-block">{{Auth::guard('admins')->user()->name}}</a>      
						   </div>            </div>            <!-- Sidebar Menu -->            <nav class="mt-2">          
						   <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						   
								   <!-- Add icons to the links using the .nav-icon class                         with font-awesome or any other icon font library -->          
								   <li class="nav-item">                        <router-link to="/admin" class="nav-link">                     
										<i class="nav-icon fa fa-tachometer-alt"></i>        
											<p>                                Startseite                            </p>                        </router-link>           
									</li>               
								   {{--@can('isAdmin')--}}   
									<li class="nav-item">                              
								   <router-link to="/admin/users" class="nav-link">                                    <i class="fa fa-user-edit nav-icon"></i>                                    <p>Benutzer</p>    
								   </router-link>                            </li>		
								   <li class="nav-item has-treeview">                        <a href="#" class="nav-link">                  
										<i class="nav-icon fa fa-cog"></i>                            <p>                                Protokolle-Management                                <i class="right fa fa-angle-left"></i> 
								   </p>                        </a>                      

								   <ul class="nav nav-treeview">                            
								                               <li class="nav-item">                                <router-link to="/admin/examiners" class="nav-link">	
								   <i class="fas fa-chalkboard-teacher nav-icon"></i>                                    <p>Prüfer</p>                                </router-link>                            </li>   
								   <li class="nav-item">                                <router-link to="/admin/tests" class="nav-link">                                    <i class="fas fa-book nav-icon"></i>        
								   <p>Prüfung</p>                                </router-link>                            </li>                            <li class="nav-item">                             
								   <router-link to="/admin/testexaminers" class="nav-link">                                    <i class="fas fa-file nav-icon"></i>                                
								   <p>Verknüpfte Prüfer-Prüfung</p>                                </router-link>                            </li>                            <li class="nav-item">    
								   <router-link to="/admin/usertotests" class="nav-link">                                    <i class="fa fa-user-check nav-icon"></i>                                
								   <p>Empfangene Protokolle</p>                                </router-link>                            </li>                        </ul>                    </li>            
										{{--<li class="nav-item">--}}                        {{--<router-link to="/admin/developer" class="nav-link">--}}                        
								{{--<i class="nav-icon fa fa-cogs"></i>--}}                            {{--<p>--}}                                {{--Developer--}}      
								{{--</p>--}}                        {{--</router-link>--}}                    {{--</li>--}}                    {{--@endcan--}}              
					<li class="nav-item">                        <router-link to="/admin/uploadpdfs" class="nav-link">                          
					<i class="fa fa-book-open nav-icon"></i>                            <p>                                Skript hochladen                 
					</p>                        </router-link>                    </li>					<!--                    <li class="nav-item">   
					<router-link to="/admin/profile" class="nav-link">                            <i class="nav-icon fa fa-user"></i>                            <p>                                Profil                            </p>                        </router-link>                    </li>					!-->                    <li class="nav-item">                        <a class="nav-link" href="{{ url('/admin/logout') }}"><i class="nav-icon fa fa-power-off"></i><p>{{ __('Abmelden') }}</p></a>                        <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">                            @csrf                        </form>                    </li>                </ul>            </nav>            <!-- /.sidebar-menu -->        </div>        <!-- /.sidebar -->    </aside>    <!-- Content Wrapper. Contains page content -->    <div class="content-wrapper">        <!-- Main content -->        <div class="content">            <div class="container-fluid">                <!-- for example router view -->                <router-view></router-view>                <!-- set progressbar -->                <vue-progress-bar></vue-progress-bar>            </div><!-- /.container-fluid -->        </div>        <!-- /.content -->    </div>    <!-- /.content-wrapper -->    <!-- Main Footer -->    <footer class="main-footer">        <!-- To the right -->        <div class="float-right d-none d-sm-inline">            Zusammen die Prüfungen bestehen        </div>        <!-- Default to the left -->        <strong>Copyright &copy; 2014-2018 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.    </footer></div><!-- ./wrapper -->    <script>        window.user = @json(Auth::guard('admins')->user())    </script><!-- REQUIRED SCRIPTS --><!-- jQuery --><script src="{{ asset('js/app.js') }}" defer></script></body></html>