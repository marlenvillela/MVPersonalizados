<?php
namespace App\Controllers;

use App\Core\Controller;

class PaymentsController extends Controller {

    private $clientId;
    private $secret;
    private $mode;
    
    public function __construct() {
        $this->clientId = $_ENV["PAYPAL_CLIENT_ID"];
        $this->secret = $_ENV["PAYPAL_SECRET"];
        $this->mode = $_ENV["PAYPAL_MODE"] ?? "sandbox";
    }
    // Integracion de fernando, revisar checkout 
    private function getAccessToken() {

        $url = $this->mode === "live" 
                ? "https://api.paypal.com/v1/oauth2/token"
                : "https://api.sandbox.paypal.com/v1/oauth2/token";

        $basicAuth = base64_encode($this->clientId . ":" . $this->secret);

        $response = $this->curl($url, "grant_type=client_credentials", [
            "Authorization: Basic $basicAuth",
            "Content-Type: application/x-www-form-urlencoded"
        ]);

        return $response->access_token ?? null;
    }
    // Crear orden de pago
    public function createOrder() {

        $accessToken = $this->getAccessToken();

        $input = json_decode(file_get_contents("php://input"), true);
        $total = $input["total"] ?? 0;

        $url = $this->mode === "live" 
            ? "https://api.paypal.com/v2/checkout/orders"
            : "https://api.sandbox.paypal.com/v2/checkout/orders";

        $body = json_encode([
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "amount" => [
                    "currency_code" => "USD",
                    "value" => $total
                ]
            ]]
        ]);

        $response = $this->curl($url, $body, [
            "Authorization: Bearer $accessToken",
            "Content-Type: application/json"
        ]);

        echo json_encode($response);
    }
    // Capturar orden de pago
    public function captureOrder() {

        $accessToken = $this->getAccessToken();

        $input = json_decode(file_get_contents("php://input"), true);
        $orderId = $input["orderID"] ?? null;

        $url = ($this->mode === "live"
            ? "https://api.paypal.com"
            : "https://api.sandbox.paypal.com") 
            . "/v2/checkout/orders/$orderId/capture";

        $response = $this->curl($url, "{}", [
            "Authorization: Bearer $accessToken",
            "Content-Type: application/json"
        ]);

        echo json_encode($response);
    }
    // Función auxiliar para hacer solicitudes cURL
    private function curl($url, $body = null, $headers = []) {

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($body !== null) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        $error = curl_error($ch);

        curl_close($ch);

        if ($error) {
            return (object)["curl_error" => $error];
        }

        return json_decode($result);
    }
}
