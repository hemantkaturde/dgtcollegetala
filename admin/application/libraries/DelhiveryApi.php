<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

// this libraray class is used for getting all order related data from delivery partner 
class DelhiveryApi{
    // this api is used for Search pincods for perticular region
    public function searchPincodeAvailability($pincode)
    {
        $curl    = curl_init();
        $url     = "https://track.delhivery.com//c/api/pin-codes/json/?token=9310a07855e5eb10fb071b68acd5eeebdc8c84c2&filter_codes=".$pincode;
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_POSTFIELDS =>"",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json"
          ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        print_r(json_encode($response));
    }

     // this api is used for place order to delivery partner API
     public function placeOrder($params)
     {

      /* Customer Details*/
      $customer_name= isset($params['customer_name']) ? $params['customer_name']:'';
      $address_type= isset($params['address_type']) ? $params['address_type']:'';
      $customer_address= isset($params['customer_address']) ? $params['customer_address']:'';
      $destination_city= isset($params['destination_city']) ? $params['destination_city']:'';
      $destination_state= isset($params['destination_state']) ? $params['destination_state']:'';
      $destination_district= isset($params['destination_district']) ? $params['destination_district']:'';
      $destination_country= isset($params['destination_country']) ? $params['destination_country']:'';
      $destination_pincode= isset($params['destination_pincode']) ? $params['destination_pincode']:'';
      $phone= isset($params['phone']) ? $params['phone']:'';
      $payment_mode  = isset($params['package_type']) ? $params['package_type']:'';
      $shipping_mode  = isset($params['shipping_mode']) ? $params['shipping_mode']:'';
      /* Seller Details*/
      $seller_name   = isset($params['seller_name']) ? $params['seller_name']:'';
      $seller_address   = isset($params['seller_address']) ? $params['seller_address']:'';
      $seller_GSTIN   = isset($params['seller_GSTIN']) ? $params['seller_GSTIN']:'';
      /* Order Details*/
      $order_number  = isset($params['order_number']) ? $params['order_number']:time();
      $invoice_number  = isset($params['invoice_number']) ? $params['invoice_number']:'';
      $product_description  = isset($params['product_description']) ? $params['product_description']:'';
      $order_value  = isset($params['order_value']) ? $params['order_value']:'';
      $tax_percentage_value  = isset($params['tax_percentage_value']) ? $params['tax_percentage_value']:'';
      $total_order_value  = isset($params['total_order_value']) ? $params['total_order_value']:'';
      $weight_value        = isset($params['weight_value']) ? $params['weight_value']:'';
      $weight_unit   = isset($params['weight_unit']) ? $params['weight_unit']:'gm';
      $package_length = isset($params['package_length']) ? $params['package_length']:'';
      $package_width  = isset($params['package_width']) ? $params['package_width']:'';
      $package_height = isset($params['package_height']) ? $params['package_height']:'';
      $package_breadth = isset($params['package_breadth']) ? $params['package_breadth']:'';
      $package_unit = isset($params['package_unit']) ? $params['package_unit']:'';
      $cod_collect   = isset($params['cod_collect']) ? $params['cod_collect']:'';
      /*Pickup Details*/
      $pickup_address  = isset($params['pickup_address']) ? $params['pickup_address']:'';
      $pickup_detail_address = isset($params['pickup_detail_address']) ? $params['pickup_detail_address']:'';
      $pickup_country = isset($params['pickup_country']) ? $params['pickup_country']:'';
      $pickup_state = isset($params['pickup_state']) ? $params['pickup_state']:'';
      $pickup_city   = isset($params['pickup_city']) ? $params['pickup_city']:'';
      $pickup_pincode   = isset($params['pickup_pincode']) ? $params['pickup_pincode']:'';
      $pickup_contact_no   = isset($params['pickup_contact_no']) ? $params['pickup_contact_no']:'';

      $fragile= isset($params['fragile']) ? $params['fragile']:'';

        $ch = curl_init();
        $post = 'format=json&data={
          "shipments": [{
              "name": "'.$customer_name.'",
              "order": "'.$order_number.'",
              "order_date": "'.date('Y-m-d').'",
              "payment_mode": "'.$payment_mode.'",
              "weight": "'.$weight_value.'",
              "products_desc": "'.$product_description.'",
              "commodity_value": "'.$order_value.'",
              "total_amount": "'.$total_order_value.'",
              "cod_amount": "'.$total_order_value.'",
              "add": "'.$customer_address.'",
              "city": "'.$destination_city.'",
              "state": "'.$destination_state.'",
              "country": "'.$destination_country.'",
              "phone": "'.$phone.'",
              "pin": "'.$destination_pincode.'",
              "fragile_shipment": "'.$fragile.'",
              "seller_name": "'.$seller_name.'",
              "seller_add": "'.$seller_address.'",
              "seller_tin": "'.$seller_GSTIN.'"
          }],
          "pickup_location": {
            "name": "'.$pickup_address.'",
            "city": "'.$pickup_city.'",
            "pin": "'.$pickup_pincode.'",
            "country": "'.$pickup_country.'",
            "phone": "'.$pickup_pincode.'",
            "add": "'.$pickup_detail_address.'"
          }
         
        }';

