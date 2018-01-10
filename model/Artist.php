<?php

class Artist{

  private $_id;
  private $_label;
  private $_description;
  private $_style;

  public __construct( ) {

  }

  private function construct1( $id ) {
    $query = " SELECT Label,
                      Description
                      MusicStyle
               FROM   Artist
               WHERE  ID = $id ";

    $send = ( new Database() )->select( $query );

    if( !empty( $send ) ) {
      $this->_id          = $id;
      $this->_label       = $send[0]['Label'];
      $this->_description = $send[0]['Description'];
      $this->_style       = $send[0]['MusicStyle'];
    }
  }

  private function construct3( $label, $description, $style ) {
    $columns = array(
                      'Label',
                      'Description',
                      'MusicStyle'
                    );

    $values = array(
                      $label,
                      $descritpion,
                      $style
                    );

    $inserted = ( new Database() )->need_value_after_insert( 'Artist', $columns, $values, 'ID' );

    if( $inserted != 0 ) $this->_id = intval($inserted[0]['ID']);
  }

  public function stringify() {
    return array(
                  'id'          => $this->_id,
                  'label'       => $this->_label,
                  'description' => $this->_description,
                  'style'       => $this->_style
                );
  }
}
