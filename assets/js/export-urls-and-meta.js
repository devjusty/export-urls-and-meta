(function ($) {
	$(function () {
		var loaderHTML =
			'<div id="eum-loader-overlay" role="dialog" aria-modal="true" aria-labelledby="eum-loader-title" style="display:none;">' +
			'<div id="eum-loader-message">' +
			'<h2 id="eum-loader-title">Export in progress</h2>' +
			'<div id="eum-loader-text">Please wait...</div>' +
			'<div id="eum-progress-status"></div>' +
			'<a id="eum-download-link" class="button button-primary" href="#" style="display:none;">Download Export</a>' +
			'<button id="eum-loader-close" type="button" class="button" style="margin-top:15px;">Close</button>' +
			"</div>" +
			"</div>";

		$("body").append(loaderHTML);

		var exportInProgress = false;
		var currentExportId = null;
		var activeRequest = null;
		var activeRequestType = null;
		var exportToken = 0;

		$("#eum-export-form").on("submit", function (event) {
			event.preventDefault();

			if (exportInProgress) {
				return;
			}

			exportInProgress = true;
			exportToken += 1;
			var requestToken = exportToken;
			$("#eum-loader-overlay").show();
			$("#eum-loader-close").focus();
			$("#eum-loader-text").text("Starting export...").css("color", "");
			$("#eum-progress-status").text("");
			$("#eum-download-link").hide().attr("href", "#");
			$(this).find('button[type="submit"]').prop("disabled", true);

			activeRequestType = "start";
			activeRequest = $.post(eum_ajax.ajax_url, {
				action: "eum_start_export",
				nonce: eum_ajax.nonce,
				form_data: $(this).serialize(),
			})
				.done(function (response) {
					if (requestToken !== exportToken) {
						activeRequest = null;
						activeRequestType = null;
						if (response.success && response.data && response.data.export_id) {
							$.post(eum_ajax.ajax_url, {
								action: "eum_cancel_export",
								nonce: eum_ajax.nonce,
								export_id: response.data.export_id,
							});
						}
						return;
					}

					activeRequest = null;
					activeRequestType = null;
					if (!response.success) {
						handleError(
							response.data && response.data.message
								? response.data.message
								: "Unable to start export.",
						);
						return;
					}

					currentExportId = response.data.export_id;
					$("#eum-loader-text").text("Processing...");
					processBatch(response.data.total_items, requestToken);
				})
				.fail(function () {
					if (requestToken !== exportToken) {
						return;
					}

					activeRequest = null;
					activeRequestType = null;
					handleError("Could not start the export process. Please try again.");
				});
		});

		$("#eum-loader-close").on("click", function (event) {
			event.preventDefault();

			exportToken += 1;
			if (activeRequest && "start" !== activeRequestType) {
				activeRequest.abort();
				activeRequest = null;
				activeRequestType = null;
			}

			var sessionId = currentExportId;
			if (sessionId) {
				$("#eum-loader-text").text("Cancelling export...");
				$.post(eum_ajax.ajax_url, {
					action: "eum_cancel_export",
					nonce: eum_ajax.nonce,
					export_id: sessionId,
				})
					.done(function () {
						currentExportId = null;
						$("#eum-loader-overlay").hide();
						resetForm();
					})
					.fail(function () {
						exportInProgress = false;
						$("#eum-loader-text")
							.text("Unable to cancel export. Try Close again.")
							.css("color", "#b32d2e");
						$("#eum-loader-close").focus();
					});
				return;
			}

			$("#eum-loader-overlay").hide();
			currentExportId = null;
			resetForm();
		});

		$(document).on("keyup", function (event) {
			if ("Escape" === event.key && $("#eum-loader-overlay").is(":visible")) {
				$("#eum-loader-close").trigger("click");
			}
		});

		function processBatch(total, requestToken) {
			activeRequestType = "process";
			activeRequest = $.post(eum_ajax.ajax_url, {
				action: "eum_process_batch",
				nonce: eum_ajax.nonce,
				export_id: currentExportId,
			})
				.done(function (response) {
					if (requestToken !== exportToken) {
						return;
					}

					activeRequest = null;
					activeRequestType = null;
					if (!response.success) {
						handleError(
							response.data && response.data.message
								? response.data.message
								: "An error occurred during export.",
						);
						return;
					}

					var processed = parseInt(response.data.processed, 10) || 0;
					var responseTotal = parseInt(response.data.total, 10) || total;
					$("#eum-progress-status").text(
						processed + " / " + responseTotal + " items processed.",
					);

					if ("complete" === response.data.status) {
						exportInProgress = false;
						$("#eum-loader-text").text("Export complete!");
						$("#eum-download-link")
							.attr(
								"href",
								eum_ajax.ajax_url +
									"?action=eum_download_file&nonce=" +
									encodeURIComponent(eum_ajax.nonce) +
									"&export_id=" +
									encodeURIComponent(currentExportId),
							)
							.show();
						resetForm();
						return;
					}

					window.setTimeout(function () {
						if (requestToken !== exportToken || !currentExportId) {
							return;
						}
						processBatch(responseTotal, requestToken);
					}, 50);
				})
				.fail(function () {
					if (requestToken !== exportToken) {
						return;
					}

					activeRequest = null;
					activeRequestType = null;
					handleError("A critical error occurred while processing a batch.");
				});
		}

		function handleError(message) {
			$("#eum-loader-text")
				.text("Error: " + message)
				.css("color", "#b32d2e");
			exportToken += 1;
			if (activeRequest) {
				activeRequest.abort();
				activeRequest = null;
			}
			if (currentExportId) {
				$.post(eum_ajax.ajax_url, {
					action: "eum_cancel_export",
					nonce: eum_ajax.nonce,
					export_id: currentExportId,
				}).always(function () {
					currentExportId = null;
					resetForm();
				});
			} else {
				resetForm();
			}
			exportInProgress = false;
			$("#eum-loader-close").focus();
		}

		function resetForm() {
			exportInProgress = false;
			currentExportId = null;
			$('#eum-export-form button[type="submit"]').prop("disabled", false);
		}
	});
})(jQuery);
