<?php
use Framework\Container;
use App\Database;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


$container = new Container;


$container->set(Database::class, function () {
    return new Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
});
// this is the file system loader classes 
$container->set(FilesystemLoader::class, function () {
    return new FilesystemLoader(BASE_PATH . "/templates");
});
$loader = $container->get(FilesystemLoader::class);
// this is the twig environment
$container->set(Environment::class, function (FilesystemLoader $loader) {
    return new Environment($loader);
});
return $container;