        curl_setopt($ch, CURLOPT_URL, 'https://track.delhivery.com/api/cmu/create.json');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $headers = array();
        $headers[] = 'Content-Type: text/plain';
        $headers[] = 'Authorization: Token 9310a07855e5eb10fb071b68acd5eeebdc8c84c2';
        $headers[] = 'Accept: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        return $result;
      }


      /* this api is used for create wherehouse to delivery partner API */
      public function createwhareHouse($params){

            $warehouse_phone   = isset($params['mobile']) ? $params['mobile']:'';
            $warehouse_city    = isset($params['api_city']) ? $params['api_city']:'';
            $warehouse_name    = isset($params['warehouse_name']) ? $params['warehouse_name']:'';
            $warehouse_pincode = isset($params['pincode']) ? $params['pincode']:'';
            $warehouse_address = isset($params['address']) ? $params['address']:'';
            $warehouse_state   = isset($params['api_state']) ? $params['api_state']:'';
            $warehouse_country = isset($params['api_country']) ? $params['api_country']:'';
            $warehouse_email   = isset($params['email']) ? $params['email']:'';
            $warehouse_raddress= isset($params['return_address']) ? $params['return_address']:'';
            $warehouse_rpincode= isset($params['return_pin']) ? $params['return_pin']:'';
            $warehouse_rcity   = isset($params['api_return_city']) ? $params['api_return_city']:'';
            $warehouse_rstate  = isset($params['api_return_state']) ? $params['api_return_state']:'';
            $warehouse_rcountry= isset($params['api_return_country']) ? $params['api_return_country']:'';

              $data = array(
                        'phone'=>$warehouse_phone, 
                        'city'=>$warehouse_city, 
                        'name'=>$warehouse_name, 
                        'pin'=>$warehouse_pincode, 
                        'address'=>$warehouse_address, 
                        'country'=>$warehouse_country,
                        'email'=>$warehouse_email,
                        'registered_name'=>$warehouse_name,
                        'return_address'=>$warehouse_raddress, 
                        'return_pin'=>$warehouse_rpincode, 
                        'return_city'=>$warehouse_rcity, 
                        'return_state'=>$warehouse_rstate,
                        'return_country'=>$warehouse_rcountry,
              );

              $post = json_encode($data);

              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, 'https://track.delhivery.com/api/backend/clientwarehouse/create/');
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
              curl_setopt($ch, CURLOPT_POST, 1);
              curl_setopt($ch, CURLOPT_POSTFIELDS,$post);

              $headers = array();
              $headers[] = 'Content-Type: application/json';
              $headers[] = 'Authorization: Token 9310a07855e5eb10fb071b68acd5eeebdc8c84c2';
              $headers[] = 'Accept: application/json';
              curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

              $result = curl_exec($ch);
              if (curl_errno($ch)) {
                  echo 'Error:' . curl_error($ch);
              }
              curl_close($ch);
              return $result;
      }

      /* This API Function is used Update WhereHouse*/
      public function editwhareHouse($params){

        $warehouse_phone   = isset($params['mobile']) ? $params['mobile']:'';
        $warehouse_city    = isset($params['api_city']) ? $params['api_city']:'';
        $warehouse_name    = isset($params['warehouse_name']) ? $params['warehouse_name']:'';
        $warehouse_pincode = isset($params['pincode']) ? $params['pincode']:'';
        $warehouse_address = isset($params['address']) ? $params['address']:'';
        $warehouse_state   = isset($params['api_state']) ? $params['api_state']:'';
        $warehouse_country = isset($params['api_country']) ? $params['api_country']:'';
        $warehouse_email   = isset($params['email']) ? $params['email']:'';
        $warehouse_raddress= isset($params['return_address']) ? $params['return_address']:'';
        $warehouse_rpincode= isset($params['return_pin']) ? $params['return_pin']:'';
        $warehouse_rcity   = isset($params['api_return_city']) ? $params['api_return_city']:'';
        $warehouse_rstate  = isset($params['api_return_state']) ? $params['api_return_state']:'';
        $warehouse_rcountry= isset($params['api_return_country']) ? $params['api_return_country']:'';

                    $data = array(
                      'phone'=>$warehouse_phone, 
                      'city'=>$warehouse_city, 
                      'name'=>$warehouse_name, 
                      'pin'=>$warehouse_pincode, 
                      'address'=>$warehouse_address, 
                      'country'=>$warehouse_country,
                      'email'=>$warehouse_email,
                      'registered_name'=>$warehouse_name,
                      'return_address'=>$warehouse_raddress, 
                      'return_pin'=>$warehouse_rpincode, 
                      'return_city'=>$warehouse_rcity, 
                      'return_state'=>$warehouse_rstate,
                      'return_country'=>$warehouse_rcountry,
                     );

            $post = json_encode($data);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://track.delhivery.com/api/backend/clientwarehouse/edit/');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$post);

            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: Token 9310a07855e5eb10fb071b68acd5eeebdc8c84c2';
            $headers[] = 'Accept: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
            return $result;
      }


      /*This function is used get packing slip data depend on waybill number*/
      public function printSinglepackingSlip($waybill){

        $ch = curl_init();
         
        curl_setopt($ch, CURLOPT_URL, 'https://track.delhivery.com/api/p/packing_slip?wbns='.$waybill);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $headers = array();
        $headers[] = 'Content-Type: text/plain';
        $headers[] = 'Authorization: Token 9310a07855e5eb10fb071b68acd5eeebdc8c84c2';
        $headers[] = 'Accept: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch); 
        return $result;

      }

     /* This Function is used to create Reverse order */

    public function reverseOrder($params){
      
      $order_number  = isset($params['order_number']) ? $params['order_number']:time();
      $customer_pincode= isset($params['customer_pincode']) ? $params['customer_pincode']:'';
      $customer_name= isset($params['customer_name']) ? $params['customer_name']:'';
      $address_type= isset($params['address_type']) ? $params['address_type']:'';
      $customer_address= isset($params['customer_address']) ? $params['customer_address']:'';
      $customer_landmark= isset($params['customer_landmark']) ? $params['customer_landmark']:'';
      $customer_country= isset($params['customer_country']) ? $params['customer_country']:'';
      $customer_state= isset($params['customer_state']) ? $params['customer_state']:'';
      $customer_district= isset($params['customer_district']) ? $params['customer_district']:'';
      $customer_city= isset($params['customer_city']) ? $params['customer_city']:'';
      $phone= isset($params['phone']) ? $params['phone']:'';

      $seller_name= isset($params['seller_name']) ? $params['seller_name']:'';

      $to_address = isset($params['pickup_address']) ? $params['pickup_address']:'';
      $to_detail_address = isset($params['pickup_detail_address']) ? $params['pickup_detail_address']:'';
      $to_country = isset($params['pickup_country']) ? $params['pickup_country']:'';
      $to_state = isset($params['pickup_state']) ? $params['pickup_state']:'';
      $to_city = isset($params['pickup_city']) ? $params['pickup_city']:'';
      $to_pincode = isset($params['pickup_pincode']) ? $params['pickup_pincode']:'';
      $to_email = isset($params['pickup_email']) ? $params['pickup_email']:'';
      $to_contactno = isset($params['pickup_contact_no']) ? $params['pickup_contact_no']:'';
      $package_amount = isset($params['package_amount']) ? $params['package_amount']:'';
      $fragile = isset($params['fragile']) ? $params['fragile']:'false';
      
                $post = 'format=json&data={
                  "shipments": [{
                      "name": "'.$customer_name.'",
                      "order": "'.$order_number.'",
                      "order_date": "'.date('Y-m-d').'",
                      "payment_mode": "Pickup",
                      "total_amount": "'.$package_amount.'",
                      "add": "'.$customer_address.'",
                      "city": "'.$customer_city.'",
                      "state": "'.$customer_state.'",
                      "country": "'.$customer_country.'",
                      "phone": "'.$phone.'",
                      "pin": "'.$customer_pincode.'",
                      "return_add": "'.$to_detail_address.'",
                      "return_city": "'.$to_city.'",
                      "return_country": "'.$to_country.'",
                      "fragile_shipment": "'.$fragile.'",
                      "return_name": "'.$to_address.'",
                      "seller_name": "'.$seller_name.'",
                      "return_phone": "'.$to_contactno.'",
                      "return_pin": "'.$to_pincode.'"
                  }]
              }';

               $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL, 'https://track.delhivery.com/api/cmu/create.json');
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
               curl_setopt($ch, CURLOPT_POST, 1);
               curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

               $headers = array();
               $headers[] = 'Content-Type: text/plain';
               $headers[] = 'Authorization: Token 9310a07855e5eb10fb071b68acd5eeebdc8c84c2';
               $headers[] = 'Accept: application/json';
               curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
               $result = curl_exec($ch);

               if (curl_errno($ch)) {
                   echo 'Error:' . curl_error($ch);
               }
               curl_close($ch);
               return $result;

    }


    /* This Function is used to Track Order */

    public function trackOrder($waybill_number){
          $curl    = curl_init();
          curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://track.delhivery.com/api/v1/packages/json/?waybill='.$waybill_number.'&token=9310a07855e5eb10fb071b68acd5eeebdc8c84c2',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS =>"",
            CURLOPT_HTTPHEADER => array(
              "Content-Type: application/json"
            ),
          ));

          $response = curl_exec($curl);
          curl_close($curl);
          return $response;die;
        }

      /* This Function is used to Track Order */
    public function cancelOrder($waybill_number){

          $post = '{
            "waybill": "'.$waybill_number.'",
            "cancellation": "true"
          }';
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, 'https://track.delhivery.com/api/p/edit');
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS,$post);

          $headers = array();
          $headers[] = 'Content-Type: application/json';
          $headers[] = 'Authorization: Token 9310a07855e5eb10fb071b68acd5eeebdc8c84c2';
          $headers[] = 'Accept: application/json';
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

          $result = curl_exec($ch);

          if (curl_errno($ch)) {
                   echo 'Error:' . curl_error($ch);
          }
          curl_close($ch);
          return $result;   
    }     

    /* This API is used for Request to pickup*/
    public function requesttoPickup($params){

          $pickuppoint= isset($params['pickuppoint']) ? $params['pickuppoint']:'';
          $pickup_time= isset($params['time']) ? $params['time']:'';
          $pickup_date= isset($params['pickupdate']) ? $params['pickupdate']:'';
          $expected_package_count= isset($params['expectedpackages']) ? $params['expectedpackages']:'';

          $post = '{
            "pickup_time": "'.$pickup_time.'",
            "pickup_date": "'.$pickup_date.'",
            "pickup_location": "'.$pickuppoint.'",
            "expected_package_count": "'.$expected_package_count.'"
          }';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://track.delhivery.com/fm/request/new/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Token 9310a07855e5eb10fb071b68acd5eeebdc8c84c2';
        $headers[] = 'Accept: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;  

    }

    public function calculaterates($params){
      
      //$post = '{"ss":"RTO","md":"S","cgm":"10","o_pin":"250004","d_pin":"250001"}';

      $dest_pincode= isset($params['dest_pincode']) ? $params['dest_pincode']:'';
      $origin_pincode= isset($params['origin_pincode']) ? $params['origin_pincode']:'';
      $pkg_type= isset($params['pkg_type']) ? $params['pkg_type']:'';
      $del_speed= isset($params['del_speed']) ? $params['del_speed']:'';
      $weight= isset($params['weight']) ? $params['weight']:'';
      $pay_mode= isset($params['pay_mode']) ? $params['pay_mode']:'';
      $cod_amount= isset($params['cod_amount']) ? $params['cod_amount']:'';
      $client  ='MSOMCSASIANWORLDWID FRANCHISE';
   

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'https://track.delhivery.com/api/kinko/v1/invoice/charges/?pt='.$pay_mode.'&&cod='.$cod_amount.'&&wt='.$weight.'&&ss='.$pkg_type.'&&md='.$del_speed.'&&cgm='.$weight.'&&o_pin='.$origin_pincode.'&&d_pin='.$dest_pincode.'');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POST, 1);
      // curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


      $headers = array();
      $headers[] = 'Content-Type: application/json';
      $headers[] = 'Authorization: Token 9310a07855e5eb10fb071b68acd5eeebdc8c84c2';
      //$headers[] = 'User-Agent: ReadMe-API-Explorer';
      $headers[] = 'Accept: application/json';
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

      $result = curl_exec($ch);

      if (curl_errno($ch)) {
          echo 'Error:' . curl_error($ch);
      }
      curl_close($ch);
      return $result;  

    }

      
}