//la modal
$("#cart").click((e)=>{
    
    if($("#user").html()==""){
        e.preventDefault();
        //Hay que loguearse
        $("#modal-login").modal("show");
    }
});
//pa que clique y borré
$(".quantity").change((e)=>{
    alert(e.currentTarget.value);
});

$(".delete").click((e)=>{

})