    //formulario carga firmas
    function carga(){

        if (xcuit){
            verificar.hidden = true;
            cargaFirma.hidden = false;
            cargaFirma['cuit'].value = xcuit;
            document.getElementById("titulo01").style.display = "block";
        }else{
            verificar.hidden = false;
        }

        if (cargaFirma['cuit'].value!==''){
            document.getElementById("cancelar1").style.display = "block";
        }
    }

    function chequear(){
        if (verificar['xcuit'].value !=='' && verificar['xcuit'].value.length >= 8){
            verificar.vercuit.disabled = false;
        }

    }

    function cancelar1(){

        var cancelar = confirm('Esta acción limpiará el formulario')
        if(cancelar == true){
        cargaFirma.reset();
        cargaFirma.cuit.required=false;
        cargaFirma.razonSocial.required=false;
        document.getElementById("cancelar1").style.display = "none";
        document.getElementById("msjcuit").style.display = "none";
        }

    }

    function validar(cargaFirma) {
            if (cargaFirma['cuit'].value.length == 11
            && cargaFirma['razonSocial'].value !==''
            && cargaFirma['formaJuridica'].options[cargaFirma['formaJuridica'].selectedIndex].value > 0) {
                document.getElementById("siguiente1").style.display = "block";
            }else{
                document.getElementById("siguiente1").style.display = "none";
            }
            if (cargaFirma['cuit'].value.length == 11){
                document.getElementById("msjcuit").style.display = "none";
            }else{
                document.getElementById("msjcuit").style.display = "block";
            }
            if (cargaFirma['cuit'].value.length > 1){
                document.getElementById("cancelar1").style.display = "block";
            }
        }

    function validar2(cargaFirma) {
        if (cargaFirma['telefono'].value !=='' && cargaFirma['email'].value !=='') {
            document.getElementById("siguiente2").style.display = "block";
        }
    }

    function validar3(cargaFirma) {
        if (cargaFirma['ciudad'].value !==''
        && cargaFirma['departamento'].value !==''
        && cargaFirma['provincia'].value !==''
        && cargaFirma['pais'].value !=='') {
            document.getElementById("enviar").style.display = "block";
            cargaFirma.guardar.disabled = false;
        }
    }

    function siguiente1(){
        document.getElementById("siguiente1").style.display = "none";
        document.getElementById("anterior1").style.display = "block";
        document.getElementById("titulo01").style.display = "none";
        document.getElementById("titulo02").style.display = "block";
        document.getElementById("parte1").style.display = "none";
        document.getElementById("parte2").style.display = "block";
        if (cargaFirma['telefono'].value !==''
        && cargaFirma['email'].value !=='') {
            document.getElementById("siguiente2").style.display = "block";
        }

    }

    function siguiente2(){
        document.getElementById("siguiente2").style.display = "none";
        document.getElementById("anterior1").style.display = "none";
        document.getElementById("anterior2").style.display = "block";
        document.getElementById("titulo02").style.display = "none";
        document.getElementById("titulo03").style.display = "block";
        document.getElementById("parte2").style.display = "none";
        document.getElementById("parte3").style.display = "block";
        if (cargaFirma['ciudad'].value !==''
        && cargaFirma['departamento'].value !==''
        && cargaFirma['provincia'].value !==''
        && cargaFirma['pais'].value !=='') {
            document.getElementById("enviar").style.display = "block";
            cargaFirma.guardar.disabled = false;
        }
    }

    function anterior1(){
        document.getElementById("titulo01").style.display = "block";
        document.getElementById("titulo02").style.display = "none";
        document.getElementById("siguiente1").style.display = "block";
        document.getElementById("siguiente2").style.display = "none";
        document.getElementById("anterior1").style.display = "none";
        document.getElementById("parte1").style.display = "block";
        document.getElementById("parte2").style.display = "none";

    }
    function anterior2(){
        document.getElementById("titulo02").style.display = "block";
        document.getElementById("titulo03").style.display = "none";
        document.getElementById("siguiente2").style.display = "block";
        document.getElementById("anterior2").style.display = "none";
        document.getElementById("anterior1").style.display = "block";
        document.getElementById("parte2").style.display = "block";
        document.getElementById("parte3").style.display = "none";
        document.getElementById("enviar").style.display = "none";
        cargaFirma.guardar.disabled = true;

    }

