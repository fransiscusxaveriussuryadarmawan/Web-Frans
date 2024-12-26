var trigger_widget_select_change = new CustomEvent("widget-select-updated");

var widgetTypingTimer;                //timer identifier
var widgetDoneTypingInterval = 10000;  //time in ms (5 seconds)
$('body').on('keyup paste', 'input[name="widget_link"]', function () {
    var field = $(this);
    var value = field.val();

    clearTimeout(widgetTypingTimer);

    if (value) widgetTypingTimer = setTimeout(checkWidgetValidity, widgetDoneTypingInterval);
});

function getWidgetType() {
    var widgetType = $('input[name="widget"]').val();

    if (widgetType.length == 0) return null;

    return widgetType;
}

function getWidgetLink() {
    var widgetLink = $('input[name="widget_link"]').val();

    if (widgetLink.length == 0) return null;

    return widgetLink;
}

function clearWidgetLink() {
    $('input[name="widget_link"]').val('');
}

function checkWidgetValidity() {
    var widgetType = getWidgetType();
    var widgetLink = getWidgetLink();

    markWidgetAs(0);

    if (widgetType == null) return;

    processWidgetByType(widgetType, widgetLink);
}

function processWidgetByType(widgetType, widgetLink) {

    $('.form .preview .widget_container').css('display', 'block');
    $('.form .preview .widget_container').removeClass('spotify_track image_link instagram_post twitch_stream twitch_video');

    widgetLinkHasError(false);

    try {


        if (widgetType === 'image-link') {
            return processImageLink(widgetLink);
        }
        if (widgetType === 'youtube-video') {
            return processYouTubeVideo(widgetLink);
        }

        if (widgetType === 'spotify-track-playlist') {
            return processSpotifyTrack(widgetLink);
        }

        if (widgetType === 'instagram-post') {
            return processInstagramPost(widgetLink);
        }

        if (widgetType === 'twitch-stream') {
            return processTwitchStream(widgetLink);
        }

        if (widgetType == 'no-widget') {
            resetSelect('widget');
        }
    } catch (e) {
        console.log(e);
    }
}

function resetSelect(name) {
    var select = $(`.one_select[select-name="${name}"]`);

    if (select.length == 0) return;


    select.find('.selected_value').remove();
    select.find('.move_label').removeClass('move_label');
    select.find('input').val('');
}

function processImageLink(imageLink) {

    if (imageLink.length === 0 || imageLink.match(/\.(jpeg|jpg|gif|png)$/) === null) {
        markWidgetAs(0);
        widgetLinkHasError(true);
        hideWidget();
        return;
    }

    embedImageToWidget(imageLink);
}

