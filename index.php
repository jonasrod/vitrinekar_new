<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use App\Models\Entity\Manufacture;

require 'bootstrap.php';


/**
 * Lista de todos as Montadoras
 * @request curl -X GET http://localhost:8000/manufactures
 */
$app->get('/manufactures', function (Request $request, Response $response) use ($app) {
    $entityManager = $this->get('em');
    $manufatctureRepository = $entityManager->getRepository('App\Models\Entity\Manufacture');
    $manufactures = $manufatctureRepository->findAll();
    $return = $response->withJson($manufactures, 200, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE)
        ->withHeader('Content-type', 'application/json;charset=utf-8');
    return $return;
});

/**
 * Retornando mais informações da montadora pelo id
 * @request curl -X GET http://localhost:8000/manufactures/{id}
 */
$app->get('/manufactures/{id}', function (Request $request, Response $response) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');
    $entityManager = $this->get('em');
    $manufacturesRepository = $entityManager->getRepository('App\Models\Entity\Manufacture');
    $manufacture = $manufacturesRepository->find($id);
    $return = $response->withJson($manufacture, 200)
        ->withHeader('Content-type', 'application/json;charset=utf-8');
    return $return;
});

/**
 * Cadastra uma nova Montadora
 * @request curl -X POST http://localhost:8000/manufactures -H "Content-type: application/json" -d '{"name":"Volks", "main":"1"}'
 */
$app->post('/manufactures', function (Request $request, Response $response) use ($app) {
    $params = (object) $request->getParams();
    /**
     * Pega o Entity Manager do Container
     */
    $entityManager = $this->get('em');

    /**
     * Instância da a Entidade preenchida com os parametros do post
     */
    $manufacture = (new Manufacture())->setName($params->name)
        ->setMain($params->main);

    /**
     * Persiste a entidade no banco de dados
     */
    $entityManager->persist($manufacture);
    $entityManager->flush();
    $return = $response->withJson($manufacture, 201)
        ->withHeader('Content-type', 'application/json;charset=utf-8');
    return $return;
});


/**
 * Atualiza os dados de uma Montadora
 * @request curl -X PUT http://localhost:8000/manufactures/{id} -H "Content-type: application/json" -d '{"name":"Volks", "main":""}'
 */
$app->put('/manufactures/{id}', function (Request $request, Response $response) use ($app) {
    /**
     * Pega o ID da Montadora informado na URL
     */
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');
    /**
     * Encontra a Montadora no Banco
     */
    $entityManager = $this->get('em');
    $manufactureRepository = $entityManager->getRepository('App\Models\Entity\Manufacture');
    $manufacture = $manufactureRepository->find($id);
    /**
     * Atualiza e Persiste a Montadora com os parâmetros recebidos no request
     */
    $manufacture->setName($request->getParam('name'))
        ->setMain($request->getParam('main'));
    /**
     * Persiste a entidade no banco de dados
     */
    $entityManager->persist($manufacture);
    $entityManager->flush();

    $return = $response->withJson($manufacture, 200)
        ->withHeader('Content-type', 'application/json;charset=utf-8');
    return $return;
});

/**
 * Deleta o livro informado pelo ID
 * @request curl -X DELETE http://localhost:8000/manufactures/{id}
 */
$app->delete('/manufactures/{id}', function (Request $request, Response $response) use ($app) {
    /**
     * Pega o ID da Montadora informado na URL
     */
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');
    /**
     * Encontra a Montadora no Banco
     */
    $entityManager = $this->get('em');
    $manufacturesRepository = $entityManager->getRepository('App\Models\Entity\Manufacture');
    $manufacture = $manufacturesRepository->find($id);
    /**
     * Remove a entidade
     */
    $entityManager->remove($manufacture);
    $entityManager->flush();
    $return = $response->withJson(['msg' => "Deletando a Montadora {$id}"], 204)
        ->withHeader('Content-type', 'application/json;charset=utf-8');
    return $return;
});


$app->run();
