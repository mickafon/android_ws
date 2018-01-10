<?php

class Address
{

  private $_id;
  private $_label;
  private $_street;
  private $_city;
  private $_postal;
  private $_additional;

  public __construct(){

  }

  private function construct1( $id ) {
    $query = " SELECT Label,
                      Street,
                      City,
                      PostalCode,
                      AdditionalAddress
               FROM   Address
               WHERE  ID = $id ";

    $send = ( new Database() )->select( $query );

    if( !empty( $send ) ) {
      $this->_id         = $id;
      $this->_label      = $send[0]['Label'];
      $this->_street     = $send[0]['Street'];
      $this->_city       = $send[0]['City'];
      $this->_postal     = $send[0]['PostalCode'];
      $this->_additional = $send[0]['AdditionalAddress'];
    }
  }

  private function construct5( $label, $street, $city, $postal, $additional ) {
    $columns = array(
                        'Label',
                        'Street',
                        'City',
                        'PostalCode',
                        'AdditionalAddress'
                      );

    $values = array(
                      $label,
                      $street,
                      $city,
                      $postal,
                      $additional
                    );

    $inserted = ( new Database() )->need_value_after_insert( 'Address', $columns, $values, 'ID' );

    if( $inserted != 0 ) $this->_id = intval($inserted[0]['ID']);
  }

  public function stringify() {
    return array(
                  'id'         => $this->_id,
                  'label'      => $this->_label,
                  'street'     => $this->_street,
                  'city'       => $this->_city,
                  'postal'     => $this->_postal,
                  'additional' => $this->_additional
                );
  }
}
