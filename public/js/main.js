$('document').ready(function () {

    new WOW().init() // init animations

    var URL_MAC      = "http://localhost:8888/nursinghome/"
    var URL_WINDOWS  = "http://localhost/nursinghome/"

    var form = $("#formReset")
    var msg = $("#msg-container")
    var alertContainer = $("#alert-container")


    form.submit(function (event) {
        event.preventDefault()

        $.post(URL_WINDOWS  + "admin/reset", function (data, status) {
            var data = JSON.parse(data)
            console.log(data)
            msg.text(data.message)
            $(alertContainer).fadeIn()
            console.log(alertContainer)
        })

    });

})
