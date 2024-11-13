checkWidgetValidity();

$('.preview_button').on('click', function () {
    // Define variables
    var button = $(this);
    var action_id = button.attr('button-id');
    var action = window.actions.find(item => item.id == action_id);

    button.html('<i class="fas fa-spinner"></i> Checking...').addClass('checking_button');

    // Wait for x seconds
    setTimeout(function () {
        button.html('<i class="far fa-check-circle"></i> Done!').css('pointer-events', 'none');

        // Check progress
        var completed_actions = $('input[name="actions_completed"]');
        var total_actions = $('.unlock_progress').attr('total-actions');
        completed_actions.val(parseInt(completed_actions.val()) + 1);

        // Change x/y text
        $('.stage_progress').text(completed_actions.val() + '/' + total_actions);

        // Get percentage of actions taken
        var percent = (completed_actions.val() / total_actions) * 100;

        // Animate progress meter
        $('.unlock_progress > div div').animate({ width: percent + '%' }, 500);

        // Check if all actions are complete
        if (completed_actions.val() == total_actions) {
            $('.submit').animate({ opacity: 1 }, 1000).css('pointer-events', 'all');
            $('.submit').html('<i class="fa fa-unlock"></i> Unlock Content');

            triggerConfetti();
        }

    }, action.time_to_complete * 1500);
});

$('.embed').on('click', function () {
    var url = window.location.href;
    var baseUrl = window.location.origin;
    var path = url.substring(baseUrl.length);
    var embedUrl = baseUrl + "/embed" + path;
    copyToClipboard('<iframe src="' + embedUrl + '" width="100%" height="100%" frameborder="0"></iframe>');

    $('.embed').text('Embed code copied!');

    setTimeout(function () {
        $('.embed').html('<i class="fas fa-code"></i> Embed this unlock');
    }, 2000);
});


$('.copy_url').on('click', function () {
    copyToClipboard(window.location.href);
    $('.copy_url').text('Link copied!');

    setTimeout(function () {
        $('.copy_url').animate({ opacity: 0 }, 500, function () {
            $('.copy_url').remove();
        });
    }, 500);
});


$('.submit').on('click', async function () {
    // Get the destination link
    const redirectToken = await getRedirectToken();

    // Show the destination link in previous window
    if (window.ad_link.length > 0) {

        if (window.ad_first == true) {
            // focus on ad in new tab
            openInNewTab(window.ad_link);
            window.location.href = '/redirect/' + window.link['slug'] + '/' + redirectToken;
        } else {
            // focus on content in new tab
            openInNewTab('/redirect/' + window.link['slug'] + '/' + redirectToken);
            window.location.href = window.ad_link;
        }

    } else {
        // No ad - just open content
        window.location.href = '/redirect/' + window.link['slug'] + '/' + redirectToken;
    }
});

async function getRedirectToken() {
    const response = await new Promise((resolve, reject) => {
        $.post('/get-destination/' + window.link['slug'], {_token: $('input[name="_token"]').val() },
            function(response) {
                resolve(response);
            }
        ).fail(function() {
            // Redirect to error page
            window.location.href = '/unusual-activity';
        });
    });

    return response.redirectToken;
}