<?php
/**
 * Gestione form di contatto - Città del Cioccolato
 */

// === CONFIGURAZIONE ===
$email_destinatario = 'support@semproxlab.it';

// === ELABORAZIONE ===
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Metodo non consentito']);
    exit;
}

// Tipo di form (contatto generico o pubblicità)
$form_type = isset($_POST['form_type']) ? trim(strip_tags($_POST['form_type'])) : 'contatto';

// Sanitizza input
$nome = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : '';
$email = isset($_POST['email']) ? trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) : '';
$messaggio = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : '';
$azienda = isset($_POST['company']) ? trim(strip_tags($_POST['company'])) : '';
$telefono = isset($_POST['phone']) ? trim(strip_tags($_POST['phone'])) : '';
$budget = isset($_POST['budget']) ? trim(strip_tags($_POST['budget'])) : '';

// Validazione
$errori = [];

if (empty($nome)) {
    $errori[] = 'Il nome è obbligatorio';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errori[] = 'Email non valida';
}

// Validazione extra per form pubblicità
if ($form_type === 'pubblicita' && empty($azienda)) {
    $errori[] = 'Il nome azienda è obbligatorio';
}

if (!empty($errori)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => implode(', ', $errori)]);
    exit;
}

// Prepara email in base al tipo di form
if ($form_type === 'pubblicita') {
    $oggetto_email = '[PUBBLICITA] Richiesta da ' . $azienda;
    $corpo = "=== NUOVA RICHIESTA PUBBLICITA ===\n\n";
    $corpo .= "Azienda: $azienda\n";
    $corpo .= "Referente: $nome\n";
    $corpo .= "Email: $email\n";
    if (!empty($telefono)) {
        $corpo .= "Telefono: $telefono\n";
    }
    if (!empty($budget)) {
        $corpo .= "Budget indicativo: $budget\n";
    }
    $corpo .= "\nMessaggio:\n$messaggio\n";
    $corpo .= "\n---\nInviato dal form Pubblicità";
} else {
    $oggetto_email = '[CONTATTO] Messaggio da ' . $nome;
    $corpo = "=== NUOVO MESSAGGIO ===\n\n";
    $corpo .= "Nome: $nome\n";
    $corpo .= "Email: $email\n";
    $corpo .= "\nMessaggio:\n$messaggio\n";
    $corpo .= "\n---\nInviato dal form di contatto";
}

$headers = [
    'From: noreply@cittadelcioccolato.it',
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion(),
    'Content-Type: text/plain; charset=UTF-8'
];

// Invia email
$inviato = mail($email_destinatario, $oggetto_email, $corpo, implode("\r\n", $headers));

if ($inviato) {
    echo json_encode(['success' => true, 'message' => 'Messaggio inviato con successo! Ti risponderemo al più presto.']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Errore nell\'invio. Riprova più tardi.']);
}
