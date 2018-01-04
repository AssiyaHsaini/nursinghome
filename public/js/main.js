var form = $("#formReset")
var msg = $("#msg-container")
console.log(msg)
// msg.css("display", "none")



form.submit(function(event){
    event.preventDefault()

    $.post("http://localhost:8888/nursinghome/admin/reset",function(data, status){
        var data = JSON.parse(data)
        console.log(data) 
        msg.text(data.message)  
        // msg.removeClass("none")
        // msg.fadeIn("")
$('.alert').alert()
        
    })
    
});
console.log(form)