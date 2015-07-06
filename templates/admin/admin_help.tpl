{capture name="content_name"}
	Помощь
{/capture}

{capture name="content"}
	<div style="font-size: 14px; width:800px; padding:0 30px;">
<div class="help">
    <ol>
		<li><a class="help" href=#table>Работа с таблицами</a></li>
	</ol>
			<h3 class="help_h3"><a href=#add_t>  Добавление таблицы на сайт</a></h3>
			<h3 class="help_h3"> <a href=#border>Создание бордюра таблицы</a></h3>
			<h3 class="help_h3">  <a href=#cap_table> Создание шапки таблицы</a></h3>
			<h3 class="help_h3">  <a href=#table_edit> Редактирование таблицы</a></h3>
			<ul style="margin: 0 0 0 55px;">
				<li style="list-style-type: disc;font-size: 14px;font-weight: 100;"><a href="#edit_row">Изменение параметров строки таблицы</a></li>
				<li style="list-style-type: disc;font-size: 14px;font-weight: 100;"><a href="#edit_cell">Изменение параметров ячейки таблицы</a></li>
				<li style="list-style-type: disc;font-size: 14px;font-weight: 100;"><a href="#insert_in_table">Добавление и удаление строк и столбцов таблицы</a></li>
				<li style="list-style-type: disc;font-size: 14px;font-weight: 100;"><a href="#union">Объединение и разбиение ячеек</a></li>
			</ul>
		
	<ol>
		<li value="2"><a class="help" href=#image>Работа с картинками</a></li>
	</ol>
			 <h3 class="help_h3"><a href=#add_img>  Всплывающая картинка</a></h3>
			 <h3 class="help_h3"><a href=#add_img_site> Добавление картинки на сайт</a></h3>
			 <h3 class="help_h3"><a href=#border_img> Создание бордюра для картинки</a></h3>
    <ol>
		<li value="3"><a class="help" href=#text>Работа с текстом</a></li>
			
	</ol>
	<h3 class="help_h3"><a href=#text1>  Сделать текст жирным</a></h3>
	<h3 class="help_h3"><a href=#text2>  При копировании текста появляется фон или стиль текста искажен</a></h3>
	<h3 class="help_h3"><a href=#text3>  Копирование текста из Word</a></h3>
	<h3 class="help_h3"><a href=#text4>  Изменение цвета текста</a></h3>
	<h3 class="help_h3"><a href=#text5>  Параграфы как средство редактирования текста</a></h3>
	
	 <ol>
		<li value="4"><a class="help" href=#content_text>Контентные страницы</a></li>
	</ol>
	<h3 class="help_h3"><a href=#content_why>Для чего нужны контентные страницы?</a></h3>
	<h3 class="help_h3"><a href=#content_add>Создание контентной страницы</a></h3>
	<h3 class="help_h3"><a href=#content_use>Использование контентной страницы на сайте</a></h3>
	<ol>
		<li value="5"><a class="help" href=#hiper>Создание ссылок</a></li>
	</ol>
	<h3 class="help_h3"><a href=#create_hiper>Создание гиперссылок</a></h3>
	<h3 class="help_h3"><a href=#create_download>Создание ссылок на другие сайты</a></h3>
	<ol>
		<li value="6"><a class="help" href=#list>Создание списка</a></li>
	</ol>
	<h3 class="help_h3"><a href=#list_numb>Нумерованный список</a></h3>
	<h3 class="help_h3"><a href=#list_no_numb>Ненумерованный список</a></h3>
	<ol>
		<li value="7"><a class="help" href=#video>Добавление видео на сайт</a></li>
	</ol>
</div>

