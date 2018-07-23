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
        'form_data' => [
            $input->getArgument('type') => base64_decode($input->getArgument('value')),
        ]
    ]);

    $json = json_decode($response->getBody()->getContents());

    if ($response->getStatusCode() === 200) {
        ret($json['message']);
    } else {
        ret($json['message'], 'error');
    }
} catch (\GuzzleHttp\Exception\TransferException $e) {
    ret('Network error', 'error');
}

if (! function_exists('ret')) {
    function ret($message, $type = 'success')
    {
        echo json_encode(compact([
            'type', 'message',
        ]));

        exit;
    }
}