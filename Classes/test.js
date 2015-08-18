$(document).ready(function () {

    // process the form
    $('form').submit(function (event) {

        $('.form-group').removeClass('has-error'); // remove the error class
        $('.help-block').remove(); // remove the error text

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'empno': $('input[name=empno]').val(),
            'name': $('input[name=name]').val(),
            'company': $('input[name=company]').val(),
            'department': $('input[name=department]').val(),
            'corporatetitle': $('input[name=corporatetitle]').val(),
            'dialogdeductions': $('input[name=dialogdeductions]').val()
        };

        // process the form
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: 'validateRequestHandler.php', // the url where we want to POST
            data: {message:"as",header:"EMP No"}// our data object
        }).done(function( html ) {
    alert(html);
  });
     /*           // using the done promise callback
                .done(function (data) {

                    // log data to the console so we can see
                    console.log(data);

                    // here we will handle errors and validation messages
                    if (!data.success) {

                        // handle errors for name ---------------
                        if (data.errors.empno) {
                            $('#empno').addClass('has-error'); // add the error class to show red input
                            $('#empno').append('<div class="help-block">' + data.errors.empno + '</div>'); // add the actual error message under our input
                        }

                        // handle errors for email ---------------
                        if (data.errors.name) {
                            $('#name').addClass('has-error'); // add the error class to show red input
                            $('#name').append('<div class="help-block">' + data.errors.name + '</div>'); // add the actual error message under our input
                        }

                        // handle errors for superhero alias ---------------
                        if (data.errors.company) {
                            $('#company').addClass('has-error'); // add the error class to show red input
                            $('#company').append('<div class="help-block">' + data.errors.company + '</div>'); // add the actual error message under our input
                        }

                        if (data.errors.department) {
                            $('#department').addClass('has-error'); // add the error class to show red input
                            $('#department').append('<div class="help-block">' + data.errors.department + '</div>'); // add the actual error message under our input
                        }
                        if (data.errors.corporatetitle) {
                            $('#corporatetitle').addClass('has-error'); // add the error class to show red input
                            $('#corporatetitle').append('<div class="help-block">' + data.errors.corporatetitle + '</div>'); // add the actual error message under our input
                        }
                        if (data.errors.dialogdeductions) {
                            $('#dialogdeductions').addClass('has-error'); // add the error class to show red input
                            $('#dialogdeductions').append('<div class="help-block">' + data.errors.dialogdeductions + '</div>'); // add the actual error message under our input
                        }

                    } else {

                        // ALL GOOD! just show the success message!
                        $('form').append('<div class="alert alert-success">' + data.message + '</div>');

                        // usually after form submission, you'll want to redirect
                        // window.location = '/thank-you'; // redirect a user to another page

                    }
                })

                // using the fail promise callback
                .fail(function (data) {

                    // show any errors
                    // best to remove for production
                    console.log(data);
                });
*/
        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

});