<h2 class="help_h2" id="table"> Работа с таблицами</h2>
        <p id="add_t" class="help_b">Добавление таблицы</p>
			<p id="add">Для добавления таблицы на страницу сайта необходимо в окне редактирования текста нажать кнопку <b>Inserts a new table</b> на панели инструментов</p>
			<a href="/img/admin/help/1.jpg"><img src="/img/admin/help/1.jpg" class="photohelp"/></a>
			<p>После нажатия появится следующее окно:</p>
			<a href="/img/admin/help/2.jpg"><img src="/img/admin/help/2.jpg" class="photohelp"/></a>
			<p>Здесь необходимо отметить кол-во <b>столбцов (columns)</b> и <b>строк (rows)</b> и нажать <b>Insert</b></p><br />
        <p id="border" class="help_b">Создание бордюра таблицы</p>
			<p> При добавлении таблицы появляется окно, где необходимо указать количество строк и столбцов создаваемой таблицы. В этом же окне можно задавать и бордюр.Для этого нужно выбрать для Class из выпадающего списка значение <b>value</b>.</p>
			<a href="/img/admin/help/5.jpg"><img src="/img/admin/help/5.jpg" class="photohelp"/></a>
			<p>После этого в теперь уже пустое окошко <b>Class</b> ввести значение <b>border</b> маленькими буквами! </p><a href="/img/admin/help/6.jpg"><img src="/img/admin/help/6.jpg" class="photohelp"/></a>
			<p>Если Вы уже вставили таблицу, не указав для нее класс, тогда необходмо кликнуть левой кнопкой мыши в область редактируемой таблицы, и нажать на кнопку <b>Insert a new table</b> на панели инструментов. Расположение этой кнопки показано на рисунке ниже</p>
			<a href="/img/admin/help/ris22.jpg"><img src="/img/admin/help/ris22.jpg" class="photohelp"/></a>
			<p>После этого появится диалоговое окно, показанное на рисунке ниже. В этом окне Вы должны указать класс вашей таблицы, как описано в этом же пункте выше</p>
				<a href="/img/admin/help/ris23.jpg"><img src="/img/admin/help/ris23.jpg" class="photohelp"/></a>
		<p id="cap_table" class="help_b">Создание шапки таблицы</p>
			<p >Для того чтобы сделать в таблице шапку, необходимо мышкой выделить необходимые столбцы, и кликнуть правой клавишей мыши по выделенной части таблицы, выбрать подменю <b>Cell/Table cell properties</b></p>
			<a href="/img/admin/help/3.jpg"><img src="/img/admin/help/3.jpg" class="photohelp"/></a>
			<p>После нажатия появится следующее окно:</p>
			<a href="/img/admin/help/4.jpg"><img src="/img/admin/help/4.jpg" class="photohelp"/></a>
			<p>Здесь необходимо выбрать в <b>Cell type</b> значение <b>Header</b> и нажать <b>Update</b></p><br />
		<p id="table_edit" class="help_b">Редактирование таблицы</p>
			<p id="edit_row" class="help_b">Изменение параметров строки таблицы</p>
				<p>
					Чтобы изменить параметры строки, необходимо установить курсор в одну из ячеек этой строки таблицы. И затем нажать кнопку <b>Table row properties</b>. После нажатия появится всплывающее окно, где указаны основные редактируемые пераметры. Кстати, возможно изменение не только параметров данной строки, но и остальных строк. Об этом речь пойдет в этом же разделе, но позже.<br/>
				<a href="/img/admin/help/ris35.png"><img src="/img/admin/help/ris35.png" class="photohelp"/></a><br/><br />
				Параметр <b>Row in table part</b> изменять никогда не надо.<br/><br/>
				Параметр <b>Alignment</b> - параметр для указания выравнивания текста по горизонтали. <br/>
				<b>Left</b> - выравнивание по левому краю<br/>
				<b>Center</b> - выравнивание по центру<br/>
				<b>Right</b> - выравнивание по правому краю<br/><br/>
				Параметр <b>Vertical alignment</b> - параметр для указания выравнивания текста по вертикали. Принимает все те же значения, что и параметр выравнивания по горизонтали. <br/><br />
				Параметр <b>Class</b> не надо изменять. <br/><br/>
				Параметр <b>Height</b> для указания высоты строки таблицы. Указывается в писелях. <b>Кроме цифры в этом поле ничего указывать не надо!</b> <br/><br/>
				
				Выше кнопки <b>Update</b> есть раскрывающийся список. Расположение этого списка показано на рисунке ниже.<br/>
				<a href="/img/admin/help/ris36.png"><img src="/img/admin/help/ris36.png" class="photohelp"/></a><br/>
				В нем Вы можете указать, к каким строкам таблицы применить параметры. По умолчанию в этом списке выбран параметр <b>Update current row</b>, что значит применить к текущей строке. Пояснения к остальным вариантам:<br/>
				<b>Update odd rows in table</b> - применить ко всем нечетным строкам таблицы.<br/>
				<b>Update even rows in table</b> - применить ко всем четным строкам таблицы.<br/>
				<b>Update all rows in table</b> - применить ко всем строкам таблицы.<br/><br/>
				Далее для сохранения всех внесенных изменений, нужно нажать кнопку <b>Update</b>.<br/>
				</p>
				
			<p id="edit_cell" class="help_b">Изменение параметров ячейки таблицы</p>
				<p>
					Чтобы изменить параметры ячейки, необхомо установить курсор в ячейку редактируемой таблицы. И затем нажать кнопку <b>Table cell properties</b>. После нажатия появится всплывающее окно, где указаны основные редактируемые пераметры ячейки. Кстати, возможно изменение не только параметров данной ячейки, но и остальных ячеек. Об этом речь пойдет в этом же разделе, но позже.<br/>
					<a href="/img/admin/help/ris37.png"><img src="/img/admin/help/ris37.png" class="photohelp"/></a><br/>
					Параметр <b>Alignment</b> - выравнивание текста в ячейке по горизонтали.<br/>
					Принимает следующие значения:<br/>
					<b>Left</b> - выравнивание по левому краю.<br/>
					<b>Center</b> - выравнивание по центру.<br/>
					<b>Right</b> - выравнивание по правому краю.<br/><br/>
					Параметр <b>Cell type</b> служит для указания типа ячеек. Это могут все ячейки (выбрано значение <b>Data</b>)и шапка таблицы (выбрано значение <b>Header</b>).<br/><br/>
					Параметр <b>Vertical alignment</b> - выравнивание текста в ячейке по вертикали. Все принимаемые значения такие же, как и для выравнивания по горизонтали.<br/><br/>
					<b>Scope</b> - не требует изменения.<br/><br/>
					<b>Width</b> - ширина ячейки, указывается в пискелях. <b>Кроме цифры ничего писать в данной ячейке не нужно.</b><br/><br/>
					<b>Height</b> - высота ячейки, указывается в пискелях. <b>Кроме цифры ничего писать в данной ячейке не нужно.</b><br/><br/>
					<b>Class</b> - ничего не нужно изменять и указывать.<br/><br/>
					Далее над кнопкой <b>Update</b> расположен раскрывающийся список, в котором нужно указать, для каких ячеек необходимо применить эти параметры. Пример показан на рисунке ниже<br/>
					<a href="/img/admin/help/ris38.png"><img src="/img/admin/help/ris38.png" class="photohelp"/></a><br/>
					В этом списке есть следующие значения:<br/>
					<b>Update current cell</b> - применить параметры для текущей ячейки, это значение выбрано по умолчанию.<br/>
					<b>Update all cell in row</b> - применить параметры для всех ячеек строки, в которой стоит курсор.<br/>
					<b>Update all cell in table</b> - применить параметры для всех ячеек таблицы.<br/><br/>
					Далее для сохранения всех внесенных изменений, нужно нажать на кнопку <b>Update</b>.<br/>
				</p>
			<p id="insert_in_table" class="help_b">Добавление и удаление строк и столбцов таблицы</p>
				<p>На панели инструментов есть также кнопки для добавления и удаления столбцов и строк таблицы. На рисунке ниже показано расположение этих кнопок. Они обведены красной линией.<br/>
					<a href="/img/admin/help/ris39.png"><img src="/img/admin/help/ris39.png" class="photohelp"/></a><br/>
					Кнопка слева <b>Insert row before</b><a href="/img/admin/help/ris40.png"><img src="/img/admin/help/ris40.png" /></a> - добавление строки выше той, в которой установлен курсор.<br/>
					Кнопка <b>Insert row after</b><a href="/img/admin/help/ris41.png"><img src="/img/admin/help/ris41.png" /></a> - добавление строки ниже той, в которой установлен курсор.<br/>
					Кнопка <b>Delete row</b><a href="/img/admin/help/ris42.png"><img src="/img/admin/help/ris42.png" /></a> - удаление строки, в которой установлен курсор.<br/>
					Кнопка <b>Insert column before</b><a href="/img/admin/help/ris43.png"><img src="/img/admin/help/ris43.png" /></a> - добавление столбца перед тем, в котором установлен курсор.<br/>
					Кнопка <b>Insert column after</b><a href="/img/admin/help/ris44.png"><img src="/img/admin/help/ris44.png" /></a> - добавление столбца после того, в котором установлен курсор.<br/>
					Кнопка <b>Remove column</b><a href="/img/admin/help/ris45.png"><img src="/img/admin/help/ris45.png" /></a> - удаление столбца, в котором установлен курсор.<br/>
				</p>
			<p id="union" class="help_b">Объединение и разбиение ячеек</p>
				<p>
					Возможно объединение ячеек в строке или в столбце. Для этого служит одна кнопка на панели инструментов <b>Merge table cells</b>. Ее расположение показано на рисунке ниже<br/><br/>
					<a href="/img/admin/help/ris46.png"><img src="/img/admin/help/ris46.png" /></a>	
					<br/><br/>
					
				</p>
				<p>Разбиение ячеек возможно только в том случае, если к этой ячейки ранее была применена операция объединения. Другими словами, если ранее ячейки были объединены и понадобилось вернуть их прежний вид, то для этого и служит кнопка разбиения <b>Split mergened table cells</b> Чтобы разбить ячейку, нужно выделить ее и нажать на кнопку <b>Split mergened table cells</b> на панели инструментов.</p>Ее расположение показано на рисунке ниже<br/><br/>
			<a href="/img/admin/help/ris47.png"><img src="/img/admin/help/ris47.png" /></a>
			
			
			
			
			
	<h2 class="help_h2" id="image"> Работа с картинками</h2>
		<p id="add_img_site" class="help_b">Добавление картинки на сайт</p>
			<p>Чтобы вставить картинку на текстовую страницу, необходимо в панели инструментов редактирования текста нажать кнопку <b>Insert/edit Image</b> <img src="/img/admin/help/ris2.jpg"/></p>
			<a href="/img/admin/help/ris1.jpg"><img src="/img/admin/help/ris1.jpg" class="photohelp" /></a>
			<p>После нажатия на кнопку появится окно:</p><a href="/img/admin/help/ris4.jpg"><img src="/img/admin/help/ris4.jpg" class="photohelp" /></a>
			<p>Далее нужно нажать на кнопку<img style="padding:0 5px 0 5px;" src="/img/admin/help/ris3.jpg" class="photohelp" /><b>Browse</b></p>
			<p>После нажатия появится диалоговое окно, где нужно ввести <b>логин</b> и <b>пароль</b></p>
			<p>Логин <b>admin</b> и Пароль <b>cbm</b></p>
				<a href="/img/admin/help/ris5.jpg"><img src="/img/admin/help/ris5.jpg" class="photohelp" /></a>
			<p>После ввода имени и пароля вы увидите окно, показанное ниже:</p>
			<a href="/img/admin/help/ris6.jpg"><img style="width:650px;" src="/img/admin/help/ris6.jpg" class="photohelp" /></a>
			<p>Все заливаемые на сайт картинки можно упорядочить по папкам, как показано на рисунке выше. Таким образом, все картинки будут упорядочены. Создать свою папку для картинок вы можете нажав на кнопку New Folder на панели инструментов</p>
			<p>После нажатия появится диалоговое окно, показанное на рисунке:</p>
			<a href="/img/admin/help/ris7.jpg"><img src="/img/admin/help/ris7.jpg" class="photohelp" /></a>
			<p>Здесь необходимо указать название папки в строке Folder Title и нажать на кнопку <b>Create Folder</b></p>
			<p>В нашем случае мы указали название contacts. Результат действия показан на рисунке ниже:</p>
			<a href="/img/admin/help/ris8.jpg"><img style="width:650px;" src="/img/admin/help/ris8.jpg" class="photohelp" /></a>
			<p>Теперь приступим к самой загрузке картинки на сайт. Для этого нужно открыть папку. Достаточно просто нажать на сам значок папки левой кнопкой мыши. На экране появится следующее изображение:</p>
			<a href="/img/admin/help/ris9.jpg"><img style="width:650px;" src="/img/admin/help/ris9.jpg" class="photohelp" /></a>
			<p>Для добавления картинки нужно нажать на кнопку Upload на панели инструментов. После нажатия появится окно:</p>
			<a href="/img/admin/help/ris10.jpg"><img src="/img/admin/help/ris10.jpg" class="photohelp" /></a>
			<p>В появившемся окне Вам нужно выбрать подгружаемые картинки. Для этого нужно нажать на кнопку <b>Обзор...</b> и выбрать картинку, хранящуюся на Вашем компьютере и нажать на кнопку Upload. Если необходимо добавить несколько картинок, нужно нажать на кнопку <img style="padding:3px 5px 0 5px;" src="/img/admin/help/ris11.jpg" class="photohelp" />, показанную на рисунке выше. После этого появится еще одна строка для добавления файла. Результат действия показан на рисунке ниже:</p>
			<a href="/img/admin/help/ris12.jpg"><img src="/img/admin/help/ris12.jpg" class="photohelp" /></a>
			<p>Напротив каждой подгружаемой картинки нужно нажать кнопку <b>Upload</b> для подтверждения. </p>
			<p>Когда все необходимые картинки подгружены, нужно нажать на кнопку <b>Close</b>, чтобы закрыть окно, показанное на рисунке выше.</p>
			<p>Для удаления картинки необходимо поставить галочку в поле, где указано ее название.</p>
			<p>Для перехода в основную иерархию (на шаг назад), нужно нажать кнопку <b>Items per page.</b></p>
			<p>Для добавления картинки на сайт нужно отметить картинку, поставив под ней галочку и нажать на кнопку <b>Select</b> , расположенную с левой стороны во вкладке <b>File Information</b>:</p>
			<a href="/img/admin/help/ris13.jpg"><img style="width:650px;" src="/img/admin/help/ris13.jpg" class="photohelp" /></a>
			<p>После нажатия появится диалоговое окно, показанное на рисунке:</p>
			<a href="/img/admin/help/ris14.jpg"><img src="/img/admin/help/ris14.jpg" class="photohelp" /></a>
			<p>Как показано на рисунке выше, в строке Image URL указан адрес расположения картинки на сайте. <b>Его нельзя менять!</b> Под этой строкой следуют еще два необязательных поля для заполнения (Image description, Title). В них вы можете указать название картинки, например "Закат у моря". После этого нужно подтвердить добавление картинки нажатием на кнопку <b>Insert</b>. Появится окно, показанное на рисунке:</p>
			<a href="/img/admin/help/ris15.jpg"><img src="/img/admin/help/ris15.jpg" class="photohelp" /></a>
			<p>В этом окне требуется подтверждение Ваших действий. Нажмите на кнопку <b>Ok</b>, и картинка появится в окне редактирования. Результат действий показан на рисунке:</p>
			<a href="/img/admin/help/ris16.jpg"><img src="/img/admin/help/ris16.jpg" class="photohelp" /></a>
			<p>Если картинка в окне редактирования картинка занимает много места и вносит неудобства для редактирования текста, можно уменьшить ее размер с помощью инструмента Resize. Для этого нужно просто выделить ее, кликнув по ней левой кнопкой мыши и потянуть за край для уменьшения размера.</p>
		<p id="add_img" class="help_b">Создание всплывающей картинки</p>
			<p>Сначала нужно загрузить две картинки на сайт. Когда картинки будут добавлены, нужно выделить первую картинку(основную), и затем выбрать картинку, которая и будет всплывающей. Для этого после выделения основной, нужно нажать на кнопку <b>Insert/edit link</b> на панели инструментов:</p>
			<a href="/img/admin/help/7.jpg"><img src="/img/admin/help/7.jpg" class="photohelp"/></a>
			<p>После нажатия на кнопку <b>Insert/edit link</b> нужно из списка загруженных картинок выбрать необходимую, т.е. ту, которая будет всплывающей. Для этого в строке <b>Link URL</b> нужно нажать кнопку <b>Browse</b>.</p>
			<a href="/img/admin/help/8.jpg"><img src="/img/admin/help/8.jpg" class="photohelp"/></a>
			<p>Затем во вкладке <b>Events</b> в строке <b>onclick</b> написать строку <b>return hs.expand(this) </b>и нажать <b>Insert</b></p>
			<a href="/img/admin/help/9.jpg"><img src="/img/admin/help/9.jpg" class="photohelp"/></a>
		<p id="border_img" class="help_b">Создание бордюра для картинки</p>
			<p>По умолчанию, картинки отображаются в том виде в каком они залиты на сайт. Но зачастую дизайн сайта подразумевает определенный стиль для картинок, добавляемых пользователем.</p>
			<p>Если Вы хотите создать бордюр для картинки, соответствующий общему дизайну сайт, тогда необходимо сделать следующее:</p>
			<p>1. Нужно, чтобы картинка была выделена. Пример показан ниже
			<a href="/img/admin/help/ris59.jpg"><img src="/img/admin/help/ris59.jpg" class="photohelp"/></a></p>
			<p>2. Далее нужно нажать на кнопку <b>Insert / Edit Image</b>на панели инструментов, расположение кнопки показано ниже:<a href="/img/admin/help/ris60.jpg"><img src="/img/admin/help/ris60.jpg" class="photohelp"/></a>
			</p>
			<p>3. После нажатия появится окно:<br><a href="/img/admin/help/ris61.jpg"><img src="/img/admin/help/ris61.jpg" class="photohelp"/></a></p>
			<p>4. В появившемя окне Вам нужно перейти во вкладку <b>Appearence</b> и в поле <b>Class</b> в раскрывающемся списке выбрать значение <b>value</b>, как показано на картинке ниже:</p>
			<a href="/img/admin/help/ris62.jpg"><img src="/img/admin/help/ris62.jpg" class="photohelp"/></a>
			<p>И в этом поле <b>маленькими буквами</b> написать слово <b>border</b></p>
			<a href="/img/admin/help/ris63.jpg"><img src="/img/admin/help/ris63.jpg" class="photohelp"/></a>
			<p>5. Затем нажать на кнопку <b>Update</b>. После этого появится диалогвое окно, в котором нужно нажать на кнопку <b>Ok</b></p>
			<a href="/img/admin/help/ris64.jpg"><img src="/img/admin/help/ris64.jpg" class="photohelp"/></a>
			<p style="text-align: center; font-size: 16px;"><b>Готово!</b></p>
		
			
			
			
			
	<h2 class="help_h2" id="text"> Работа с текстом</h2>
		<p id="text1" class="help_b">Сделать текст жирным</p>
			Для того чтобы сделать текст жирным, необходимо выделить нужную область и нажать на кнопку <b>Bold</b>
			<a href="/img/admin/help/ris17.jpg"><img src="/img/admin/help/ris17.jpg" class="photohelp"/></a>
			Результат действий показан на картинке ниже
			<a href="/img/admin/help/ris18.jpg"><img src="/img/admin/help/ris18.jpg" class="photohelp"/></a>
		<p id="text2" class="help_b">При копировании текста появляется фон или стиль текста искажен</p>
			<p>Если вы скопировали текст из какого-либо текстового редактора, то в окне редактирования вы можете увидеть следующее:</p>
			<a href="/img/admin/help/ris19.jpg"><img src="/img/admin/help/ris19.jpg" class="photohelp"/></a>
			<p>Так происходит из-за того, что в любом текстовом редакторе текст уже обладает набором стилей, и при копировании все эти стили переходят вместе с текстом. Чтобы избежать такой ситации, необходимо сделать следующее:</p>
			<p><b>Перед копированием</b> необходимо нажать на кнопку <b>Paste as Plain Text </b>на панели инструментов. Пример изображен ниже</p>
			<a href="/img/admin/help/ris20.jpg"><img src="/img/admin/help/ris20.jpg" class="photohelp"/></a>
			<p>После нажатия вы увидите, что эта кнопка зажата, т.е. находится в активном состоянии. Теперь можно вставлять текст.</p>
			<p><b>Внимание!</b> Перед тем, как вставить текст, убедитесь, что кнопка <b>Paste as Plain Text</b> находится в активном положении!<p>
		<p id="text3" class="help_b">Копирование текста из Word</p>
			<p>Перед копированием текста из текстового редактора Word нужно в окне редактирования текста нажать на кнопку <b>Paste from Word</b>:</p>
			<a href="/img/admin/help/ris21.jpg"><img src="/img/admin/help/ris21.jpg" class="photohelp"/></a>
		<p id="text4" class="help_b">Измененение цвета текста</p>
		<p>Чтобы сделать текст другим цветом, необходимо выделить текст, и нажать на кнопку <b>Select text color</b> на панели инструментов. Расположение этой кнопки показано на рисунке: <br/><br/>
		<a href="/img/admin/help/ris31.png"><img src="/img/admin/help/ris31.png" class="photohelp"/></a><br/><br/>
		После этого появится палитра цветов. <br/><br/>
		<a href="/img/admin/help/ris32.png"><img src="/img/admin/help/ris32.png" class="photohelp"/></a><br/><br/>
		Также можно выбрать подходящий цвет, нажав на кнопку <b>More colors</b> в открывшейся палитре и затем после того, как Вы выбрали цвет, нажмите на кнопку <b>Apply</b><br/><br/>
		После этого уже в окне редактировани текста, вы увидите, что цвет изменился.
		<p id="text5" class="help_b"> Параграфы как средство редактирования текста</p>
		При запонении контента сайта бывает необходимость выделить параграфы, т.е сделать разрывы между текстовыми блоками. Если вы хотите чтобы текст был без разрывовов между обзацами, тогда выделите весь текст, сделать это также можно, кликнув по пустому полю окна редавтирования текста и затем одновременно нажать клавиши <b>Ctrl</b> + <b>A</b>. После того, как весь текст выделен,  на панели инструментов в раскрывающемся списке должен быть выбран <b>Format</b>, пример показан на рисунке ниже:
		 <a href="/img/admin/help/ris57.jpg"><img src="/img/admin/help/ris57.jpg" class="photohelp"/></a><br/><br/>
		 Если же Вы хотите сделать разрывы между абзацами, как было предусмотрено в общем дизайне сайта, то нужно выбрать значение <b>Paragraph</b>. Пример показан на рисунке ниже:
		 <a href="/img/admin/help/ris58.jpg"><img src="/img/admin/help/ris58.jpg" class="photohelp"/></a><br/><br/>
		
		
		</p>
			
			
	<h2 class="help_h2" id="content_text"> Контентные страницы</h2>
		<p id="content_why" class="help_b">Для чего нужны контентные страницы?</p>
			<p>В меню для администратора сайта есть раздел с названием "Контетные страницы". Для чего же он нужен? Есть несколько причин:<br/><br/>
				1. На сайте есть информационная страница или даже подраздел, но вы не хотите прямо туда добавлять информацию, а хотите например дать разъяснение какому-либо термину, т.е сделать для него ссылку на свою контентную страницу.<br/>
				Для вовлечения посетителя необходимо ему показать, что сайт это не одна страница, на которую он случайно попал, на нём имеются множество других полезных ему материалов и, возможно, некоторые из них как раз являются тем, что он так долго искал.

