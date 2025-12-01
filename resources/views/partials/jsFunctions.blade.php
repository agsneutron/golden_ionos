<script>

    $(document).ready(function() {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "showDuration": "400",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            //"showMethod": "fadeIn",
            "showMethod": "slideDown",
            //"hideMethod": "fadeOut",
            "hideMethod": "slideUp"
        }
    });

    function alertaWarning(titulo,mensaje){
        toastr.warning(mensaje,titulo);
    }
    function alertaError(titulo,mensaje){
        toastr.error(mensaje,titulo);
    }
    function alertaSuccess(titulo,mensaje){
        toastr.success(mensaje,titulo);
    }
    function alertaInfo(titulo,mensaje){
        toastr.info(mensaje,titulo);
    }

    function resetForm(id){
        $('#'+id).trigger("reset");
    }

    function numeroEntero(event) {
        var charCode = (event.which) ? event.which : event.keyCode;

        if ((charCode < 58 && charCode > 47) || (charCode < 105 && charCode > 96) || charCode==8) {

        }else{
            event.preventDefault();
        }
    }

    $.fn.serializeFormJSON = function () {

        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

    function sinCaracteresEspeciales(e) {
        tecla = (document.all) ? e.keyCode : e.which;

        //Tecla de retroceso para borrar, siempre la permite
        if (tecla == 8) {
            return true;
        }

        // Patron de entrada, en este caso solo acepta numeros y letras
        patron = /[A-Za-z0-9]/;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
    }


    function contarCaracteres(texto,caracter){
        var cantidad = 0;
        var textoArray = new Array(texto);
        for(i=0; i < texto.length; i++){
            if(texto.charAt(i) === caracter){
                cantidad++;
            }
        }
        return cantidad;
    }


</script>