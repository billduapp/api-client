# api-client
API client for billdu.com, minifaktura.sk, minifaktura.cz, minirechnung.at and minirechnung.de

stability: dev

## installation

   ````
   composer require iinvoices/api-client:dev-master
   ````
 or require loader.php from package root directory

 ## usage

 first we need to initialize the client like this

 ````
 $client = iInvoices\Api\ApiClient(http://api.billdu.com, $publicKey, $privateKey);
 ````

 the client has 4 available resources: Clients, Products, Orders, Invoices you can acces them like this
 ````
$client->clients;
$client->products;
$client->orders;
$client->invoices;
 ````

all have these methods

````
public function listAll();
public function get($id);
public function create($data);
public function update($id, $data);
public function delete($id);
````
invoices and order have these extra methods

````
public function download($id);
public function send($id, $data);
public function getDownloadLink($id);
````

send method is used like this:
````
$data = [
    	'subject' => 'invoice',
    	'message' => 'hi, please pay',
    	'recipients' => [
    		'email@example.com'
    	]
    ];

	$clienti->invoices->send($id, $data);
````
