"use strict";

startUp();

function startUp() {
	//filmDetail_functions
	if (document.querySelector(".js-filmDetailCheck")) {
		writeCurrentRating();
		disableButton(document.querySelector(".js-personalRatingFormButton"));
		listenForRatingUpdates();
		document
			.querySelector(".js-buttonAddToUserLists")
			.addEventListener("click", (event) => {
				document.querySelector(".js-personalRatingCheck").hidden = false;
				// TODO add fetch to add it to your lists
				document.querySelector(".js-buttonAddToUserLists").hidden = true;
			});
	}
}

//#region filmDetail_functions

function writeCurrentRating() {
	var input = document.querySelector(".js-currentRatingInput");
	document.querySelector(".js-currentRatingDisplay").innerHTML =
		input.value / 10;
	input.addEventListener("input", (event) => {
		document.querySelector(".js-currentRatingDisplay").innerHTML =
			input.value / 10;
	});
}

function disableButton(button) {
	button.disabled = true;
	button.hidden = true;
}

function listenForRatingUpdates() {
	var input = document.querySelector(".js-currentRatingInput");
	var listTypeSelect = document.querySelector(".js-listTypeSelect");
	input.addEventListener("onchange", (event) => {
		//TODO: fetch to updateRating for userListLine
	});
	listTypeSelect.addEventListener("onchange", (event) => {
		// TODO: fetch to updateListType for userListLine
	});
}

//#endregion
