function initialize() {
	enablePopovers()
	if(viewMode=="viewing") {
		// @TODO teacherResponseUpdates();
	}
}

// ---- Popovers ----
function enablePopovers() {
	$('[data-toggle="popover"]').popover({
		trigger: 'hover',
		delay: { "show": 1000, "hide": 100 },
		html: true,
	}).off("click").click(function(){$(this).popover("show");});
}

// ---- Question Editing ----
function genericQuestionUpdateAndCheck() {
	if(viewMode!="viewing") {
		$("[data-question-type]").each(function(_index,item) {
			$(item).keyup(function() {
				progressChanged();
				checkIfAllAreAnswered();
			});
		});
	}
}

function genericQuestionUpdateAndCheckWithTabToEnter() {
	if(viewMode!="viewing") {
		$("[data-question-type]").each(function(_index,item) {
			$(item).keyup(function() {
				progressChanged();
				checkIfAllAreAnswered();
			}).keydown(function(event) {
				enterToTab(event);
			});
		});
	}
}

function enterToTab(event) {
	if(event.which===13) {
		event.stopPropagation();
		event.preventDefault();

		inputs = $("input");

		if(event.shiftKey) {
			if(!$(event.target).is(inputs.first())) {
				inputs.eq(inputs.index( event.target ) - 1).focus();
			}
		} else {
			if(!$(event.target).is(inputs.last())) {
				inputs.eq(inputs.index( event.target ) + 1).focus();
			}
		}
	}
}

// ---- Question Markers
function questionMarkerComplete(which) {
	$("#" + which).removeClass("question-marker-incomplete");
	$("#" + which).addClass("question-marker-complete");
}

function questionMarkerIncomplete(which) {
	$("#" + which).addClass("question-marker-incomplete");
	$("#" + which).removeClass("question-marker-complete");
}
// ---- Preloading Images ----
function preloadImages(imageArray, sourceDir, index) {
	index = index || 0;
	if (imageArray && imageArray.length > index) {
		var img = new Image ();
		img.onload = function() {
			preloadImages(imageArray, sourceDir, index + 1);
		}
		img.src = sourceDir + imageArray[index];
	}
}

function backToDashboard() { alert("Will go back to dashboard... soon"); }
function backToAccounts() { alert("Will go back to accounts... soon"); }
function leaveComment() { alert("Will allow you to leave comment... soon"); }
