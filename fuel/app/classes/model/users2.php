<?php

class Model_users2 extends Orm\Model
{
    
    protected static $_table_name = 'usuarios';
    protected static $_primary_key = array('id');

    protected static $_properties = array(
        'id', // both validation & typing observers will ignore the PK

        'username' => array(
            'data_type' => 'varchar',
            'validation' => array('required'),
            
        ),

        'password' => array(
            'data_type' => 'varchar',
            'validation' => array('required')
            
        ),

        'email' => array(
            'data_type' => 'varchar',
            'validation' => array('required')
            
        ),

        'foto' => array(
            'data_type' => 'varchar',
            'validation' => array('required')
            
        ),

    );


/*
    protected static $_table_name = 'canciones';
    protected static $_primary_key = array('id');

    protected static $_properties = array(
        'id', // both validation & typing observers will ignore the PK
        'titulo' => array(
            'data_type' => 'varchar',
            'validation' => array('required'),
            
        ),
        'artista' => array(
            'data_type' => 'varchar',
            'validation' => array('required'),
           
        ),
        'duracion' => array(
            'data_type' => 'varchar',
            'validation' => array('required'),

        ),
        'genero' => array(
            'data_type' => 'varchar',
            'validation' => array('required')
            
        ),
    );

    */
}