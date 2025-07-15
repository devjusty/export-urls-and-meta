(function ($) {
  $(document).ready(function () {
    // --- Loader Overlay ---
    var loaderHTML =
      '<div id="eum-loader-overlay" role="dialog" aria-modal="true" aria-labelledby="eum-loader-title">' +
      '<div id="eum-loader-message">' +
      '<h2 id="eum-loader-title">Export in progress</h2>' +
      '<div id="eum-loader-text">Please wait...</div>' +
      '<div id="eum-progress-bar-container"><div id="eum-progress-bar"></div></div>' +
      '<div id="eum-progress-status"></div>' +
      '<div id="eum-download-link-container" style="display:none; margin-top: 15px;"><a id="eum-download-link" class="button button-primary" href="#" download>Download Export</a></div>' +
      '<button id="eum-loader-close" aria-label="Close" style="margin-top: 15px;">Close</button>' +
      '</div>' +
      '</div>';
    $('body').append(loaderHTML);

    var exportInProgress = false;
    var currentExportId = null;

    // --- Event Handlers ---
    $('#eum-export-form').on('submit', function (e) {
      e.preventDefault();

      if (exportInProgress) {
        return;
      }
      exportInProgress = true;

      // Reset UI
      $('#eum-loader-overlay').show();
      $('#eum-loader-close').focus();
      $('#eum-progress-bar').css('width', '0%');
      $('#eum-progress-status').text('');
      $('#eum-download-link-container').hide();
      $('#eum-loader-text').text('Starting export...').css('color', '');
      $(this).find('button[type="submit"]').attr('disabled', 'disabled');

      var formData = $(this).serialize();

      // 1. Start the export
      $.post(eum_ajax.ajax_url, {
        action: 'eum_start_export',
        nonce: eum_ajax.nonce,
        form_data: formData,
      })
        .done(function (response) {
          if (response.success) {
            $('#eum-loader-text').text('Processing...');
            var export_id = response.data.export_id;
            currentExportId = export_id;
            var total_items = response.data.total_items;
            updateProgress(0, total_items);
            if (total_items > 0) {
              processBatch(export_id, total_items);
            } else {
              handleError('No items found to export.');
            }
          } else {
            handleError(response.data.message || 'An unknown error occurred.');
          }
        })
        .fail(function () {
          handleError('Could not start the export process. Please try again.');
        });
    });

    $('#eum-loader-close').on('click', function (e) {
      e.preventDefault();

      if (exportInProgress && currentExportId) {
        // Send cancel request to the server
        $.post(eum_ajax.ajax_url, {
          action: 'eum_cancel_export',
          nonce: eum_ajax.nonce,
          export_id: currentExportId,
        });
      }

      $('#eum-loader-overlay').hide();
      resetForm();
    });

    $('#eum-preview-button').on('click', function (e) {
      e.preventDefault();
      var $previewContainer = $('#eum-preview-container');
      var $previewContent = $('#eum-preview-content');

      $previewContainer.show();
      $previewContent.html('<p>Loading preview...</p>');

      var formData = $('#eum-export-form').serialize();

      $.post(eum_ajax.ajax_url, {
        action: 'eum_ajax_preview_export',
        nonce: eum_ajax.nonce,
        form_data: formData,
      })
        .done(function (response) {
          if (response.success) {
            var data = response.data.data;
            if (data.length < 2) { // Headers + no data
              $previewContent.html('<p>No items found for the selected criteria.</p>');
              return;
            }
            var table = '<table class="wp-list-table widefat striped">';
            // Header
            table += '<thead><tr>';
            data[0].forEach(function (header) {
              table += '<th>' + header + '</th>';
            });
            table += '</tr></thead>';
            // Body
            table += '<tbody>';
            for (var i = 1; i < data.length; i++) {
              table += '<tr>';
              data[i].forEach(function (cell) {
                table += '<td>' + cell + '</td>';
              });
              table += '</tr>';
            }
            table += '</tbody></table>';
            $previewContent.html(table);
          } else {
            $previewContent.html('<p style="color:red;">Error: ' + response.data.message + '</p>');
          }
        })
        .fail(function () {
          $previewContent.html('<p style="color:red;">An unknown error occurred while generating the preview.</p>');
        });
    });

    // --- Core Functions ---
    function processBatch(export_id, total_items) {
      $.post(eum_ajax.ajax_url, {
        action: 'eum_process_batch',
        nonce: eum_ajax.nonce,
        export_id: export_id,
      })
        .done(function (response) {
          if (response.success) {
            if (response.data.status === 'processing') {
              updateProgress(response.data.processed, total_items);
              processBatch(export_id, total_items); // Process next batch
            } else if (response.data.status === 'complete') {
              updateProgress(total_items, total_items);
              $('#eum-loader-text').text('Export complete!');
              var download_url = eum_ajax.ajax_url + '?action=eum_download_file&nonce=' + eum_ajax.nonce + '&export_id=' + export_id;
              displayDownloadLink(download_url);
            }
          } else {
            handleError(response.data.message || 'An error occurred during processing.');
          }
        })
        .fail(function () {
          handleError('A critical error occurred while processing a batch.');
        });
    }

    function updateProgress(processed, total) {
      var percentage = total > 0 ? (processed / total) * 100 : 0;
      $('#eum-progress-bar').css('width', percentage + '%');
      $('#eum-progress-status').text(processed + ' / ' + total + ' items processed.');
    }

    function displayDownloadLink(url) {
      $('#eum-download-link').attr('href', url);
      $('#eum-download-link-container').show();
    }

    function handleError(message) {
      $('#eum-loader-text').html('<span style="color: red;">Error: ' + message + '</span>');
      resetForm();
    }

    function resetForm() {
      exportInProgress = false;
      currentExportId = null;
      $('#eum-export-form button[type="submit"]').removeAttr('disabled');
    }
  });
})(jQuery);
