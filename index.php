<?php

require "vendor/autoload.php";
require "constants.php";

$app = new \Slim\Slim();

$app->notFound(function() use ($app) {
    $app->render("404.html", array(), 404);
  });

$app->post("/new", function() use ($app) {
    $app->response->headers->set("Content-Type", "application/json");
    $response = array("status" => -1);

    if ($app->request->post("api_key") == GIST_API_KEY) {
      $gist_id = md5(uniqid(rand(), 1));

      if ((($fh = fopen(GISTS_DIR . "/" . $gist_id, "w")) !== false) &&
          fwrite($fh, $app->request->post("gist")) !== false) {
        $response["status"] = 1;
        $response["url"] = GIST_DOMAIN . "/" . $gist_id;
      }
    }

    $app->response->setBody(json_encode($response));
  });

$app->get("/:gist_id", function ($gist_id) use ($app) {
    $fname = GISTS_DIR . "/" . $gist_id;
    if (!is_readable($fname)) {
      $app->notFound();
    } else {
      $app->render("gist.php",
                   array("gist_id" => $gist_id,
                         "gist" => file_get_contents($fname)));
    }
  });

$app->run();