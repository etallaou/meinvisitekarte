$(function(){

    //scrollbar
    $(".navbar a, footer a").on("click", function(event){
    
        event.preventDefault();
        var hash = this.hash;
        
        $('body,html').animate({scrollTop: $(hash).offset().top} , 900 , function(){window.location.hash = hash;})
        
    });

    //form submit
    $('#contact-form').submit(function (e) {
        e.preventDefault(); //enlever le comportement par defaut lorsque je soumet un formulaire
        $('.comments').empty(); // vidage
        var postdata = $('#contact-form').serialize();
        console.log(postdata);
        $.ajax({
            type:'POST',
            url: 'php/contact.php',
            data: postdata,
            dataType: 'json',
            success: function (result) {
                console.log('success ');
                console.log(result);
                if(result.isSuccess){
                    console.log('test2');
                    $("#contact-form").append("<p class='thank-you'>" +
                        "Votre message a bien été envoyer merci de m'avoir contacté :)</p>")
                    $("#contact-form")[0].reset();
                }else {

                    $("#firstName + .comments").html(result.firstNameError);

                    $("#name + .comments").html(result.nameError);
                    ;
                    $("#email + .comments").html(result.emailError);

                    $("#phone + .comments").html(result.phoneError);

                    $("#message + .comments").html(result.messageError);


                }

            },
            error: function (e) {
                //alert('error: ' + JSON . stringify(e));
                //console.log(e);
                alert('error: ' + JSON . stringify(e));
            }
        });
    });




})