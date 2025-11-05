document.addEventListener('DOMContentLoaded', function () {
    // Agrega asterísco rojo a los <label> de inputs required.
    document.querySelectorAll('input[required],select[required],textarea[required]').forEach(function (input) {
        let label = input.previousElementSibling;
        if (!label || label.tagName !== 'LABEL') {
            label = input.closest('.form-group').querySelector('label');
        }
        if (label && label.tagName === 'LABEL') {
            label.innerHTML += ' <span class="text-danger fw-bold">*</span>';
        }
    });
    // Creación de Tooltips de Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl,{
            html: true // Permitir HTML dentro del tooltip
        })
    });

    // Creación de PopOvers de Bootstrap
    var popOverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    popOverTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Popover(tooltipTriggerEl, {
            trigger: 'focus',
            html: true // Permitir HTML dentro de PopOvers
        })
    });

    // Crea un div .invalid-feedback seguido de todos los inputs,selects,text-area
    document.querySelectorAll('input,textarea,select').forEach(function(input) {
        if(!input.role){
            let nextElement = input.nextElementSibling;
            /* Crea el div si no existe */
            if (!nextElement || !nextElement.classList.contains('invalid-feedback')) {
                const invalidFeedback = document.createElement('div');
                invalidFeedback.classList.add('invalid-feedback');
                input.parentNode.appendChild(invalidFeedback);
            }
            // Agrega maxlength a inputs de tipo texto, 255 por default.
            if (input.type === 'text'&& !input.maxLength) {
                input.setAttribute('maxlength', '255');
            }
            // Agrega maxlength a textareas, 1700 por default.
            if (input.tagName.toLowerCase() === 'textarea' && !input.maxLength) {
                input.setAttribute('maxlength', '1700');
            }
        }
    });

    //Función para devolver un mensaje de la invalidez de un input.
    function tipoValidacion(inputInvalido) {
        if (inputInvalido.validity.valueMissing)
            return 'Dato obligatorio.';

        if (inputInvalido.validity.tooLong)
            return "El límite de caracteres debe ser menor o igual a "+inputInvalido.maxLength+".";

        if (inputInvalido.validity.tooShort)
            return "El mínimo de caracteres es de "+inputInvalido.minLength+".";

        if (inputInvalido.validity.rangeOverflow){
            if (inputInvalido.type === 'date')
                return `La fecha debe ser menor o igual a ${inputInvalido.max}.`;
            return "El mayor permitido es de "+inputInvalido.max+".";
        }

        if (inputInvalido.validity.rangeUnderflow){
            if (inputInvalido.type === 'date')
                return `La fecha debe ser mayor o igual a ${inputInvalido.min}.`;
            return "El menor permitido es de "+inputInvalido.min+".";
        }

        if (inputInvalido.validity.typeMismatch) {
            if (inputInvalido.type === 'email')
                return 'Correo electrónico inválido.';
            if (inputInvalido.type === 'date')
                return 'Fecha inválida.';
            if (inputInvalido.type === 'time')
                return 'Hora inválida.';
            return 'Tipo de dato incorrecto.';
        }

        if(inputInvalido.validity.patternMismatch)
            return inputInvalido.title ? inputInvalido.title : 'Campo inválido.';

        return inputInvalido.title??'Campo inválido.';
    }

    // Agrega validación de bootstrap a formularios utilizando la clase was-validated
    var forms = document.querySelectorAll('.needs-validation');
    if(forms.length>0)
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    let btn = form.querySelector("button[type=submit]") ?? document.querySelector(`button[form=${form.id}]`);
                    let tituloBtn = '';
                    if(btn){
                        tituloBtn = btn.innerHTML;
                        btn.innerHTML = 'Enviando...';
                        btn.classList.add('disabled');
                    }
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                        if(btn){
                            setTimeout(function () {
                                btn.classList.remove('disabled');
                                btn.innerHTML = tituloBtn;
                            }, 200);
                        }
                        const primerInvalido = form.querySelector(":invalid");
                        if (primerInvalido){
                            //Scroll al primer input inválido
                            primerInvalido.scrollIntoView({ behavior: "smooth", block: "center" });
                            primerInvalido.focus();
                        }
                        var inputsInvalidos = form.querySelectorAll(':invalid');
                        inputsInvalidos.forEach(function (inputInvalido) {
                            var invalidFeedbacks = inputInvalido.closest('.form-group,.input-group').querySelectorAll('.invalid-feedback');
                            invalidFeedbacks.forEach(function(el){
                                //Agrega el mensaje de validación al div .invalid-feedback
                                el.textContent = tipoValidacion(inputInvalido);
                                el.style.removeProperty('display');
                            });
                        });
                    }
                    form.classList.add('was-validated')
                }, false)
            });
});
