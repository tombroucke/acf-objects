<?php

namespace App\AcfObjects;

class Repeater {

    protected $repeater_array;

    public function __construct( $repeater_array ) {

        if( !is_array( $repeater_array ) ) {
            $repeater_array = array();
        }
        $this->repeater_array = $repeater_array;

    }

    public function have_rows() {

        return ! empty( $this->repeater_array );

    }

    public function rows() {

        $return = array();
        if ( ! $this->have_rows() ) {
            return $return;
        }
        foreach ( $this->repeater_array as $row ) {
            $return[] = new Row( $row );
        }
        return $return;

    }

    public function row( $index ) {

        return isset( $this->repeater_array[ $index ] ) ? new Row( $this->repeater_array[ $index ] ) : false;

    }
}
