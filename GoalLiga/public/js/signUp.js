//Wait till the document is ready
$(document).ready(function(){
  //Functions runs on click
  $('#createAccountBtn').click(function(){
    //Get form field values
    var username = $('#un').val();
    var password = $('#pw').val();
    var email = $('#email').val();
    var firstName = $('#firstName').val();
    var lastName = $('#lastName').val();
    var club = $('.clublist').val();
    console.log(base_url + '/signUp/process');

    $.post(
      //Send for signUp proccess
      base_url + '/signUp/process',
      {
        'username': username,
        'password': password,
        'email': email,
        'firstName': firstName,
        'lastName': lastName,
        'club': club
      },
      function(data) {
        //Display error message if form cannot be validated succesfully
        if(data.error) {
          $('.alert a').text(data.error);
        }
        else if (data.success) {
          $('.alert a').text(data.error);
        }
      }, "json"
    );
  });

});
