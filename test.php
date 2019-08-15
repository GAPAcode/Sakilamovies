<!DOCTYPE html>
<html>
<head>
	<title>Sakila - Best Movies</title>
	<link rel="stylesheet" type="text/css" href="/sakila/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/sakila/css/main.css">
	<link rel="stylesheet" type="text/css" href="/sakila/css/font-awesome.css">

</head>
<body class="bg-secondary">

<div id="escrol" data-spy="scroll" data-target="#stores" data-offset="1" style="position: relative;">
<!-- The navbar - The <a> elements are used to jump to a section in the
scrollable area -->
	<nav id="stores" class="navbar navbar-expand-sm bg-dark navbar-dark">
		<ul class="navbar-nav">
			<li class="nav-item"><a class="nav-link" href="#section1">Section 1</a></li>
			<li class="nav-item"><a class="nav-link" href="#section2">Section 2</a></li>
		</ul>
	</nav>
	<!-- Section 1 -->
	<div id="section1">
		<h1>Section 1</h1>
		<p>Try to scroll this page and look at the navigation bar while
		scrolling!</p>
	</div>

	<div id="section2">
		<h3>Store 2</h3>
		<table>
			<thead>
				<th>id</th>
				<th>Film Name</th>
				<th>Quantity</th>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript" src="/sakila/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/sakila/js/bootstrap.bundle.js"></script>
<script type="text/javascript" src="/sakila/js/util.js"></script>
</body>
</html>