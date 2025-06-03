jQuery(document).ready(function($) {
    // Show modal when export button is clicked
    $(document).on('click', '.export-button', function(e) {
        e.preventDefault();
        
        // Show the modal
        $('.export-modal').show();
        
        // Start the export process
        startExport();
    });
    
    // Close modal when clicking the close button or outside the modal
    $(document).on('click', '.close-modal, .export-modal', function(e) {
        // Only close if clicking the close button or the modal overlay (not the modal content)
        if ($(e.target).hasClass('close-modal') || $(e.target).hasClass('export-modal')) {
            $('.export-modal').hide();
        }
    });
    
    // Prevent clicks inside the modal content from closing the modal
    $('.modal-content').on('click', function(e) {
        e.stopPropagation();
    });
    
    // Function to handle the export process
    function startExport() {
        // Show loading state
        $('.modal-content p').text(eum_vars.exporting);
        $('.close-modal').prop('disabled', true);
        
        // Get form data
        var formData = $('form.export-form').serialize();
        
        // Submit the form programmatically
        $('form.export-form').submit();
    }
});
