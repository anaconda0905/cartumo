<?php

namespace App\Library;

require_once 'libs/constantcontact/src/Ctct/autoload.php';

use Ctct\Components\Contacts\Contact as Contact;

class CContact extends \Ctct\ConstantContact {

    protected $access_token;
    protected $list_id;

    public function __construct($api_key) {
        parent::__construct($api_key);

        $this->list_id = "1307125155";

        $this->access_token = "68f1db1a-5a78-43b7-89bb-22a84baecd8d";
        $this->newContact(['email'=>'sourav@gmail.com']);
        //$this->getLists();
    }


    public function getCContacts() {
        $contacts = $this->contactService->getContacts($this->access_token);

        echo '<pre>'; print_r($contacts); die;
    }

    public function newContact($data) {
        $contact = new Contact();
        $contact->addEmail((!empty($data['email'])) ? $data['email'] : '');
        $contact->addList($this->list_id);
        $contact->first_name = (!empty($data['email'])) ? $data['name'] : '';
        $contact->company_name = (!empty($data['company_name'])) ?  $data['company_name'] : ''; 
        $contact->job_title = (!empty($data['title'])) ? $data['title'] : '';
        $contact->work_phone = (!empty($data['phone'])) ? $data['phone'] : '';
        $state = (!empty($data['state'])) ? $data['state'] : '';
        $contact->addAddress(Address::create( array("address_type"=>"BUSINESS","line1"=>(!empty($street)) ? $street : '',
       "city"=>(!empty($city)) ? $city : '',"state"=>(!empty($state)) ? $state : '',"postal_code"=>(!empty($zip)) ? $zip : '')));

       $returnContact = $this->contactService->addContact($this->access_token, $contact, true);

       echo '<pre>'; print_r($returnContact); die;
    }


    public function getLists() {

        $lists = $this->listService->getLists($this->access_token);
        echo '<pre>'; print_r($lists); die;
    }
}