<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>RestDoc Rest Api Documentation</title>

	<link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

	<style type="text/css">
		* {box-sizing: border-box; font-family: 'Fira Code';}
		body {padding: 0px;}
		.box {float: left; width: 100%; padding: 10px; box-sizing: border-box;}
		a {text-decoration: none; color: #fff; color: #003399; border:  1px solid #003399; background: #00339911;}
		.title {float: left; width: 100%; color: #003399; font-size: 21px; font-weight: 300; margin-bottom: 10px;}
		.title-rest {float: left; width: 100%; color: #003399; font-size: 21px; font-weight: 300; margin: 20px 0px 5px 0px;}
		.menu {float: left; width: 100%;}
		.menu__link {float: left; width: auto; margin: 10px 10px 10px 0px; padding: 10px 25px; font-weight: 900; border-radius: 6px;}

		.part-box {float: left; width: 100%; padding: 10px 20px; border: 1px solid #00339911; overflow: hidden; border-radius: 6px; margin-bottom: 30px;}
		.part-title {color: #003399; font-size: 21px; font-weight: 700; padding: 5px 0px; border-bottom: 1px solid #00339911;}
		.part {display: flex; align-items: center; justify-content: start; margin: 10px 0px; border: 1px solid #55cc55; border-radius: 6px; cursor: pointer;}
		.part .method-get {color: #fff; background: #0099ff;}
		.part-get {color: #fff; background: #0099ff11; color: #0099ff; border: 1px solid #0099ff}
		.part-post {color: #fff; background: #55cc5511; color: #55cc55; border: 1px solid #55cc55}
		.part-put {color: #fff; background: #ff990011; color: #ff9900; border: 1px solid #ff9900}
		.part-patch {color: #fff; background: #ff990011; color: #ff9900; border: 1px solid #ff9900}
		.part-delete {color: #fff; background: #ff220011; color: #ff2200; border: 1px solid #ff2200}

		.part .method {padding: 10px; margin: 10px; border-radius: 6px; min-width: 100px; text-align: center; white-space: nowrap;}
		.part .route {padding: 10px; margin: 10px; font-weight: 900; color: #000;}
		.part .description {padding: 10px; margin: 10px; color: #444;}
		.part .method-get {color: #fff; background: #0099ff;}
		.part .method-post {color: #fff; background: #55cc55;}
		.part .method-put {color: #fff; background: #ff9900;}
		.part .method-patch {color: #fff; background: #ff9900;}
		.part .method-delete {color: #fff; background: #ff2200;}

		.open .part {border-radius: 6px 6px 0px 0px;}
		.row__details {display: none; float: left; width: 100%; margin: 0px 0px 20px 0px; padding: 10px; border-radius: 6px;}
		.open + .row__details {display: inherit; font-size: 15px;}
		.row__details_title {font-size: 18px; font-weight: 700; float: left; width: 100%; padding: 10px; margin: 5px 0px; background: #00339909; border-radius: 6px;}
		.param__bg {float: left; width: 100%; padding: 10px; margin: 5px 0px; background: #fff; color: #003399; border-radius: 6px;}
		.param__details {float: left; width: 100%; padding: 5px 0px;}
		.bold {color: #039 !important; font-weight: 700}
		.bold-red {color: #f23 !important; font-weight: 700}
		.bold__title {float: left; width: 100%; padding: 5px 0px; font-weight: 600; font-size: 14px;}
		.header {display: flex; float: left; width: 100%; padding: 5px 0px; background: #fff; color: #003399}
		.header__name {font-weight: 700; padding: 5px;}
		.header__desc {font-weight: 400; padding: 5px;}
		.header__type {font-weight: 700; padding: 5px;}

		.border-get {border-left: 2px solid #0099ff;}
		.border-post {border-left: 2px solid #55cc55;}
		.border-put {border-left: 2px solid #ff9900;}
		.border-patch {border-left: 2px solid #ff9900;}
		.border-delete {border-left: 2px solid #ff2200;}

		i {padding: 0px;}
	</style>

	<script type="text/javascript">
		function tg(it) {
			it.classList.toggle('open');
		}
	</script>
</head>
<body>
	<div class="box">
		<div class="title">{{ $doc->title }}</div>
		<p>{{ $doc->desc }}</p>

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
						<div class="row">
							<div class="part part-{{ strtolower($m['method']->label()) }}" onclick="tg(this)">
								<div class="method method-{{ strtolower($m['method']->label()) }}">
									{{ $m['method']->label() }}

									@if($m['auth'] == true)
										<i class="fa-solid fa-lock" title="Authenticated users only!"></i>
									@endif
								</div>
								<div class="route"> {{ $m['route'] }} </div>
								<div class="description"> {{ $m['desc'] }} </div>
							</div>

							<div class="row__details part-{{ strtolower($m['method']->label()) }} animate__animated animate__zoomIn">

								@if(!empty($m['headers']))
									<div class="row__details_title border-{{ strtolower($m['method']->label()) }}">Request headers</div>
									@foreach ($m['headers'] as $h)
										<div class="param__details">
											<span class="bold"> {{ $h['name'] }}  </span>  {{ $h['desc'] }}
											<span class="bold-red">({{ $h['type'] }})</span>
										</div>
									@endforeach
								@endif

								<div class="row__details_title border-{{ strtolower($m['method']->label()) }}">Parametrs</div>
								<div>
									@foreach ($m['params'] as $p)
										<div class="param__details">
											<span class="bold"> {{ $p['name'] }} </span> [{{ $p['type'] }}] {{ $p['desc'] }}

											@if($p['required'] == true)
												<span class="bold-red">(required)</span>
											@endif

											@if(!empty($p['default']))
												<div class="bold__title">Default:</div>
												<div class="param__bg">
													{{ $p['default'] }}
												</div>
											@endif

											@if(!empty($p['sample']))
												<div class="bold__title">Sample:</div>
												<div class="param__bg">
													<code>
													{{ $p['sample'] }}
													</code>
												</div>
											@endif
										</div>
									@endforeach
								</div>

								<div class="row__details_title border-{{ strtolower($m['method']->label()) }}">Responses</div>
								<div>
									@foreach ($m['responses'] as $p)
										<div class="param__details">
											<span class="bold"> {{ $p['code'] }} </span>
											{{ $p['desc'] }}

											@if(!empty($p['sample']))
												<div class="bold__title">Sample:</div>
												<div class="param__bg">
													<code>
													{{ $p['sample'] }}
													</code>
												</div>
											@endif

											@if(!empty($p['model']))
												<div class="bold__title">Model:</div>
												<div class="param__bg">
													{{ $p['model'] }}
												</div>
											@endif

											@if(!empty($p['headers']))
												<div class="bold__title">Headers:</div>
												@foreach ($p['headers'] as $h)
													<div class="header">
														<div class="header__name">{{ $h['name'] }}</div>
														<div class="header__desc">{{ $h['desc'] }}</div>
														<div class="header__type">({{ $h['type'] }})</div>
													</div>
												@endforeach
											@endif
										</div>
									@endforeach
								</div>
							</div>
						</div>
					@endforeach
				</div>
			@endforeach
		</div>
	</div>
</body>
</html>