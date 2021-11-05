//utiles
    //document.getElementsByClassName('class_name')[whole_number].value
    // document.querySelector('selector').value
    //document.getElementById('check1').checked
    // name.options[select.selectedIndex].value

/*function sendForm() {
  var valido = false; //DEBERIAS REALIZAR LAS VALIDACIONES
  alert("ENTRO SEND");
  alert("valido: " + valido);
  if (valido) {
    document.getElementById("myForm").submit();
  } else {
    alert("VALIDA LOS CAMPOS");
    return false;
  }
}*/

    function carga(){
        document.getElementById("parte1").style.display = "block";
        document.getElementById("titulo01").style.display = "block";
    }

    function cancelar1(){

        var cancelar = confirm('Esta acción limpiará el formulario')
        if(cancelar == true){
        cargaProyecto.reset();
        cargaProyecto.cuit.required=false;
        cargaProyecto.razonSocial.required=false;
        document.getElementById("cancelar1").style.display = "none";
        document.getElementById("msjcuit").style.display = "none";
        }

    }

    function validar(cargaProyecto) {
            var fecha = new Date(cargaProyecto['fechaReferencia'].value);

            if (fecha.getFullYear()>0
            && cargaProyecto['nombreProyecto'].value !==''
            && cargaProyecto['bienesQueProduce'].value !==''
            && cargaProyecto['garantiasOfrecidas'].value !=='') {
                document.getElementById("siguiente1").style.display = "block";
            }else{
                document.getElementById("siguiente1").style.display = "none";
            }
        }

    function validar2(cargaProyecto) {
        const texMonInv = "ver que da";
        if (cargaProyecto['destinoFondos'].value !==''
        && cargaProyecto['montoTotal'].value !==''
        && cargaProyecto['inversionTotal'].value !=='') {
            document.getElementById("siguiente2").style.display = "block";
        }else{
            document.getElementById("siguiente2").style.display = "none";
        }
    }

    function monInversion(cargaProyecto){
        var monInv =  cargaProyecto['montoTotal'].value / cargaProyecto['inversionTotal'].value;
        if (monInv >= 0.8){
            cargaProyecto['relMonInv'].hidden=false;
            cargaProyecto['relMonInv'].value = 'relación monto -  inversión: ' + parseFloat(monInv * 100).toFixed(2) + "%";
        }else {
            cargaProyecto['relMonInv'].value = null;
            cargaProyecto['relMonInv'].hidden=true;
        }
    }

    function validar3(cargaProyecto) {
        if (//cargaProyecto['ciiuCs'].options[cargaProyecto['ciiuCs'].selectedIndex].value !== null
        cargaProyecto['moneda'].options[cargaProyecto['moneda'].selectedIndex].value !== null
        && cargaProyecto['tipodeCambio'].value > 0) {
            document.getElementById("siguiente3").style.display = "block";
            document.getElementById("enviar").style.display = "block";
            cargaProyecto.guardar.disabled = false;
        }
    }

    function siguiente1(){
        document.getElementById("siguiente1").style.display = "none";
        document.getElementById("anterior1").style.display = "block";
        document.getElementById("titulo01").style.display = "none";
        document.getElementById("titulo02").style.display = "block";
        document.getElementById("parte1").style.display = "none";
        document.getElementById("parte2").style.display = "block";
        if (cargaProyecto['destinoFondos'].value !==''
        && cargaProyecto['montoTotal'].value !==''
        && cargaProyecto['inversionTotal'].value !=='') {
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
        if (//cargaProyecto['ciiuCs'].options[cargaProyecto['ciiuCs'].selectedIndex].value !== null
        cargaProyecto['moneda'].options[cargaProyecto['moneda'].selectedIndex].value !== null
        && cargaProyecto['tipodeCambio'].value > 0) {
            document.getElementById("enviar").style.display = "block";
            document.getElementById("siguiente3").style.display = "block";
            cargaProyecto.guardar.disabled = false;
        }
    }

    function siguiente3(){
        document.getElementById("siguiente3").style.display = "none";
        document.getElementById("anterior2").style.display = "none";
        document.getElementById("anterior3").style.display = "block";
        document.getElementById("titulo03").style.display = "none";
        document.getElementById("titulo04").style.display = "block";
        document.getElementById("parte3").style.display = "none";
        document.getElementById("parte4").style.display = "block";

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
        cargaProyecto.guardar.disabled = true;
        document.getElementById("siguiente3").style.display = "none";
    }
    function anterior3(){
        document.getElementById("titulo03").style.display = "block";
        document.getElementById("titulo04").style.display = "none";
        document.getElementById("siguiente3").style.display = "block";
        document.getElementById("anterior3").style.display = "none";
        document.getElementById("anterior2").style.display = "block";
        document.getElementById("parte3").style.display = "block";
        document.getElementById("parte4").style.display = "none";
    }


function pegarciiu(){
    cargaProyecto['ciiuCs'].value = localStorage.getItem("miciiu");
}
