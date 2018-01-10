<?php

class Festival
{

  private $_id;
  private $_label;
  private $_start;
  private $_end;
  private $_description;
  private $_information;

  public __construct() {

  }

  private function construct1( $id ) {
    $query = "SELECT Label,
                     StartDate,
                     EndDate,
                     Description,
                     Informations
              FROM   Festival
              WHERE  ID = $id";

    $send = ( new Database() )->select( $query );

    if( !empty( $send ) ) {
      $this->_id          = $id;
      $this->_label       = $send[0]['Label'];
      $this->_start       = $send[0]['StartDate'];
      $this->_end         = $send[0]['EndDate'];
      $this->_description = $send[0]['Description'];
      $this->_information = $send[0]['Informations'];
    }
  }

  private function construct5( $label, $start, $end, $description, $information ) {
    $columns = array(
                      'Label',
                      'StartDate',
                      'EndDate',
                      'Description',
                      'Informations'
                    );

    $values = array(
                      $label,
                      $start,
                      $end,
                      $description,
                      $information
                    );

    $inserted = ( new Database() )->need_value_after_insert( 'Festival', $columns, $values, 'ID' );

    if( $inserted != 0 ) $this->_id = intval($inserted[0]['ID']);
  }

  public function stringify() {
    return array(
                  'id'          => $this->_id,
                  'label'       => $this->_label,
                  'start'       => $this->_start,
                  'end'         => $this->_end,
                  'description' => $this->_description,
                  'information' => $this->_information
                );
  }

}