function processInstagramPost(postLink) {

    var p = /((?:https?:\/\/)?(?:www\.)?instagram\.com\/(?:p|reel)\/([^/?#&]+)).*/g;

    if (postLink.length === 0 || postLink.match(p) === null) {
        markWidgetAs(0);
        widgetLinkHasError(true);
        hideWidget();
        return;
    }

    embedInstagramPostToWidget(postLink);
}

function markWidgetAs(validity) {
    $('input[name="widget_validity"]').val(validity);
    checkFormValidity();
}

function processTwitchStream(streamLink) {

    var p = /^(?:https?:\/\/)?(?:www\.|go\.)?twitch\.tv\/([a-z0-9_]+)($|\?)/;

    if (streamLink.length === 0 || streamLink.match(p) === null && streamLink.includes('/videos/') === false) {
        markWidgetAs(0);
        widgetLinkHasError(true);
        hideWidget();
        return;
    }

    var type = 'stream';

    if (streamLink.includes('/videos/')) {
        type = 'video';
    }

    streamLink = /[^/]*$/.exec(streamLink)[0];

    embedTwitchStreamToWidget(streamLink, type);

}

function processYouTubeVideo(youtubeVideoLink) {
    var p = /^(?:https?:\/\/)?(?:m\.|www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;

    if (youtubeVideoLink.length === 0 || youtubeVideoLink.match(p) === null) {
        markWidgetAs(0);
        widgetLinkHasError(true);
        hideWidget();
        return;
    }

    youtubeVideoLink = youtubeVideoLink.replace('watch?v=', 'embed/');

    embedYouTubeVideoToWidget(youtubeVideoLink);
}

function processSpotifyTrack(spotifyTrackLink) {
    var p = /^(spotify:|https:\/\/[a-z]+\.spotify\.com\/)/;
    var isTrack = false;

    if (spotifyTrackLink.length === 0 || p.test(spotifyTrackLink) === false) {
        markWidgetAs(0);
        widgetLinkHasError(true);
        hideWidget();
        return;
    }

    if (!spotifyTrackLink.includes('/embed/track')) {
        spotifyTrackLink = spotifyTrackLink.replace('track', 'embed/track');
    }

    if (!spotifyTrackLink.includes('/embed/playlist')) {
        spotifyTrackLink = spotifyTrackLink.replace('playlist', 'embed/playlist');
    }

    if (!spotifyTrackLink.includes('/embed/album')) {
        spotifyTrackLink = spotifyTrackLink.replace('album', 'embed/album');
    }

    if (!spotifyTrackLink.includes('/embed/artist')) {
        spotifyTrackLink = spotifyTrackLink.replace('artist', 'embed/artist');
    }

    if (spotifyTrackLink.includes('/embed/track')) {
        isTrack = true;
    }

    embedSpotifyTrackToWidget(spotifyTrackLink, isTrack);
}

function widgetLinkHasError(hasError) {
    $('input[name="widget_link"]').css('border-bottom-color', hasError ? 'red' : 'var(--white)');
}

function embedYouTubeVideoToWidget(youtubeVideoLink) {
    var template = `
    <iframe width="560" height="315" src="${youtubeVideoLink}"
    title="YouTube video player" frameborder="0" allow="accelerometer; autoplay;
    clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
    </iframe>
    `

    $('.widget_container').html(template);
    markWidgetAs(1);
    checkFormValidity();
}

function embedTwitchStreamToWidget(twitchStream, type) {

    let contentType;

    if (type == 'video') {
        contentType = `video: "${twitchStream}"`;
        $('.form .preview .widget_container').addClass('twitch_video');
    } else {
        contentType = `channel: "${twitchStream}"`;
        $('.form .preview .widget_container').addClass('twitch_stream');
    }

    var template = `
        <div id="twitch-embed"></div>

        <script type="text/javascript">
            new Twitch.Embed("twitch-embed", {
                muted: true,
                ${contentType}
            });
        </script>
    `;

    $('.widget_container').html(template);
    markWidgetAs(1);
}

function embedInstagramPostToWidget(postLink) {
    $('.form .preview .widget_container').addClass('instagram_post');
    var template = `
        <blockquote class="instagram-media"
        data-instgrm-permalink="${postLink}"
        data-instgrm-version="14">
        <script src="//www.instagram.com/embed.js"></script>
    `;

    $('.widget_container').html(template);
    markWidgetAs(1);
}

function embedImageToWidget(imageUrl) {
    $('.form .preview .widget_container').addClass('image_link');
    $('.widget_container').html(`
        <img src="${imageUrl}" class="widget_image">
    `);

    markWidgetAs(1);
}

function embedSpotifyTrackToWidget(spotifyTrackLink, isTrack) {

    if (isTrack) {
        $('.form .preview .widget_container').addClass('spotify_track');
    }

    var template = `
    <iframe style="border-radius:12px" src="${spotifyTrackLink}"
    frameBorder="0" allowfullscreen="" allow="autoplay;
    clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
    `;

    $('.widget_container').html(template);
    markWidgetAs(1);
}

document.addEventListener("widget-select-updated", function (e) {

    var select = $('.one_select[select-name="widget"]');
    select.find('.no_widget').toggleClass('show');

    resetWidgetForm();
    markWidgetAs(0);

    if (getWidgetType() === 'no-widget') {
        resetSelect('widget');
    }

});

function resetWidgetForm() {
    checkFormValidity();
    hideWidget();
    clearWidgetLink();
}

function hideWidget() {
    $('.form .preview .widget_container').css('display', 'none');
}

function widgetIsOkay() {
    var link = $('input[name="widget_link"]').val();
    var valid = $('input[name="widget_validity"]').val();

    if (link.length == 0) return true;

    if (valid == 0) return false;

    return true;
}