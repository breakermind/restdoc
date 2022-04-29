<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>RestDoc Rest Api Documentation</title>

	<link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">

	<style type="text/css">
		* {box-sizing: border-box;}
		html, body {margin: 0px, padding: 0px; font-family: 'Fira Code';}
		a {text-decoration: none; color: #fff; color: #003399; border:  1px solid #003399; background: #00339911;}
		.title {float: left; width: 100%; color: #003399; font-size: 21px; font-weight: 300; margin-bottom: 10px;}
		.title-rest {float: left; width: 100%; color: #003399; font-size: 21px; font-weight: 300; margin: 20px 0px 5px 0px;}
		.menu {float: left; width: 100%;}
		.menu__link {float: left; width: auto; margin: 10px 10px 10px 0px; padding: 10px 25px; font-weight: 900; border-radius: 6px;}

		.part-box {float: left; width: 100%; padding: 10px 20px; border: 1px solid #00339911; overflow: hidden; border-radius: 6px; margin-bottom: 30px;}
		.part-title {color: #003399; font-size: 21px; font-weight: 700; padding: 5px 0px; border-bottom: 1px solid #00339911;}
		.part {display: flex; align-items: center; justify-content: start; margin-bottom: 10px; border: 1px solid #55cc55; border-radius: 6px}
		.part .method-get {color: #fff; background: #0099ff;}
		.part-get {color: #fff; background: #0099ff11; color: #0099ff; border: 1px solid #0099ff}
		.part-post {color: #fff; background: #55cc5511; color: #55cc55; border: 1px solid #55cc55}
		.part-put {color: #fff; background: #ff990011; color: #ff9900; border: 1px solid #ff9900}
		.part-patch {color: #fff; background: #ff990011; color: #ff9900; border: 1px solid #ff9900}
		.part-delete {color: #fff; background: #ff220011; color: #ff2200; border: 1px solid #ff2200}

		.part .method {padding: 10px; margin: 10px; border-radius: 6px; min-width: 80px; text-align: center;}
		.part .route {padding: 10px; margin: 10px; font-weight: 900; color: #000;}
		.part .description {padding: 10px; margin: 10px; color: #444;}
		.part .method-get {color: #fff; background: #0099ff;}
		.part .method-post {color: #fff; background: #55cc55;}
		.part .method-put {color: #fff; background: #ff9900;}
		.part .method-patch {color: #fff; background: #ff9900;}
		.part .method-delete {color: #fff; background: #ff2200;}
		i {padding: 10px 20px;}
	</style>
</head>
<body>
	<div class="title">{{ $doc->title }}</div>
	<p>{{ $doc->desc }}</p>

	<div class="title">Rest Api Links</div>

	<div class="menu">
		@foreach ($doc->parts() as $p)
			<a href="#{{ $p->id }}" class="menu__link">{{ $p->title }}</a>
		@endforeach
	</div>

	<div class="title-rest">Rest Api Routes</div>

	<div class="content">
		@foreach ($doc->parts() as $p)
			<div class="part-box">
				<div id="{{ $p->id }}" class="part-title">{{ $p->title }}</div>
				<p>{{ $p->desc }}</p>

				@foreach ($p->methods() as $m)
					<div class="part part-{{ strtolower($m['method']->label()) }}">
						<div class="method method-{{ strtolower($m['method']->label()) }}"> {{ $m['method']->label() }} </div>
						<div class="route"> {{ $m['route'] }} </div>
						<div class="description"> {{ $m['desc'] }} </div>
						@if($m['auth'] == true)
							<i class="fa-solid fa-lock" title="Authenticated users only!"></i>
						@endif
					</div>
				@endforeach
			</div>
		@endforeach
	</div>
</body>
</html>