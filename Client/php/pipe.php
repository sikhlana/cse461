<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = new \Dotenv\Dotenv(realpath(__DIR__ . '/..'));
$dotenv->load();

$definition = new \Symfony\Component\Console\Input\InputDefinition();

$definition->addArgument(new \Symfony\Component\Console\Input\InputArgument(
    'type', \Symfony\Component\Console\Input\InputArgument::REQUIRED
));

$definition->addArgument(new \Symfony\Component\Console\Input\InputArgument(
    'value', \Symfony\Component\Console\Input\InputArgument::REQUIRED
));

$input = new \Symfony\Component\Console\Input\ArgvInput(null, $definition);

$client = new \GuzzleHttp\Client([
    'headers' => [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer ' . getenv('API_KEY'),
    ],
]);

try {
    $response = $client->post('https://attendance.saifmahmud.name/api/devices/record', [
        'form_params' => [
            $input->getArgument('type') => base64_decode(trim($input->getArgument('value'))),
        ]
    ]);

    $json = json_decode($response->getBody()->getContents(), true);

    if ($response->getStatusCode() === 200) {
        ret($json['message']);
    } else {
        ret($json['message'], 'error');
    }
} catch (\GuzzleHttp\Exception\BadResponseException $e) {
    if ($e->getResponse()->getStatusCode() === 422) {
        ret('Device malfunc', 'error');
    } else if ($e->getResponse()->getStatusCode() === 400) {
        $json = json_decode($e->getResponse()->getBody()->getContents(), true);
        ret($json['message'], 'error');
    } else {
        ret('Server error', 'error');
    }
} catch (\GuzzleHttp\Exception\TransferException $e) {
    ret('Network error', 'error');
}

function ret($message, $type = 'success')
{
    echo json_encode(compact([
        'type', 'message',
    ]));

    exit;
}
