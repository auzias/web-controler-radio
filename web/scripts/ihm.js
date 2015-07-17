var volume;

$(function() {
	doPoll();
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
		url: "index.php",
		data: data,
	});
}

function doPoll() {
	setTimeout(function() {
	 	$.ajax({
		        url: "index.php",
				data: "level",
		        type: "GET",
		        success: function(data) {
					console.log(data);
					volume.roundSlider.value = data;
		        },
		        complete: doPoll,
		        timeout: 2000
		})}
	, 3000);
}
