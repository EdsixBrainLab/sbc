// from: http://stackoverflow.com/a/5303242/945521
if ( XMLHttpRequest.prototype.sendAsBinary === undefined ) {
  XMLHttpRequest.prototype.sendAsBinary = function(string) {
    var bytes = Array.prototype.map.call(string, function(c) {
      return c.charCodeAt(0) & 0xff;
    });
    this.send(new Uint8Array(bytes).buffer);
  };
};

window.fbAsyncInit = function() {
  FB.init({
    appId      : '1133381510011719',//'1133381510011719' 
    xfbml      : true,
    version    : 'v2.5'
  });
};

(function(d, s, id){
 var js, fjs = d.getElementsByTagName(s)[0];
 if (d.getElementById(id)) {return;}
 js = d.createElement(s); js.id = id;
 js.src = "//connect.facebook.net/en_US/sdk.js";
 fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

var postImageToFacebook = function( authToken, filename, mimeType, imageData, message, continuePost )
{
    // this is the multipart/form-data boundary we'll use
    var boundary = '----ThisIsTheBoundary1234567890';
    // let's encode our image file, which is contained in the var
    var formData = '--' + boundary + '\r\n'
    formData += 'Content-Disposition: form-data; name="source"; filename="' + filename + '"\r\n';
    formData += 'Content-Type: ' + mimeType + '\r\n\r\n';
    for ( var i = 0; i < imageData.length; ++i )
    {
      formData += String.fromCharCode( imageData[ i ] & 0xff );
    }
    formData += '\r\n';
    formData += '--' + boundary + '\r\n';
    /*formData += 'Content-Disposition: form-data; name="message"\r\n\r\n';
    formData += message + '\r\n'
    formData += '--' + boundary + '--\r\n';*/

    var xhr = new XMLHttpRequest();
    xhr.open( 'POST', 'https://graph.facebook.com/me/photos?access_token=' + authToken, true );
    xhr.onload = xhr.onerror = function() {
      //console.log( xhr.responseText );
      if(continuePost){
        publishStar();
      }
      else {
        $('#fbcapture').attr('disabled', false);
        $('.fbstatus').text('Thanks for sharing the scores.');
      }
    };
    xhr.setRequestHeader( "Content-Type", "multipart/form-data; boundary=" + boundary );
    xhr.sendAsBinary( formData );
  };

  var postCanvasToFacebook = function(canvas, message, continuePost) {
    var data = canvas.toDataURL("image/png");
    var encodedPng = data.substring(data.indexOf(',') + 1, data.length);
    var decodedPng = Base64Binary.decode(encodedPng);
    FB.getLoginStatus(function(response) {
      if (response.status === "connected") {
        postImageToFacebook(response.authResponse.accessToken, "heroesgenerator", "image/png", decodedPng, message, continuePost);
      } else if (response.status === "not_authorized") {
       FB.login(function(response) {
        postImageToFacebook(response.authResponse.accessToken, "heroesgenerator", "image/png", decodedPng, message, continuePost);
      }, {scope:'publish_actions'});
     } else {
       FB.login(function(response)  {
        postImageToFacebook(response.authResponse.accessToken, "heroesgenerator", "image/png", decodedPng, message, continuePost);
      }, {scope:'publish_actions'});
     }
   });

  };

  var publishStar = function(){
    $('.snapUrl').text('www.thesuperbrainchallenge.com');
    html2canvas($("#fbstar"), {
      onrendered: function(canvas) {
        postCanvasToFacebook(canvas, "See stars I won @ The Super Brain Challenge. It is awesome! (www.thesuperbrainchallenge.com)", false);
        $('.snapUrl').text('');
      }
    });
  };
  
  $('#fbcapture').on('click', function(event){
    //console.log("Captured!")
    $(this).attr('disabled', true);
    $('.fbstatus').text('Please wait...');
    $('.snapUrl').text('www.thesuperbrainchallenge.com');
    html2canvas($("#fbscore"), {
      onrendered: function(canvas) {
        postCanvasToFacebook(canvas, "My skills score @ The Super Brain Challenge. It is awesome! (www.thesuperbrainchallenge.com)", true);
        $('.snapUrl').text('');
      }
    });
  });
  
