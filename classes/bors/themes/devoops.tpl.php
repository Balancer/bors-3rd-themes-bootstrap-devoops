<?php
	use HtmlObject\Element;
	use HtmlObject\Link;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?= htmlspecialchars($self->browser_title());?></title>
		<meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link href="/_bors-assets/vendor/balancer/bors-3rd-themes-bootstrap-devoops/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet">
		<link href='//fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
<!--		<link href="/_bors-assets/vendor/balancer/bors-3rd-themes-bootstrap-devoops/plugins/fancybox/jquery.fancybox.css" rel="stylesheet"> -->
<!--		<link href="/_bors-assets/vendor/balancer/bors-3rd-themes-bootstrap-devoops/plugins/fullcalendar/fullcalendar.css" rel="stylesheet"> -->
<!--		<link href="/_bors-assets/vendor/balancer/bors-3rd-themes-bootstrap-devoops/plugins/xcharts/xcharts.min.css" rel="stylesheet"> -->
<!--		<link href="/_bors-assets/vendor/balancer/bors-3rd-themes-bootstrap-devoops/plugins/select2/select2.css" rel="stylesheet"> -->
		<link href="/_bors-assets/vendor/balancer/bors-3rd-themes-bootstrap-devoops/css/style.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
<body>
<!--Start Header-->
<div id="screensaver">
	<canvas id="canvas"></canvas>
	<i class="fa fa-lock" id="screen_unlock"></i>
</div>
<div id="modalbox">
	<div class="devoops-modal">
		<div class="devoops-modal-header">
			<div class="modal-header-name">
				<span>Basic table</span>
			</div>
			<div class="box-icons">
				<a class="close-link">
					<i class="fa fa-times"></i>
				</a>
			</div>
		</div>
		<div class="devoops-modal-inner">
		</div>
		<div class="devoops-modal-bottom">
		</div>
	</div>
</div>
<header class="navbar">
	<div class="container-fluid expanded-panel">
		<div class="row">
			<div id="logo" class="col-xs-12 col-sm-2">
<?php
	echo Link::create($self->project()->url(), $self->project()->title());
?>
			</div>
			<div id="top-panel" class="col-xs-12 col-sm-10">
				<div class="row">
					<div class="col-xs-8 col-sm-4">
						<a href="#" class="show-sidebar">
						  <i class="fa fa-bars"></i>
						</a>
						<div id="search">
							<input type="text" placeholder="search"/>
							<i class="fa fa-search"></i>
						</div>
					</div>
					<div class="col-xs-4 col-sm-8 top-panel-right">
						<ul class="nav navbar-nav pull-right panel-menu">
							<li class="hidden-xs">
								<a href="index.html" class="modal-link">
									<i class="fa fa-bell"></i>
									<span class="badge">7</span>
								</a>
							</li>
							<li class="hidden-xs">
								<a class="ajax-link" href="ajax/calendar.html">
									<i class="fa fa-calendar"></i>
									<span class="badge">7</span>
								</a>
							</li>
							<li class="hidden-xs">
								<a href="ajax/page_messages.html" class="ajax-link">
									<i class="fa fa-envelope"></i>
									<span class="badge">7</span>
								</a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle account" data-toggle="dropdown">
									<div class="avatar">
										<imgx src="img/avatar.jpg" class="img-rounded" alt="avatar" />
									</div>
									<i class="fa fa-angle-down pull-right"></i>
									<div class="user-mini pull-right">
										<span class="welcome">Welcome,</span>
										<span><?= htmlspecialchars(bors()->user()->title()); ?></span>
									</div>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="#">
											<i class="fa fa-user"></i>
											<span>Profile</span>
										</a>
									</li>
									<li>
										<a href="ajax/page_messages.html" class="ajax-link">
											<i class="fa fa-envelope"></i>
											<span>Messages</span>
										</a>
									</li>
									<li>
										<a href="ajax/gallery_simple.html" class="ajax-link">
											<i class="fa fa-picture-o"></i>
											<span>Albums</span>
										</a>
									</li>
									<li>
										<a href="ajax/calendar.html" class="ajax-link">
											<i class="fa fa-tasks"></i>
											<span>Tasks</span>
										</a>
									</li>
									<li>
										<a href="#">
											<i class="fa fa-cog"></i>
											<span>Settings</span>
										</a>
									</li>
									<li>
										<a href="#">
											<i class="fa fa-power-off"></i>
											<span>Logout</span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<!--End Header-->
<!--Start Container-->
<div id="main" class="container-fluid">
	<div class="row">
		<div id="sidebar-left" class="col-xs-2 col-sm-2">
			<ul class="nav main-menu">
