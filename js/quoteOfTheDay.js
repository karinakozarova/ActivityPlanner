$.ajax('https://quotes.rest/qod?language=en',   // request url
{
    success: function (data, status, xhr) {// success callback function
        $('#quoteoftheday').html(data['contents']['quotes'][0]['quote']);
    }
});