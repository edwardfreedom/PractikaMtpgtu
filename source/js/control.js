/**
 * Created by Anatoliy on 24.03.2016.
 */


$(document).ready(function () {
	$nation_container = $('#nation_container');
	nation.getNation();


	$("#search").keyup(function (event) {

		if (event.keyCode == 13) {
			nation.search($("#search").val())
		}
	});

});


var stack_topleft = {"dir1": "down", "dir2": "right", "push": "top"};
var stack_bottomleft = {"dir1": "right", "dir2": "up", "push": "top"};
var stack_bottomright = {"dir1": "up", "dir2": "left", "firstpos1": 15, "firstpos2": 15};
var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
var stack_bar_bottom = {"dir1": "up", "dir2": "right", "spacing1": 0, "spacing2": 0};
function checkValidLogo(_this) {
	var $logo = $(_this).val();
	var re = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/;
	var $element = $('#noValidLogo');
	if (!re.test($logo)) {
		$element.css({'display': 'block'})
	}
	else {
		$element.css({'display': 'none'})
	}
}
var nation = {
	update             : function () {
		$nation_container.empty();
		nation.getNation();
	},
	render             : function (values) {
		return [
			' <div id="nation{{id}}" class="nav_nation clearfix">',
			'  <img class="logo" src="{{logo}}">',
			'  <ul class="info_nation">',
			'   <li onclick="nation.infoNation(\'{{nation}}\')" class="name_nation a_info">Государство: {{nation}}</li>',
			'   <li class="name_nation">Столица: {{capital}}</li>',
			'   <li class="name_nation">Площадь: {{theArea}} км³</li>',
			'   <li class="name_nation">Гос. язык: {{language}}</li>',
			'   <li class="name_nation">Жителей: {{residentsCount}} чел.</li>',
			'   <li class="name_nation">Валюта: {{money}}</li>',
			'		<li onclick="nation.infoPresident(\'{{president}}\')" class="name_nation a_info">Президент: {{president}}</li>',
			'  </ul>',
			'  <div class="buttons">',
			'   <a href="#" onclick="nation.edit({{id}})" class="button_flat">Редактировать</a>',
			'   <a href="#" onclick="nation.delete({{id}})" class="button_flat">Удалить</a>',
			'  </div>',
			' </div>'
		]
				.join('')
				.replace(/\{\{id\}\}/g, values.id)
				.replace(/\{\{logo\}\}/g, values.logo)
				.replace(/\{\{nation\}\}/g, values.name)
				.replace(/\{\{capital\}\}/g, values.capital)
				.replace(/\{\{theArea\}\}/g, values.theArea)
				.replace(/\{\{language\}\}/g, values.languageName)
				.replace(/\{\{residentsCount\}\}/g, values.residentsCount)
				.replace(/\{\{president\}\}/g, values.president)
				.replace(/\{\{money\}\}/g, values.money);
	},
	getNation          : function () {
		$nation_container.empty();
		$.post("api/nation.getNations.php", function (data) {
			var json = JSON.parse(data);
			var nations = json.response.items;

			for (var _nation in nations) {
				//alert(nations[_nation].name);
				$nation_container.append(nation.render(nations[_nation]));
			}
		});
	},
	delete             : function (id) {
		$.ajax({
			type: 'POST',
			url : 'api/nation.deleteNationById.php?id=' + id,

			success: function (data) {
			}
		});
		$("#nation" + id).remove();
	},

	edit               : function (id) {
		nation.renderEdit(id);
	},
	renderEdit         : function (id) {
		vex.defaultOptions.className = 'vex-theme-os';
		$.post("api/nation.getNationById.php?id=" + id, function (data) {

			var json = JSON.parse(data);
			var _nation = json.response.item;
            console.log(data);
			vex.dialog.open({
				message : [
					'<div id="nation{{id}}" class="nav_nation clearfix">',
					'   <table>',
					'    <tr>',
					'     <td>Флаг:</td>',
					'     <td class="text_block"><input onkeyup="checkValidLogo(this);" type="text" class="text_width100 textbox_value" id="logo" value="{{logo}}"></td>',
					'    </tr>',
					'			<tr >',
					'			<td></td>',
					'     <td style="display: none;" id="noValidLogo" class="valid_logo">Ссылка на логотип гос-ва не валидная!</td>',
					'    </tr>',
					'    <tr>',
					'     <td>Государство:</td>',
					'     <td class="text_block"><input type="text" class="text_width100 textbox_value" id="nation" value="{{nation}}"></td>',
					'    </tr>',
					'    <tr>',
					'     <td>Столица:</td>',
					'     <td class="text_block"><input type="text" class="text_width100 textbox_value" id="capital" value="{{capital}}"></td>',
					'    </tr>',
					'    <tr>',
					'     <td>Площадь:</td>',
					'     <td class="text_block"><input type="text" class="text_width100 textbox_value" id="theArea" value="{{theArea}}"></td>',
					'    </tr>',
					'    <tr>',
					'     <td>Гос. язык:</td>',
					'     <td class="text_block"><input type="text" class="text_width100 textbox_value" id="language" value="{{language}}"></td>',
					'    </tr>',
					'    <tr>',
					'     <td>Жителей:</td>',
					'     <td class="text_block"><input type="text" class="text_width100 textbox_value" id="residentsCount" value="{{residentsCount}}"></td>',
					'    </tr>',
					'    <tr>',
					'     <td>Валюта:</td>',
					'     <td class="text_block"><input type="text" class="text_width100 textbox_value" id="money" value="{{money}}"></td>',
					'    </tr>',
					'    <tr>',
					'     <td>Президент:</td>',
					'     <td class="text_block"><input type="text" class="text_width100 textbox_value" id="president" value="{{president}}"></td>',
					'    </tr>',
					'   </table>',
					'  </div>'

				]
						.join('')
						.replace(/\{\{id\}\}/g, _nation.id)
						.replace(/\{\{logo\}\}/g, _nation.logo)
						.replace(/\{\{nation\}\}/g, _nation.name)
						.replace(/\{\{capital\}\}/g, _nation.capital)
						.replace(/\{\{theArea\}\}/g, _nation.theArea)
						.replace(/\{\{language\}\}/g, _nation.idLanguage)
						.replace(/\{\{residentsCount\}\}/g, _nation.residentsCount)
						.replace(/\{\{president\}\}/g, _nation.president)
						.replace(/\{\{money\}\}/g, _nation.idMonetaryUnit),
				buttons : [
					$.extend({}, vex.dialog.buttons.NO, {
						text: 'Отмена'
					}), $.extend({}, vex.dialog.buttons.YES, {
						text: 'Редактировать'
					})
				],

				callback: function (value) {
					//alert(value);
					if (value) {
						//alert(id);
						var form = {};
						form["id"] = id;
						form["logo"] = $('#logo').val();
						form["nation"] = $('#nation').val();
						form["capital"] = $('#capital').val();
						form["theArea"] = $('#theArea').val();
						form["language"] = $('#language').val();
						form["residentsCount"] = $('#residentsCount').val();
						form["president"] = $('#president').val();
						form["money"] = $('#money').val();
							console.log(JSON.stringify(form));

						$.ajax({

                            type    : 'POST',
                            dataType: "json",
                            url     : 'api/nation.editNationById.php',
                            data    : 'config=' + JSON.stringify(form),

							// url : 'api/nation.editNationById.php?config=' + JSON.stringify(form),

							complete: function (data) {
								nation.update();
							}
						});
					}
					return console.log(value ? 'Successfully destroyed the planet.' : 'Chicken.');
				}
			});

		});


	},
	add                : function () {
		nation.renderAdd();
	},
	renderAdd          : function () {
		vex.defaultOptions.className = 'vex-theme-os';

		vex.dialog.open({
			message : [
				'<div id="nation{{id}}" class="nav_nation clearfix">',
				'   <table>',
				'    <tr>',
				'     <td>Флаг:</td>',
				'     <td class="text_block"><input onkeyup="checkValidLogo(this);"  type="text" class="text_width100" id="logo" ></td>',
				'    </tr>',
				'			<tr >',
				'			<td></td>',
				'     <td style="display: none;" id="noValidLogo" class="valid_logo">Ссылка на логотип гос-ва не валидная!</td>',
				'    </tr>',
				'    <tr>',
				'     <td>Государство:</td>',
				'     <td class="text_block"><input type="text" class="text_width100 textbox_value" id="nation" ></td>',
				'    </tr>',
				'    <tr>',
				'     <td>Столица:</td>',
				'     <td class="text_block"><input type="text" class="text_width100 textbox_value" id="capital"></td>',
				'    </tr>',
				'    <tr>',
				'     <td>Площадь:</td>',
				'     <td class="text_block"><input type="text" class="text_width100 textbox_value" id="theArea" ></td>',
				'    </tr>',
				'    <tr>',
				'     <td>Гос. язык:</td>',
				'     <td class="text_block"><input type="text" class="text_width100 textbox_value" id="language" ></td>',
				'    </tr>',
				'    <tr>',
				'     <td>Жителей:</td>',
				'     <td class="text_block"><input type="text" class="text_width100 textbox_value" id="residentsCount"></td>',
				'    </tr>',
				'    <tr>',
				'     <td>Валюта:</td>',
				'     <td class="text_block"><input type="text" class="text_width100 textbox_value" id="money"></td>',
				'    </tr>',
				'    <tr>',
				'     <td>Президент:</td>',
				'     <td class="text_block"><input type="text" class="text_width100 textbox_value" id="president"></td>',
				'    </tr>',
				'   </table>',
				'  </div>'

			]
					.join(''),
			buttons : [
				$.extend({}, vex.dialog.buttons.NO, {
					text: 'Отмена'
				}), $.extend({}, vex.dialog.buttons.YES, {
					text: 'Добавить'
				})
			],
			callback: function (value) {
				if (value) {
					var form = {};
					//form["id"] = id;
					form["logo"] = $('#logo').val();
					form["nation"] = $('#nation').val();
					form["capital"] = $('#capital').val();
					form["theArea"] = $('#theArea').val();
					form["language"] = $('#language').val();
					form["residentsCount"] = $('#residentsCount').val();
					form["president"] = $('#president').val();
					form["money"] = $('#money').val();
					$.ajax({
						type   : 'POST',
						url    : 'api/nation.addNation.php?config=' + JSON.stringify(form),
						success: function (data) {
							nation.update();
						}
					});
				}


				return console.log(value ? 'Successfully destroyed the planet.' : 'Chicken.');
			}
		});


		//$.post("http://vkpowered.ru/practika2016/api/nation.addNation.php?config=" + "", function (data) {
		//
		//
		//});

	},
	infoPresident      : function (name) {
		nation.renderInfoPresident(name);
	},
	renderInfoPresident: function (name) {
		vex.defaultOptions.className = 'vex-theme-os';
		vex.dialog.open({
			message : [
				' <iframe src="https://ru.m.wikipedia.org/wiki/{{namePresident}}" width="100%" height="500">',
				'  Ваш браузер не поддерживает плавающие фреймы!',
				' </iframe>',
			]
					.join('')
					.replace(/\{\{namePresident\}\}/g, name),
			buttons : [
				$.extend({}, vex.dialog.buttons.NO, {
					text: 'Отмена'
				}), $.extend({}, vex.dialog.buttons.YES, {
					text: 'Почитано'
				})
			],
			callback: function (value) {
				return console.log(value ? 'Successfully destroyed the planet.' : 'Chicken.');
			}
		});
	},
	infoNation         : function (name) {
		nation.renderInfoNation(name);
	},
	renderInfoNation   : function (name) {
		vex.defaultOptions.className = 'vex-theme-os';

		vex.dialog.open({
			message : [
				' <iframe src="https://ru.m.wikipedia.org/wiki/{{nameNation}}" width="100%" height="500">',
				'  Ваш браузер не поддерживает плавающие фреймы!',
				' </iframe>',

			]
					.join('')
					.replace(/\{\{nameNation\}\}/g, name),
			buttons : [
				$.extend({}, vex.dialog.buttons.NO, {
					text: 'Отмена'
				}), $.extend({}, vex.dialog.buttons.YES, {
					text: 'Прочитано'
				})
			],
			callback: function (value) {


				return console.log(value ? 'Successfully destroyed the planet.' : 'Chicken.');
			}
		});
	},
	search             : function (name) {
		$nation_container.empty();
		$.post("api/nation.searchNation.php?name=" + name, function (data) {
			var json = JSON.parse(data);
			var nations = json.response.items;

			for (var _nation in nations) {
				//alert(nations[_nation].name);
				$nation_container.append(nation.render(nations[_nation]));
			}
		});
	}
};

