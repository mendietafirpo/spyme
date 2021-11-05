
    function cancelar1(){

        var cancelar = confirm('Esta acción limpiará el formulario')
        if(cancelar == true){
        cargaexpte.reset();
        cargaexpte.operatoriaPrograma.required=false;
        cargaexpte.agenteFinanciero.required=false;
        cargaexpte.sucursalVentanilla.required=false;
        cargaexpte.evaluadorTecnico.required=false;
        document.getElementById("cancelar1").style.display = "none";
        }

    }

    function validar(cargaexpte) {
        if (cargaexpte['operatoriaPrograma'].value !== ''
            && cargaexpte['agenteFinanciero'].value !== ''
            && cargaexpte['sucursalVentanilla'].value !== ''
            && cargaexpte['evaluadorTecnico'].value !== '')

             {
                document.getElementById("enviar").style.display = "block";
                cargaexpte.guardar.disabled = false;
                document.getElementById("cancelar1").style.display = "block";
            }else {
                document.getElementById("enviar").style.display = "none";
                cargaexpte.guardar.disabled = true;
                document.getElementById("cancelar1").style.display = "none";
            }
        }

