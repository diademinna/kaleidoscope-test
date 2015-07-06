/**
*	Site-specific configuration settings for Highslide JS
*/
hs.graphicsDir = '/js/highslide/graphics/';
hs.outlineType = 'custom';
hs.captionEval = 'this.a.title';
hs.showCredits = false;
hs.align = 'center';
hs.expandCursor = 'NULL';
hs.restoreCursor = 'NULL';

hs.outlineType = 'custom';
hs.dimmingOpacity = 0.7;
hs.dimmingDuration = 250;

hs.registerOverlay({
	html: '<div class="closebutton" onclick="return hs.close(this)" title="Закрыть"></div>',
	position: 'top right',
	useOnHtml: true,
	fade: 2 // fading the semi-transparent overlay looks bad in IE
});


// Add the slideshow controller
hs.addSlideshow({
	slideshowGroup: 'group1',
	interval: 5000,
	repeat: false,
	useControls: true,
	fixedControls: 'fit',
	overlayOptions: {
		className: 'large-dark',
		opacity: 0.75,
		position: 'bottom center',
		offsetX: 0,
		offsetY: -10,
		hideOnMouseOut: true
	}
});

// gallery config object
var config1 = {
	slideshowGroup: 'group1',
	numberPosition: 'caption',
	transitions: ['expand', 'crossfade']
};





// Russian language strings
hs.lang = {
	cssDirection: 'ltr',
	loadingText: 'Загружается...',
	loadingTitle: 'Нажмите для отмены',
	focusTitle: 'Нажмите чтобы поместить на передний план',
	fullExpandTitle: 'Развернуть до оригинального размера',
	creditsText: 'Использует <i>Highslide JS</i>',
	creditsTitle: 'Перейти на домашнюю страницу Highslide JS',
	previousText: 'Предыдущее',
	nextText: 'Следующее',
	moveText: 'Переместить',
	closeText: 'Закрыть',
	closeTitle: 'Закрыть (esc)',
	resizeTitle: 'Изменить размер',
	playText: 'Слайдшоу',
	playTitle: 'Начать слайдшоу (пробел)',
	pauseText: 'Пауза',
	pauseTitle: 'Приостановить слайдшоу (пробел)',
	previousTitle: 'Предыдущее (стрелка влево)',
	nextTitle: 'Следующее (стрелка вправо)',
	moveTitle: 'Переместить',
	fullExpandText: 'Оригинальный размер',
	number: 'Изображение %1 из %2',
	restoreTitle: 'Нажмите чтобы закрыть изображение, нажмите и перетащите для изменения местоположения. Для просмотра изображений используйте стрелки.'
};
