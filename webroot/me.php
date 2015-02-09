<?php 
/**
 * This is a Anax pagecontroller.
 *
 */

// Get environment & autoloader and the $app-object.
require __DIR__.'/config_with_app.php'; 

$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');

$app->router->add('', function() use ($app) {
	$app->theme->setTitle("My Me Page");
 
    $content = $app->fileContent->get('me.md');
	$content = $app->textFilter->doFilter($content, 'shortcode, markdown');
	$byline = $app->fileContent->get('byline.md');
	$byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
	
 
    $app->views->add('me/page', [
        'content' => $content,
		'byline' => $byline,
    ]);
 
});
 
$app->router->add('redovisning/kmom01', function() use ($app) {
	$app->theme->setTitle("Redovisning");
    $content = $app->fileContent->get('kmom01.md');
	$content = $app->textFilter->doFilter($content, 'shortcode, markdown');

 
    $app->views->add('me/page', [
        'content' => $content,
    ]);
 
});
 
$app->router->add('source', function() use ($app) {
	$app->theme->addStylesheet('css/source.css');
    $app->theme->setTitle("Källkod");
	$source = new \Mos\Source\CSource([
        'secure_dir' => '..', 
        'base_dir' => '..', 
        'add_ignore' => ['.htaccess'],
    ]);
 
    $app->views->add('me/source', [
        'content' => $source->View(),
    ]);
 
});

 
$app->router->handle();

$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');
// Render the response using theme engine.
$app->theme->render();
