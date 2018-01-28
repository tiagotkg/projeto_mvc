$(document).ready(function(){
    
    $('.btDelete').click(function() {
        var deletar = confirm("Deseja realmente deletar esta pessoa?");

        if(!deletar) {
            return false;
        }
    });


    $('form').on('submit', function() {
        
        var nome = $('#nome').val().length;
        var sobrenome = $('#sobrenome').val().length;
        var grupos = $(this).find('input[type=checkbox]:checked').length;;
        
        if(nome > 50 || nome < 3) {
            alert('Nome de conter de 3 a 100 caracteres.');
            return false;
        } else if(sobrenome > 50 || sobrenome < 3) {
            alert('Sobrenome de conter de 3 a 100 caracteres.');
            return false;
        } else if(grupos < 2) {
            alert('Selecione ao menos 2 grupos.')
            return false;
        }

    });
       
    
});