$('document').ready(function () {

    new WOW().init() // init animations

    var URL  = window.location.href

    var form = $("#formReset")
    var msg = $("#msg-container")
    var alertContainer = $("#alert-container")


    form.submit(function (event) {
        event.preventDefault() // désactive le rafraichissement de la page 

        //permet d'envoyer des données
        //"function" indique une fonction à exécuter lorsque la méthode est terminée. "data" contient les données résultant de la demande ; "status" contient l'état de la demande
        $.post(URL, function (data, status) {
            var data = JSON.parse(data)
            console.log(data)
            msg.text(data.message)
            $(alertContainer).fadeIn()
            console.log(alertContainer)
        })

    });

})