<?php
	$navbar = $self->navbar();
	foreach($navbar['Разделы'] as $title => $items)
	{
		if(is_array($items))
		{
			$url = popval($items, 'url');
			$icon = popval($items, 'i_class');
			if(!$icon)
				$icon = 'fa fa-circle-o';
			if(count($items) == 1)
				$items = array_pop($items);
		}
		else
		{
			$url = $items;
			$icon = 'fa fa-circle-o';
		}

		if(is_array($items))
		{
			$link = Link::create('#', '')->addClass("dropdown-toggle");

			$link->appendChild(Element::i()->addClass($icon));

			$link->appendChild(Element::span($title)->addClass("hidden-xs"));

			$link->appendChild(Element::i()->addClass("fa fa-folder-o")->addClass('pull-right'));

			echo Element::li()->addClass("dropdown")
				->nest($link)
				->appendChild(bors_layouts_bootstrap3_dropdown::draw_dropdown([$title => $items], 1));
		}
		else
		{
			if(preg_match('/^\w+$/', $url))
				$url = "/$url/";

			echo Element::li()->nest(
				Link::create($url, '')
					->appendChild(Element::i()->addClass($icon))
					->appendChild(Element::span($title)->addClass('hidden-xs'))
			);
		}
	}
?>
			</ul>
		</div>
		<!--Start Content-->
		<div id="content" class="col-xs-12 col-sm-10">
<?php require __DIR__.'/devoops/breadcrumbs.tpl.php'; ?>

<div id="dashboard-header" class="row">
	<div class="col-xs-10 col-sm-2">
		<h1><?= htmlspecialchars($self->page_title());?></h1>
	</div>
</div>

<div class="row">
	<div class="col-xs-10">
<?= $self->body(); ?>
	</div>
	<div class="col-xs-2">
<?php
	if($self->get('object_type'))
	{
		$new_object_type = " imaged type-{$self->get('object_type')}";
		$c_li_type = " class='imaged type-{$self->get('object_type')}'";
	}

	if($self->get('new_object_type'))
	{
		$new_object_type = " imaged type-{$self->get('new_object_type')}";
	}

	echo "<ul>";

	if($self->get('search_link'))
		echo "<li class=\"imaged type-search\"><a href=\"{$self->get('search_link')}\">Поиск</a></li>";
	if($self->get('side_menu'))
	{
		foreach($self->side_menu() as $title => $list)
		{
			echo "<h3>".htmlspecialchars($title)."</h3>";
			echo "<ul style=\"padding-bottom: 8px;\">";
			foreach($list as $link)
			{
				if(!empty($link['url']))
					echo "<li".(@$link['type']?" class=\"imaged type-{$link['type']}\"":"")."><a href=\"{$link['url']}\">{$link['title']}</a></li>";
				else
					echo "<li".(@$link['type']?" class=\"imaged type-{$link['type']}\"":"").">{$link['title']}</li>";
			}
			echo "</ul>";
		}
	}
	elseif($self->get('admin_group_url'))
		echo "<li class=\"imaged type-unknown\"><a href=\"{$self->admin_group_url()}\">"
			.bors_ucfirst(bors_load_uri($self->admin_group_url())->get('nav_name'))
			."</a></li>";

	echo "</ul>";

	if($self->get('admin_group_url'))
	{
?>
<form style="padding: 0 0 10px 10px; margin: 0;" name="goidrm"
	onSubmit="document.location='<?= $self->get('admin_group_url')/*'*/?>'+forms['goidrm'].elements['id'].value+'/'; return false"><?php /*"*/?>
<input type="text" name="id" size="4" placeholder="ID"/>
<input type="submit" class="search-submit" value="Перейти" />
</form>
<?php
	}

	if($self->get('search_request_url'))
	{
?>
<form style="padding: 0 0 10px 10px; margin: 0;" action="<?= $self->get('search_request_url');/*"*/?>">
<input type="text" name="q" size="15" placeholder="запрос" value="{$smarty.get.q}" /><input type="submit" class="search-submit" value="искать" />
</form>
<?php
	}
?>

	</div>
</div>

		</div>
		<!--End Content-->
	</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="/_bors-assets/vendor/balancer/bors-3rd-themes-bootstrap-devoops/plugins/jquery-ui/jquery-ui.min.js"></script>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- <script src="/_bors-assets/vendor/balancer/bors-3rd-themes-bootstrap-devoops/plugins/justified-gallery/jquery.justifiedgallery.min.js"></script> -->
<!-- <script src="/_bors-assets/vendor/balancer/bors-3rd-themes-bootstrap-devoops/plugins/tinymce/tinymce.min.js"></script> -->
<!-- <script src="/_bors-assets/vendor/balancer/bors-3rd-themes-bootstrap-devoops/plugins/tinymce/jquery.tinymce.min.js"></script> -->

<script src="/_bors-assets/vendor/balancer/bors-3rd-themes-bootstrap-devoops/js/devoops.js"></script>
</body>
</html>
