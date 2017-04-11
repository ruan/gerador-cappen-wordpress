jQuery(document).ready(function($) {
    jQuery('.form-news').find('input[type=submit]').click(function() {
        var form = $(this.form);
        var nome = form.find('input[name=nome]').val();
        var email = form.find('input[name=email]').val();
        var estado = form.find('select[name=estado]').val();
        var cidade = form.find('input[name=cidade]').val();

        var flag = true;

        if (email == "") {
            flag = false;
            form.find('input[name=email]').focus();
        }

        if (flag == true) {
            $.ajax({
                url: ajaxurl,
                data: "action=cadastra_newsletter&" + form.serialize(),
                success: function(data) {
                    if (data == 'true') {
                        alert('Cadastrado com sucesso.');
                        $(form)[0].reset();
                    } else if (data == 'erro-campos') {
                        alert('Por favor, digite o seu e-mail.');
                    } else if (data == 'erro-duplicado') {
                        alert('E-mail já cadastrado.');
                        $(form)[0].reset();
                    } else if (data == 'erro-inserir') {
                        alert('Ocorreu um erro ao cadastrar. Tente novamente mais tarde.');
                    }
                },
                error: function(errorThrown) {
                    console.log(errorThrown);
                }
            });
        } else {
            alert('Preencha os campos obrigatórios');
        }

        return false;
    });
});
