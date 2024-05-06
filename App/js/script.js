"use strict";

startUp();

function startUp() {
	//filmDetail_functions
	if (document.querySelector(".js-filmDetailCheck")) {
		writeCurrentRating();
		disableButton(document.querySelector(".js-personalRatingFormButton"));
		listenForRatingUpdates();
		listenForAddToListButton();
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

	const pendingInputs = new WeakMap();
	const pendingSelects = new WeakMap();

	input.addEventListener("input", (event) => {
		var formData = new FormData();
		formData.append("action", "updateRating");
		formData.append("rating", input.value);
		formData.append("filmId", input.dataset.filmid);
		const controller = new AbortController();
		const signal = controller.signal;

		const previousController = pendingInputs.get(input);

		if (previousController) {
			previousController.abort();
		}

		pendingInputs.set(input, controller);

		fetch("ajax_userlists.php", {
			method: "post",
			mode: "cors",
			signal: signal,
			body: formData,
		})
			.then((response) => {
				// console.log(response);
			})
			.catch(function (err) {
				if (err.name === "AbortError") {
					console.log("fetch aborted");
				} else {
					console.log("Failed to fetch page: ", err);
				}
			});
	});

	listTypeSelect.addEventListener("input", (event) => {
		var formData = new FormData();
		formData.append("action", "updateListType");
		formData.append("listTypeId", listTypeSelect.value);
		formData.append("filmId", listTypeSelect.dataset.filmid);

		const controller = new AbortController();
		const signal = controller.signal;

		const previousController = pendingSelects.get(listTypeSelect);

		if (previousController) {
			previousController.abort();
		}

		pendingSelects.set(listTypeSelect, controller);

		fetch("ajax_userlists.php", {
			method: "post",
			mode: "cors",
			body: formData,
			signal: signal,
		})
			.then((response) => {
				// console.log(response);
			})
			.catch(function (err) {
				if (err.name === "AbortError") {
					console.log("fetch aborted");
				} else {
					console.log("Failed to fetch page: ", err);
				}
			});
	});
}

function listenForAddToListButton() {
	document
		.querySelector(".js-buttonAddToUserLists")
		.addEventListener("click", (event) => {
			document.querySelector(".js-personalRatingCheck").hidden = false;
			document.querySelector(".js-buttonAddToUserLists").hidden = true;
			document.querySelector(".js-listTypeSelect").value = 1;
			console.log(
				document.querySelector(".js-buttonAddToUserLists").dataset.filmid
			);
			var formData = new FormData();
			formData.append("action", "newLine");
			formData.append(
				"filmId",
				document.querySelector(".js-buttonAddToUserLists").dataset.filmid
			);
			fetch("ajax_userlists.php", {
				method: "post",
				mode: "cors",
				body: formData,
			})
				.then((response) => {
					// console.log(response);
				})
				.catch(function (err) {
					console.log("Failed to fetch page: ", err);
				});
		});
}

//#endregion