Вспомните, когда вы читали интересную статью и в ней присутствовали неизвестные термины, связанные с тематикой статьи. Если вы незнакомы или поверхностно знакомы с упомянутым термином, вам интересна более детальная информация по нему, вы мотивированы к поиску новой информации. При этом, если нет ссылки в самой статье на этот термин, то вероятней всего, информация о нём будет искаться в поисковой системе. Вместо того, чтобы человека вовлекать в чтение своего сайта, вы отправляете его во внешнюю сеть.

Например, вы читаете статью про оператор Лапласа. Вам кто-то из знакомых сказал, вы решили посмотреть, что это такое. В статье имеется описание:

    Оператор Лапласа эквивалентен последовательному взятию операций градиента и дивергенции и его значение в точке может быть истолковано как плотность источников потенциального векторного поля в этой точке.

Очень здорово, если вы знаете, что такое градиент и дивергенция :) если не будет внутренних ссылок, то человек будет искать через внутренний или внешний поиск.

Если статья большая, в ней используются специальные термины, а также уместно будет разместить ссылку на уже существующую страницу сайта, то лучше её разместить. Если же страницы нет, то целесообразно рассмотреть добавление <b>контентной страницы</b> на сайт. Можно использовать не только термины, это могут быть также связанные новости и другие материалы по теме, похожие публикации. При этом, не следует вставлять много ссылок в контенте, лучше выделить основные из них.<br/><br/>
				2. Например, можно создать своего рода баннер. Для этого можно в любом разделе добавить картинку и сделать для нее ссылку. <br/>
				В общем эти две причины сводятся к одному: во избежание нагромождения страницы сайта, но при этом увеличивая ее информативность, нужно создавать контентные страницы.
			</p>
		<p id="content_add" class="help_b">Создание контентной страницы</p>
			<p>
				Чтобы создать контентную страницу, необходимо в меню выбрать раздел "Контентые страницы". Затем нажать на кнопку <a href="/img/admin/help/ris24.png"><img style="margin: 0 0 -5px 0;" src="/img/admin/help/ris24.png"/></a>. После нажатия на экране вы увидете:
				<a href="/img/admin/help/ris25.png"><img style="margin: 0 0 -5px 0;" src="/img/admin/help/ris25.png"/></a>
				Первой поле (URL путь). Чтобы поставить ссылку на какую-нибудь страничку, надо написать где именно эта страничка находится, т.е указать ее URL-адрес. Обычно URL-адрес связан с названием страницы, конечно же не полным. Это должно быть одно слово или два слова на английском языке.<br/>
				<b>Внимание! При назначении URL-адреса пишется либо одно слово, либо два, но через обязательный знак подчеркивания между ними. Никакие другие знаки между словами неприемлемы!</b>
				<br/>
				Например, вы хотите сделать ссылку на слово градиент. Можно и это слово принять за URL-адрес, переведя его на английский язык. Градиент по-английски gradient. Его и указываем в поле URL-адрес.
				<br/><br/>
				Далее нужно в поле Название указать название Вашей статьи.
				<br/><br/>
				В поле контент нужно занести основную информацию создаваемой страницы.
				<br/><br/>
				Далее нужно указать тайтл страницы. Тайтл - это строчка, которая появляется вверху браузера, когда открыта какая-то страница.
				<br/><br/>
				Если все поля заполнены правильно, нажимайте кнопку Отправить.
				<br/><br/>
				В результате будет создана контентная страница:<br/><br/>
				<a href="/img/admin/help/ris26.png"><img src="/img/admin/help/ris26.png"/></a>
			</p>
		<p id="content_add" class="help_b">Использование контентной страницы на сайте</p>
			<p>
				После открытия списка всех созданных контентных страниц в поле URL (путь) Вы увидите ссылки текстовых страниц. Теперь приступим к использованию этих ссылок на сайте. Например, у нас на сайте есть статья, в которой упоминается слово градиент. На это слово теперь надо указать ссылку.
				<br/>
				Для этого нужно выделить это слово(например, двойным щелчком левой клавишей мыши по слову градиент) и нажать на кнопку <b>Insert/edit link</b>. Расположение этой кнопки показано на рисунке ниже:<br/><br/>
				<a href="/img/admin/help/ris27.png"><img src="/img/admin/help/ris27.png"/></a><br/><br/>
				После нажатия появится следующее окно:<br/><br/>
				<a href="/img/admin/help/ris28.png"><img src="/img/admin/help/ris28.png"/></a><br/><br/>
				В этом окне нужно заполнить только одно поле <b>Link URL</b><br/>
				<b>Внимание! Заполение этого поля должно осуществляться по следующему шаблону:<br/> http://адрес сайта/URL-адрес контентной страницы</b>
				<br/><br/>
				<b>Адрес сайта</b>. Например, viki.ru<br/>
				<b>URL-адрес.</b> Этот адрес указан в списке всех созданных контентных страниц (например, /content/gradiaent/)<br/>
				И нажимаем на кнопку <b>Insert</b>.
				После этого в окне редактирования Вашей страницы, на которую только что была добавлена ссылка, ссылка будет выделена теперь синим цветом. Значит, все прошло успешно!
			</p>
			
			
			
			
			
			
	<h2 class="help_h2" id="hiper"> Создание ссылок</h2>
	<p id="create_hiper" class="help_b">Создание гиперссылки</p>
	<p>
		Гиперссылка используется в том случае, если по клику нужно перейти на другую страницу. При этом важно не уводить пользователя на другой сайт. Поэтому необходимо, чтобы после клика по ссылке сайт, на который ссылка указывает, открылся в другой вкладке или окне. Рассмотрим на примере.
		<br/><br/>
		Сначала рассмотрим пример для использования гиперссылки с целью перехода на другой сайт.
		Например, есть некоторая текстовая страница. В поле контент нужно выделить слово или фразу, на которую будет ссылаться сайт и нажать на кнопку <b>Insert/edit link</b><br/><br/>
		<a href="/img/admin/help/ris27.png"><img src="/img/admin/help/ris27.png"/></a><br/><br/>
		После этого появится окно:<br/><br/>
		<a href="/img/admin/help/ris28.png"><img src="/img/admin/help/ris28.png"/></a><br/><br/>
		1. Здесь нужно заполнить поле <b>Link URL</b>. Это поле должно содержать адрес сайта, на которую должен будет переходить пользователь после клика по ссылке. <br/>
		Для удобства откройте страницу сайта, на которую вы хотите сделать ссылку и скопируйте url-адрес.<br> 
		<b>Например, путь может выглядеть так: http://kirsh.ru</b>
		<br/><br/>
		2. Также нужно выбрать в поле Target значение <b>Open in new window (_blank)</b><br/><br/>
		<a href="/img/admin/help/ris30.png"><img src="/img/admin/help/ris30.png"/></a><br/><br/>
		Далее нужно нажать на кнопку <b>Update</b>. Все, готово!
	</p>
	<p id="create_download" class="help_b">Создание ссылки на другие сайты</p>
	<p>
		Очень часто на сайтах бывает необходимо разместить ссылку на скачивание файла. Рассмотрим этот процесс по шагам:<br/><br/>
		<p>1. Выделить текст для клика, т.е.  текст будущей сслыки. Пример показан ниже</p>
		<a href="/img/admin/help/ris51.jpg"><img src="/img/admin/help/ris51.jpg"/></a><br/><br/>
		<br>
		<p>2. Далее нажать на кнопку <b>Insert / edit link</b> на панели инструментов</p> 
		<a href="/img/admin/help/ris52.jpg"><img src="/img/admin/help/ris52.jpg"/></a><br/><br/>
		<p>Появится окно:</p>
		<a href="/img/admin/help/ris28.png"><img src="/img/admin/help/ris28.png"/></a><br/><br/>
		<p>В этом окне нужно нажать на кнопку <b>Browse</b>, как показано ниже</p>
		<a href="/img/admin/help/ris53.jpg"><img src="/img/admin/help/ris53.jpg"/></a><br/><br/>
		<p>После нажатия появится диалоговое окно, где нужно ввести <b>логин</b> и <b>пароль</b></p>
		<p>Логин <b>admin</b> и Пароль <b>cbm</b></p>
		<a href="/img/admin/help/ris5.jpg"><img src="/img/admin/help/ris5.jpg" class="photohelp" /></a>
		<p>После ввода имени и пароля вы увидите окно, показанное ниже:</p>
		<a href="/img/admin/help/ris6.jpg"><img style="width:650px;" src="/img/admin/help/ris6.jpg" class="photohelp" /></a>
		<p>3. Теперь приступим к загрзке самого файла.</p>
		<p>Для добавления картинки нужно нажать на кнопку Upload на панели инструментов. После нажатия появится окно:</p>
		<a href="/img/admin/help/ris10.jpg"><img src="/img/admin/help/ris10.jpg" class="photohelp" /></a>
		<p>В появившемся окне Вам нужно выбрать подгружаемые картинки. Для этого нужно нажать на кнопку <b>Обзор...</b> и выбрать файл, хранящийся на Вашем компьютере и нажать на кнопку Upload. Затем нажать на кнопку Close в верхнем правом углу этого кона. В результате Ваш файл будет добавлен. Результат действия показан на рисунке ниже</p>
		<a href="/img/admin/help/ris54.jpg"><img src="/img/admin/help/ris54.jpg" class="photohelp" /></a>
		Красным цветом в списке файлов и папок выделен добавленный файл. 
		<p>4. Далее нужно поставить галочку у этого файла с левой стороны и нажать на кнопку <b>Select</b></p>
		<a href="/img/admin/help/ris55.jpg"><img src="/img/admin/help/ris55.jpg" class="photohelp" /></a>
		<p>После нажатия появится окно:</p>
		<a href="/img/admin/help/ris56.jpg"><img src="/img/admin/help/ris56.jpg" class="photohelp" /></a>
		<p>	Вы увидете, что в поле URL автоматически появится созданная ссылка на Ваш добавленный файл. Теперь нужно нажать на кнопку <b>Insert</b>.
			<p>Готово!</p>
		</p>
	<h2 class="help_h2" id="list"> Создание списка</h2>
		<p id="list_numb" class="help_b">Нумерованный список</p>
			<p>
				Чтобы создать нумерованный список нужно выделить необходимый текст, и нажать на кнопку <b>Oredered list</b> на панели инструментов. Расположение этой кнопки показано на рисунке ниже:<br/><br/>
				<a href="/img/admin/help/ris33.png"><img src="/img/admin/help/ris33.png"/></a><br/><br/>
				Результат представлен ниже:<br/>
				<a href="/img/admin/help/ris34.png"><img src="/img/admin/help/ris34.png"/></a><br/><br/>
			</p>
		<p id="list_no_numb" class="help_b">Ненумерованный список</p>
		Для создания ненумерованного списка нужно сделать все то же самое, что и для создания нумерованного с той лишь разницей, что нужно нажать на кнопку <b>Unordered list</b> на панели инструментов. Пример показан ниже:<br/>
		<a href="/img/admin/help/ris48.png"><img src="/img/admin/help/ris48.png"/></a><br/><br/>
		
		
		
		
		<h2 class="help_h2" id="video">Добавление видео на сайт</h2>
			<p>
				<b>Внимание! Возможно добавление видео только с сайта <a href="http://youtube.com" target="_blank">youtube.com</a></b><br/><br/>
				Чтобы добавить видео на сайт, необходимо в окне редактирования на панели инструментов нажать кнопку <b>Insert/edit embedded media</b>
				<br/><br/>
				<a href="/img/admin/help/ris49.png"><img src="/img/admin/help/ris49.png"/></a><br/><br/>
				После нажатия появится окно, показанное на рисунке ниже<br/><br/>
				<a href="/img/admin/help/ris50.png"><img src="/img/admin/help/ris50.png"/></a><br/><br/>
				Здесь значение параметра <b>Type</b> должно быть <b>Flash</b>. В поле File/URL нужно ввести адрес видео в сети Интернет. Например, <a href="http://www.youtube.com/watch?v=2se9Thz5zyg" target="_blank">http://www.youtube.com/watch?v=2se9Thz5zyg</a><br/><br/>
				Затем нужно нажать кнопку <b>Insert</b>
			</p>
	</div>
{/capture}

{include file="admin/common/base_page.tpl"}