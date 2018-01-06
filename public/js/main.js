$('document').ready(function () {

    new WOW().init() // init animations

    var URL  = "http://localhost:8888/nursinghome/" // MAC
    // var URL  = "http://localhost/nursinghome/" // WINDOWS

    var form = $("#formReset")
    var msg = $("#msg-container")
    var alertContainer = $("#alert-container")


    form.submit(function (event) {
        event.preventDefault()

        $.post(URL  + "admin/reset", function (data, status) {
            var data = JSON.parse(data)
            console.log(data)
            msg.text(data.message)
            $(alertContainer).fadeIn()
            console.log(alertContainer)
        })

    });

})
