<?php

function cadastra_newsletter()
{
    if (isset($_REQUEST)) {
        $nome = trim($_REQUEST["nome"]);
        $email = trim($_REQUEST["email"]);
        $estado = trim($_REQUEST["estado"]);
        $cidade = trim($_REQUEST["cidade"]);

        $data = array();

        $flag = true;

        if ( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $flag = false;
            $erros["email"] = "E-mail inválido.";
        }

        if ($flag) {
            global $wpdb;

            // Pesquisa a sigla do estado
            $estado = $wpdb->get_var( $wpdb->prepare( "SELECT sigla FROM cp_estados WHERE id = %s", $estado ) );

            // Pesquisa o nome da cidade
            $cidade = $wpdb->get_var( $wpdb->prepare( "SELECT nome FROM cp_cidades WHERE id = %s", $cidade ) );

            $table_name = $wpdb->prefix . 'newsletter';

            // Pesquisa se o email já está cadastrado
            $select = $wpdb->query($wpdb->prepare("SELECT * FROM $table_name WHERE email=%s", $email));

            if ( ! $select) {
                $insert = $wpdb->insert($table_name, array(
                    'nome'   => $nome,
                    'email'  => $email,
                    'estado'  => $estado,
                    'cidade'  => $cidade,
                ));

                if ($insert) {
                    $data['status'] = true;
                    $data['msg'] = 'Cadastrado com sucesso';
                } else {
                    $data['status'] = false;
                    $data['msg'] = 'Ocorreu um erro ao cadastrar. Tente novamente mais tarde.';
                }
            } else {
                $data['status'] = false;
                $data['msg'] = 'E-mail já cadastrado.';
            }
        } else {
            $data['status'] = false;
            $data['msg'] = 'Por favor, digite o seu e-mail.';
        }
    }

    wp_send_json($data);

    die();
}

add_action('wp_ajax_nopriv_cadastra_newsletter', 'cadastra_newsletter');
add_action('wp_ajax_cadastra_newsletter', 'cadastra_newsletter');
