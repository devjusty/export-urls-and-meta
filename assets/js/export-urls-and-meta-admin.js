jQuery(document).ready(function($) {
    // Handle preview button click
    $(document).on('click', '.preview-button', function(e) {
        e.preventDefault();
        processExport('preview');
    });
    
    // Handle export button click
    $(document).on('click', '.export-button', function(e) {
        e.preventDefault();
        processExport('export');
    });
    
    // Close modal when clicking the close button or outside the modal
    $(document).on('click', '.close-modal, .export-modal', function(e) {
        if ($(e.target).hasClass('close-modal') || $(e.target).hasClass('export-modal')) {
            $('.export-modal').hide();
            $('.export-modal .modal-content').html('');
        }
    });
    
    // Prevent clicks inside the modal content from closing the modal
    $(document).on('click', '.export-modal .modal-content', function(e) {
        e.stopPropagation();
    });
    
    // Function to handle both preview and export
    function processExport(action) {
        // Show loading state
        const $modal = $('.export-modal');
        $modal.show().html(`
            <div class="modal-content">
                <span class="close-modal">&times;</span>
                <div class="export-status">
                    <p>${action === 'preview' ? eumVars.messages.generatingPreview : eumVars.messages.exporting}</p>
                    <div class="spinner is-active"></div>
                </div>
            </div>
        `);
        
        // Get form data
        const formData = $('form.export-form').serialize() + '&action=eum_export&eum_action=' + action;
        
        // Send AJAX request
        $.ajax({
            url: eumVars.ajaxUrl,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    if (action === 'preview' && response.data.preview) {
                        // Show preview data in modal
                        showPreview(response.data);
                    } else {
                        // For export, redirect to download the file
                        if (response.data.file) {
                            window.location.href = response.data.file;
                        }
                        $modal.hide();
                    }
                } else {
                    showError(response.data || eumVars.messages.error);
                }
            },
            error: function(xhr, status, error) {
                let errorMessage = eumVars.messages.error;
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.data && response.data.message) {
                        errorMessage = response.data.message;
                    }
                } catch (e) {}
                showError(errorMessage);
            }
        });
    }
    
    // Function to display preview data
    function showPreview(data) {
        const $modal = $('.export-modal');
        let html = `
            <div class="modal-content">
                <span class="close-modal">&times;</span>
                <h3>${eumVars.messages.previewTitle || 'Preview'}</h3>
                <p>${data.count} ${eumVars.messages.itemsFound || 'items found'}</p>
                <div class="preview-table-container">
                    <table class="wp-list-table widefat fixed striped">
                        <thead>
                            <tr>`;
        
        // Add headers
        data.headers.forEach(header => {
            html += `<th>${header}</th>`;
        });
        
        html += `</tr></thead><tbody>`;
        
        // Add rows
        data.rows.forEach(row => {
            html += '<tr>';
            data.headers.forEach(header => {
                const value = row[header] || '';
                html += `<td>${value}</td>`;
            });
            html += '</tr>';
        });
        
        html += `
                        </tbody>
                    </table>
                </div>
                <div class="preview-actions">
                    <button type="button" class="button button-primary export-now">
                        ${eumVars.messages.exportAll || 'Export All'}
                    </button>
                    <button type="button" class="button close-modal">
                        ${eumVars.messages.closePreview || 'Close Preview'}
                    </button>
                </div>
            </div>`;
        
        $modal.html(html);
        
        // Handle export all button click
        $modal.find('.export-now').on('click', function() {
            $modal.hide();
            processExport('export');
        });
    }
    
    // Function to show error message
    function showError(message) {
        const $modal = $('.export-modal');
        $modal.html(`
            <div class="modal-content error">
                <span class="close-modal">&times;</span>
                <div class="error-message">
                    <p>${message}</p>
                    <button type="button" class="button close-modal">${eumVars.messages.close || 'Close'}</button>
                </div>
            </div>
        `);
    }
});
