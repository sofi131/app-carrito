//la modal
$("#cart").click((e) => {

    if ($("#user").html() == "") {
        e.preventDefault();
        //Hay que loguearse
        $("#modal-login").modal("show");
    }
});
//pa que clique y borré
$(".quantity").change((e) => {
    alert(e.currentTarget.value);
});

$(".delete").click((e)=>{
  let fila=e.currentTarget.parentElement.parentElement;
  let idcartdetail=(e.currentTarget.id).replace("idcartdetail","");
  let url="delete_cart_detail.php?idcartdetail="+idcartdetail;
  fetch(url)
  .then(response => response.json())
  .then(data => {
    console.log(data); // Aquí recibes los datos en formato JSON
    // Puedes manipular los datos aquí
    fila.remove();
    let cart=data.cart;
//aquí va el map

  })
  .catch(error => {
    console.error('Error:', error);
  });
 
})