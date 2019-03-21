<!DOCTYPE html>
<html>
<head>
	<title>DarkHorse</title>
	<style type="text/css">
		body {
			background-color: black;
		}
		form {
			text-align: center;
			color: red;
		}
		form > label {
			display: block;
			font-size: 2rem;
		}
		form > textarea {
		    width: 30%;
		    height: 150px;
		    display: block;
		    margin: 20px auto;
		}
		li {
			list-style-type: none;
		}
		#submit {
			font-size: 2rem;
			color: red;
			background-color: #212121;
			border: 1px #212121 solid;
			border-radius: 5px;
			cursor: pointer;
		}
		#extension {
			display: block;
			margin: 20px auto;
		}
	</style>
</head>
<body>
	<form action="./cleaner.php" method="post">
		<label>Choose paths:</label>
		<ul>
			<li><?php 
				$arr = explode('/', getcwd()); 
				$current = $arr[count($arr) - 2]; 
				echo $current;
				?>
				<input name="paths[]" value="../" type="checkbox"></li></li>
			<?php 
			foreach (scandir('..') as $key => $file) {
				if (is_dir('../' . $file) && $file != '.' && $file != '..' && $file != 'DarkHorse') {
					echo '<li>' . $file . '<input name=paths[] value="../' . $file . '/" type="checkbox"></li>';
				}
			} ?>
		</ul>
		<label>Put regular expression:</label>
		<textarea name="regexp"></textarea>
		<label>Choose action:</label>
		<ul>
			<li>Remove file where we find matches<input id="a" type="radio" name="action" value="a"></li>
			<li>Swap found matches with custom value<input id="b" type="radio" name="action" value="b"></li>
			<div id="custom" style="display: none">
				<span>Custom value:</span>
				<input name="custom" type="text">
			</div>
			<li>Show list of files with found matches<input id="c" type="radio" name="action" value="c"></li>

		</ul>
		<label>Choose extension:</label>
		<input id="extension" type="text" name="extension">
		<input type="submit" id="submit" value="Start">
	</form>
</body>
<script type="text/javascript">
	function checkElem() {
		if (b.checked){
			custom.setAttribute('style', '');
		} else {
			custom.setAttribute('style', 'display: none');
		}
	}
	a.onchange = checkElem;
	b.onchange = checkElem;
	c.onchange = checkElem;
</script>
</html>