<?php

session_start();
require_once dirname(__DIR__) . '/vendor/autoload.php';
$urlParams = explode('/',substr($_SERVER["REDIRECT_URL"],1));
$page = !empty($urlParams[0])?array_shift($urlParams):'home';

$twigFile ='index.html.twig';
$twigOptions =['page'=>$page];

//var_dump(["urlParams"=>$urlParams,"page"=>$page]);

$_SESSION["username"] = !empty($_POST['username'])
    ?$_POST['username']
    :(isset($_SESSION["username"]) ? $_SESSION["username"] : null);


// rooting and twig templates
$loader = new \Twig\Loader\FilesystemLoader(dirname(__DIR__) .'/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false ,//  dirname(__DIR__) .'/temp/templates/',
]);
try {
    switch ($page){
        case  'chat':
            $labelRoom = !empty($urlParams[0]) && !empty(trim($urlParams[0]))?array_shift($urlParams):null;

            $params =$urlParams;
            $twigOptions = [
                'page'=>$page,
                'name'=>$_SESSION["username"],
                'params' => $urlParams
            ];
            $twigFile= 'chat/index.html.twig';
            break;
        case 'quit':
            //unset($_SESSION["username"]);
            session_destroy();
            header("Location:/");
            break;
        case  'home':
            $twigFile= 'index.html.twig';
            $twigOptions =['page'=>$page];
            break;
        default:

            break;
    }
    echo $twig->render($twigFile, $twigOptions);
} catch (\Twig\Error\LoaderError $e) {
    echo $e->getMessage();
} catch (\Twig\Error\RuntimeError $e) {
    echo $e->getMessage();
} catch (\Twig\Error\SyntaxError $e) {
    echo $e->getMessage();
}

