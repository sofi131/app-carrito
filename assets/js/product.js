$("#cart").click((e)=>{
    e.preventDefault();
    if($("#user").html()==""){
        //Hay que loguearse
        $("#modal-login").modal("show");
    }
});