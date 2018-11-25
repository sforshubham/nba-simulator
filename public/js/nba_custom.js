var timeInterval = 5000;

$(document).ready(function () {
	updateMatchScores();

	$('button#trigger_nba_week').on('click', function (){
		location.reload();
	})
});
/**
 * Recursively triggers the request to get updated match scores
 *
 * author      Shubham Goel <shubham0091@gmail.com>
 */
function updateMatchScores() {
	interval = setInterval(function() {
	    showLoader();
	    getMatchScores();
	}, timeInterval);
}

/**
 * The request to get updated match scores
 *
 * author      Shubham Goel <shubham0091@gmail.com>
 */
function getMatchScores() {
	$.ajax({
		url: '/api/updated-scores',
		type: 'get',
		success: function (response) {
			hideLoader();
			if (response.minutes_passed >= response.match_play_time) {
				$('button#trigger_nba_week').removeAttr('disabled');
				clearInterval(interval);
			} else {
				updateScoresOnUI(response.data);
			}
		},
		error: function (xhr, ajaxOptions, thrownError) {
			hideLoader();
			if (interval) {
				clearInterval(interval);
			}
	        //alert('Error ' + xhr.status + ': ' + thrownError);
	    }
	});
}

function updateScoresOnUI(data) {
	for (var k in data){
	    if (data.hasOwnProperty(k)) {
	        $('span#team_id_'+k).text(data[k]);
	    }
	}
}

function showLoader() {
	$('.loading-div').show();
}

function hideLoader() {
	$('.loading-div').hide();
}
