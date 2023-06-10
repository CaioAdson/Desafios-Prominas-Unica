<?php

session_start();
include_once ('../dao/LeadsDao.php');

$leadsDao = LeadsDao::getInstance();

if (isset($_POST['save'])) {
    $lead = array(
        'nome' => $_POST['nome'],
        'whatsapp' => $_POST['telefone'],
        'email' => $_POST['email'],
        'curso_interesse' => $_POST['area']
    );


    $result = $leadsDao->insert($lead);


    if ($result) {
        $_SESSION['success'] = 'Lead inserido com sucesso.';
        header('Location: ../view/leads.php');
        exit();
    } else {
        $_SESSION['error'] = 'Falha ao inserir Lead.';
        header('Location: ../view/leads.php');
        exit();
    }
}


if (isset($_POST['edit'])) {
    $lead = array(
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'cidade' => $_POST['cidade'],
        'curso_interesse' => $_POST['curso_interesse'],
        'whatsapp' => $_POST['telefone'],
        'id' => $_POST['id_lead_editar']
    );
    
    $result = $leadsDao->update($lead);

    if ($result) {
        $_SESSION['success'] = 'Lead atualizado com sucesso.';
        header('Location: ../view/leads.php');
        exit();
    } else {
        $_SESSION['error'] = 'Falha ao atualizar Lead.';
        header('Location: ../view/leads.php');
        exit();
    }

}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    
    $result = $leadsDao->delete($id);

    if ($result) {
        $_SESSION['success'] = 'Lead excluido com sucesso.';
        header('Location: ../view/leads.php');
        exit();
    } else {
        $_SESSION['error'] = 'Falha ao excluir o Lead.';
        header('Location: ../view/leads.php');
        exit();
    }
    
}


