var endpoint = 'https://cs3744contentmod.cognitiveservices.azure.com/';
var subkey = '503fc2c54e204696be5172d5c502cf15';

$(function() {

  // event handler for title textbox
  $('#submitTitle').blur(function(){
    moderateTitle();
  });

});

/**
* This function is used to moderate text to check for any unwanted words and then disable the submit button
* and then notify the user through a text message
**/
function moderateTitle() {
  var params = {
    // Request parameters
    "autocorrect": true,
    "language": "eng",
  };
  //Works for both the description as well as the title
  var txt = $('#submitTitle').val();

  //Call ajax and retrieve information
  $.ajax({
      url: endpoint + "contentmoderator/moderate/v1.0/ProcessText/Screen?" + $.param(params),
      beforeSend: function(xhrObj) {
        // Request headers
        xhrObj.setRequestHeader("Content-Type", "text/plain");
        xhrObj.setRequestHeader("Ocp-Apim-Subscription-Key", subkey);
      },
      type: "POST",
      // Request body
      data: txt,
    })
    .done(function(data) {
      $('#alert').remove();
      console.log(data.Terms);
      var terms = data.Terms;
      //If any sensitive words were detected
      if (data.Terms) {
        var invalidTerms = data.Terms[0]['Term'];
        for (var i = 1; i < terms.length; i++) {
          invalidTerms = invalidTerms + ", " + data.Terms[i]['Term'];
        }
        //Insert message stating which terms need to be removed
        var msg = '<div class="alert" id="alert"><span>Please remove the following terms from your Title: '+invalidTerms+'<span> </div>';
        $('.invalidTerms').append(msg);
        $("#submitBtn").attr("disabled", true);
      }
      //If no sensitive words were found
      else {
        $('#alert').remove();
        $("#submitBtn").attr("disabled", false);
      }
    })
    .fail(function() {
        //If user needs to slow down his responses display message for the title and disable button till then
        var msg = '<div class="alert" id="alert"><span>Content Moderation for text is not working. Please slow down your responses<span> </div>';
        $("#submitBtn").attr("disabled", true);
        $('.invalidTerms').append(msg);
    });
}
