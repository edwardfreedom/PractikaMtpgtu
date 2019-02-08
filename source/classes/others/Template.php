<?php

/**
 * Created by PhpStorm.
 * User: Anatoliy
 * Date: 02.04.2016
 * Time: 17:20
 */
class Template {

	public static function renderFilterVk( $selectItem ) {
		?>
		<div class="inner-toolbar clearfix">
			<ul>
				<li class="left">
					<ul class="nav nav-pills nav-pills-primary">
						<li>
							<label>Фильтр: </label>
						</li>
						<? foreach ( Settings::filterMenuVkTasks( $selectItem ) as $link => $value ): ?>
							<? if ( $value["isActive"] ): ?>
							<script>
								<?= $value["onClick"]; ?>
							</script>
						<? endif; ?>
							<li class="<?= $value["isActive"] == true ? "active" : "no-active"; ?>">
								<a href="<?= $value["href"]; ?>"><?= $value["title"]; ?></a>
							</li>
						<? endforeach; ?>
					</ul>
				</li>
			</ul>
		</div>
		<?
	}


	public static function renderNavMain( $selectMenuItemLevel1, $selectMenuItemLevel2 ) {
		if ( empty( $selectMenuItemLevel1 ) ) {
			$selectMenuItemLevel1 = 'tasks';
		}
		if ( empty( $selectMenuItemLevel2 ) ) {
			$selectMenuItemLevel2 = 'vk';
		}
		?>
		<ul class="nav nav-main">
			<? //print_r(Settings::leftSideMenuLinksTemplate( $selectMenuItemLevel1, $selectMenuItemLevel2 )) ?>
			<? foreach ( Settings::leftSideMenuLinksTemplate( $selectMenuItemLevel1, $selectMenuItemLevel2 ) as $link => $value ): ?>
				<? if ( $value['links'] == null && $value['isActive'] ): ?>
					<li class="nav-active">
				<? elseif ( $value['links'] == null ): ?>
					<li>
				<? elseif ( $value['isActive'] == true ) : ?>
					<li class="nav-parent nav-expanded nav-active">
				<? else : ?>
					<li class="nav-parent">
				<? endif; ?>

				<? if ( $value['links'] == null ): ?>
				<a href="<?= $value['link']; ?>">
				<? else : ?>
				<a>
			<? endif; ?>


				<i class="fa <?= $value['icon']; ?>" aria-hidden="true"></i>
				<span><?= $value['title']; ?></span>
				</a>


				<? if ( $value['links'] != null ): ?>
					<ul class="nav nav-children">
						<? foreach ( $value['links'] as $liValue ): ?>
							<? if ( $liValue['isActive'] == true ): ?>
								<li class="nav-active">
							<? else : ?>
								<li>
							<? endif; ?>

							<a href="<?= $liValue['link']; ?>">
								<?= $liValue['title']; ?>
							</a>
							</li>
						<? endforeach; ?>
					</ul>
				<? endif; ?>

				</li>
			<? endforeach; ?>
		</ul>
		<?
	}

	public static function renderTasksVk( $selectFilter ) {
		$tasks = Functions::api( 'vk.getGroupJobs' );
		//print_r($tasks);
		$tasks = json_decode( $tasks, true );


		?>

		<!--		<div id="task15413538" class="panel col-md-6 row-con-task  animated  bounceInLeft">-->
		<!--			<div class="panel-body pr"><img class="logo-task-vk"-->
		<!--			                                src="http://cs631316.vk.me/v631316239/bb25/cv_yjRD4K3U.jpg">-->
		<!---->
		<!--				<div class="task-info">-->
		<!--					<div class="o-x-h-task-url"><a class="task-url" target="_blank"-->
		<!--					                               onclick="vkGroup.showGroupVk({ id:&quot;2&quot;, url:&quot;15413538&quot;, group_id:&quot;15413538&quot;, nameGroup: &quot;Dota 2&quot; , ball:&quot;3&quot; ,logo:&quot;http://cs631316.vk.me/v631316239/bb25/cv_yjRD4K3U.jpg&quot;})">Dota-->
		<!--							2</a></div>-->
		<!--					<div class="info">-->
		<!--						<ul class="mini-info-task p-0">-->
		<!--							<li><strong class="amount">63 из 133</strong> выполненно</li>-->
		<!--							<li><span class="text-number-balls">+3 балла</span></li>-->
		<!--						</ul>-->
		<!--					</div>-->
		<!--				</div>-->
		<!--				<a href="#" onclick="vkGroup.hideTask('task15413538')" class="fa fa-close task-hide"></a></div>-->
		<!--		</div>-->

		<?


	}

	public static function renderNavNation($value) {
		?>
		<div class="nav_nation clearfix">
			<img class="logo" src="<?= $value["Logo"]; ?>">
			<ul class="info_nation">
				<li class="name_nation">Государство: <?= $value["Nation"]; ?></li>
				<li class="name_nation">Столица: <?= $value["Capital"]; ?></li>
				<li class="name_nation">Площадь: <?= $value["theArea"]; ?> км³</li>
				<li class="name_nation">Гос. язык: <?= $value["Language"]; ?></li>
				<li class="name_nation">Жителей: <?= $value["residentsCount"]; ?></li>
				<li class="name_nation">Валюта: <?= $value["Money"]; ?></li>
				<li class="name_nation">Президент: Порошенко, Пётр Алексеевич</li>
			</ul>
			<ul class="info_nation">
				<li class="name_nation">Президент: Порошенко, Пётр Алексеевич</li>
			</ul>
			<div class="buttons">
				<a href="#" class="button_flat">Редактировать</a>
				<a href="#" class="button_flat">Удалить</a>
			</div>
		</div>
		<?
	}


}

