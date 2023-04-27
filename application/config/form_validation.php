<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Form Validation
|--------------------------------------------------------------------------
|
| Various Arrays to validate CodeIgniter form request parameters.
|
*/

$config = array('restaurants_edit'=>
                                array(
                                    array(
                                        'field' => 'name',
                                        'label' => 'Name',
                                        'rules' => 'required',
                                    ),
                                    array(
                                        'field' => 'primary_contact_person',
                                        'label' => 'Primary Contact Person',
                                        'rules' => 'required',
                                    ),
                                    array(
                                        'field' => 'email',
                                        'label' => 'Email',
                                        'rules' => 'trim|required|valid_email',
                                    ),
                                    array(
                                        'field' => 'owner_phone',
                                        'label' => 'Phone Number',
                                        'rules' => 'required',
                                    ),
                                )
                            );
