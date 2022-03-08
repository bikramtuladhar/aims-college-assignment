<?php
Router::get('/', function () {
    echo "
    <h1> welcome </h1>
    <h2>Url list</h2>
    
    
    <ul>
    <li> http://localhost:8000/ <a href='http://localhost:8000/'>Home Page</a></li>
    <li> http://localhost:8000/xml <a href='http://localhost:8000/xml'>Xml to JSON</a></li>
    <li> http://localhost:8000/price-filter/higher-than/500 <a href='http://localhost:8000/price-filter/higher-than/500'>price filter list</a></li>
    <li> http://localhost:8000/price-filter/higher-than/500/sum <a href='http://localhost:8000/price-filter/higher-than/500/sum'>price filter sum</a></li>
    <li> http://localhost:8000/event <a href='http://localhost:8000/event'>action controller with validation [use postman]</a></li>
    </ul>
    
    ";
});

Router::get('/xml', function () {
    xmlToJson();
});

Router::get('/price-filter/higher-than/([0-9]*)', function ($parameter) {
    $priceList = [
        1  => 112.34,
        2  => 123.45,
        3  => 234.56,
        4  => 345.67,
        5  => 456.78,
        6  => 567.89,
        7  => 678.90,
        8  => 789.01,
        9  => 890.12,
        10 => 901.23,
    ];

    echo json_encode(higherThan($priceList, $parameter[0]));
});


Router::get('/price-filter/higher-than/([0-9]*)/sum', function ($parameter) {
    $priceList = [
        1  => 112.34,
        2  => 123.45,
        3  => 234.56,
        4  => 345.67,
        5  => 456.78,
        6  => 567.89,
        7  => 678.90,
        8  => 789.01,
        9  => 890.12,
        10 => 901.23,
    ];

    echo json_encode(sumOfHigherThan($priceList, $parameter[0]));
});


Router::post('/event', function () {
    try {
        $event = new EventController();
        $event->store();
    } catch ( Exception $e ) {
        echo json_encode(['error' => $e->getMessage()]);
    }
});
