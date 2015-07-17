var volume;

$(function() {
	volume = $(".player");
	volume.roundSlider({
		editableTooltip: false,
		sliderType: "min-range",
		radius: 300,
		width: 30,
		value: 9,
		handleShape: "square",
		change: "onVolumeChanged"
	});
});

function onVolumeChanged(e) {
	var data = "volume=set&level="+e.value;
	$.ajax({
		type: "POST",
		url: "http://pc-mna-139/web-controler-radio/web/index.php",
		data: data,
	});
}
