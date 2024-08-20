<?php
function dd(mixed $data): void
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die();
}


function sanitize(string $data): string
{
    return htmlspecialchars(stripslashes(trim($data)));
}

function flash($key, $message = null)
{
    // If a message is passed in, set it
    if ($message) {
        $_SESSION['flash'][$key] = $message;
    }
    // If no message is passed in, get and delete the message
    else if (isset($_SESSION['flash'][$key])) {
        $message = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $message;
    }
}

function get_base_url() {
    $domainName = "http://".$_SERVER['HTTP_HOST'];
    $requestUri = $_SERVER['REQUEST_URI'];
    $baseUri = str_replace(basename($requestUri), '', $requestUri);
    return $domainName . $baseUri;
}
?>