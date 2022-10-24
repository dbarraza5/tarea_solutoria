function eliminarRegistro(id){
    let token = $('meta[name="csrf-token"]').attr('content')
    console.log("eliminando registro: "+id)
    console.log(token)
    let headers = {
        'X-CSRF-TOKEN': token
    }

    $.ajax({
        headers : headers,
        type: "POST",
        url: "http://127.0.0.1/tarea_solutoria/public/eliminar",
        data: {
            "id": id
        }
    }).done(function (){
        location.reload();
    }).fail(function (){
        console.log("fallo al eliminar registro")
    });
}
