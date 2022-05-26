<?php

namespace RcRenuevaFicoClientPhp\Client;

use \RcRenuevaFico\Client\Configuration;
use \RcRenuevaFico\Client\ApiException;
use \RcRenuevaFico\Client\ObjectSerializer;
use \GuzzleHttp\Client;
use \GuzzleHttp\HandlerStack as handlerStack;
use Signer\Manager\Interceptor\MiddlewareEvents;
use Signer\Manager\Interceptor\KeyHandler;
use \RcRenuevaFico\Client\Api\ReporteDeCrditoRenuevaConFicoScoreApi as Instance;
use \RcRenuevaFico\Client\Model\PersonaPeticion;
use \RcRenuevaFico\Client\Model\DomicilioPeticion;

class ReporteDeCrditoRenuevaConFicoScoreApiTest extends \PHPUnit_Framework_TestCase
{
    
     public function setUp()
    {
        $password = "KEY_PASSWORD";

        $this->keypair = '/path/keypair.p12';
        $this->cert = '/path/cdc_cert.pem';

        $this->signer = new KeyHandler($this->keypair, $this->cert, $password);

        $events = new MiddlewareEvents($this->signer);
        $handler = handlerStack::create();
        $handler->push($events->add_signature_header('x-signature'));   
        $handler->push($events->verify_signature_header('x-signature'));
        $client = new Client(['handler' => $handler]);

        $config = new Configuration();
        $config->setHost('Url');
        
        $this->apiInstance = new Instance($client, $config);
        $this->x_api_key = "your_x_api_key";
        $this->username = "username";
        $this->password = "password";

    }    
    
    
    public function testGetReporte()
    {
        try{
            $request = new PersonaPeticion();
            $domicilio = new DomicilioPeticion();

            $request->setApellidoPaterno("");
            $request->setApellidoMaterno("");
            $request->setPrimerNombre("");
            $request->setFechaNacimiento("");
            $request->setRfc("");
            $request->setNacionalidad("");
            $request->setCuenta("");

            $domicilio->setDireccion(" ");
            $domicilio->setColoniaPoblacion(" ");
            $domicilio->setDelegacionMunicipio("");
            $domicilio->setCiudad("");
            $domicilio->setEstado("");
            $domicilio->setCp("");

            $request->setDomicilio($domicilio);

            $response = $this->apiInstance->getReporte($this->x_api_key,$this->username,$this->password, $request);
            //$this->assertNotNull($response );
            print_r($response);

        }
        catch(Exception $e){
            echo 'Exception when calling ApiTest->testGetReporteRenuevaFico: ', $e->getMessage(), PHP_EOL;
        }
    }
}
