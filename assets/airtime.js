jQuery(document).ready(function($) {
    $('#airtimeForm').on('submit', function(e) {
        e.preventDefault();
        // Add a loading spinner or message
        $(this).append('<div class="loading">Processing your payment...</div>');
        
        // Optionally submit the form with AJAX (if you want to avoid page reloads)
        $.post($(this).attr('action'), $(this).serialize(), function(response) {
            $('.loading').remove();
            // Handle response (e.g., redirect to Paynow, show errors)
        });
    });
});
