<?php
require_once 'classes/others/Settings.php';
require_once 'classes/others/Template.php';

?>

<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<title>Практика</title>
	<? foreach ( Settings::$cssMainTemplate as $style ): ?>
		<link href="<?= $style ?>" rel="stylesheet" type="text/css" />
	<?php endforeach; ?>
	<? foreach ( Settings::$jsMainTemplateBefore as $js ): ?>
		<script src="<?= $js ?>"></script>
	<?php endforeach; ?>
</head>
<body>
<div class="container clearfix">
	<div class="title_nav clearfix">
		<span onclick="nation.getNation()" style="line-height: 30px">Государства</span>
		<div class="buttons">
			<input id="search" placeholder="Введите поисковый запрос" type="text" class="text_box_search">
			<a href="#" onclick="nation.add();" class="button_flat ">Добавить Государство</a>
		</div>

	</div>
	<div id="nation_container">

	</div>
<!--	<iframe src="https://ru.wikipedia.org/wiki/Польша" width="900" height="1000" align="left">-->
<!--		Ваш браузер не поддерживает плавающие фреймы!-->
<!--	</iframe>-->

</div>
</body>
</html>