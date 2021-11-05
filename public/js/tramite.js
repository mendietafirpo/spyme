
    function cancelar1(){

        var cancelar = confirm('Esta acción limpiará el formulario')
        if(cancelar == true){
        cargatramite.reset();
        cargatramite.presentacionIdeaProy.required=false;
        document.getElementById("cancelar1").style.display = "none";
        }

    }

    function validar(cargatramite) {
        var fechapresen = new Date(cargatramite['presentacionIdeaProy'].value);

        if (fechapresen.getFullYear()>0)

             {
                document.getElementById("enviar").style.display = "block";
                cargatramite.guardar.disabled = false;
                document.getElementById("cancelar1").style.display = "block";
            }else {
                document.getElementById("enviar").style.display = "none";
                cargatramite.guardar.disabled = true;
                document.getElementById("cancelar1").style.display = "none";
            }
        }
