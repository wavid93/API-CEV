<?php



class Controller_users2 extends Controller_token
{

    //Funcion para registrar usuarios
    public function post_create() {

            




        $username = Input::post('username');
        $password = Input::post('password');
        $email = Input::post('email');
        $foto = Input::post('foto');

        if (empty($username) or empty($password) ) {

            return $this->codeInfo($code = 400, $mensaje = 'Faltan campos por enviar');
        }
        else {


            $userBD = Model_users2::find('all', array(
                'where' => array(
                    array('username', Input::post('username')),
                    )
                ));

                

                    
                    foreach ($userBD as $verif => $value)
                    {
                        $usernameBD = $userBD[$verif]->username;
                        //$emailBD = $userBD[$verif]->email;
                    }
                    



                    if ( Isset($usernameBD) == $username ) {

                        return $this->codeInfo($code = 402, $mensaje = 'Error, user ya registrado');
                    }
                    /*
                    else if ( Isset($emailBD) == $email ) {

                        echo 'Error usuario ya registrado';
                    }
                    */
                    else {

            
                        $user = new Model_users2();
                        $user->username = Input::post('username');
                        $user->email = Input::post('email');
                        $user->password = Input::post('password');
                        $user->foto = Input::post('foto');
                        $user->save();

            

                        return $this->codeInfo($code = 200, $mensaje = 'Exito, usuario registrado');
                    }
        }
    }






    

    //Funcion de ADMIN para listar todos los usuarios
    public function get_users() {

        //$Verif = new Controller_token;

        $verificacion = $this->get_userVerify();

        //var_dump($verificacion);

        if ($verificacion == true ) {

            $users = Model_users2::find('all');
            return $users;

        }
        else{

            //return $this->errorAuth();
            return $this->codeInfo($code = 403, $mensaje = 'Error en verificacion sesion');  //ERROR VERIFICACION DE SESION
        }


        
    }

    //Funcion para listar los datos de un user a partir de su ID

    public function post_user($id) {  

        $verificacion = $this->get_userVerify();
        //var_dump($verificacion);

        if ($verificacion == true ) {

            
            //$guardarID = Input::post("id");

            

            $user = Model_users2::find('all', array(
            'where' => array(
            array('id', $id))));

            if($user!=null){
                return $user; 
            } else{

                return $this->codeInfo($code = 404, $mensaje = 'No existe user con tal ID');  
            }
        }
        else{

            return $this->codeInfo($code = 403, $mensaje = 'Error en verificacion sesion');
        }

    }




    public function post_update($id) {

        $verificacion = $this->get_userVerify();
        //var_dump($verificacion);

        if ($verificacion == true ) {

            //$header = apache_request_headers();
            //var_dump($header);

            //$guardarID = Input::post("id");         
            $guardarUser = Input::post("username");
            $guardarEmail = Input::post("email");
            $guardarPass = Input::post("password");
            $guardarFoto = Input::post("foto");

            //var_dump($guardarID);


            /*foreach ($user as $verif => $value)
            {
                $id = $user[$verif]->id;
                $username = $user[$verif]->username;
                $password = $user[$verif]->password;
                $email = $user[$verif]->email;
                $foto = $user[$verif]->foto;
            }
            */
            //$user = new Model_users2();
            $user = Model_users2::find('all', array(
            'where' => array(
                array('id', $id))));

            //var_dump($user);

            
            
            //var_dump($user);
            
            if ( $guardarUser == null or $guardarEmail == null or $guardarPass == null or $guardarFoto == null) {

                return $this->codeInfo($code = 406, $mensaje = 'Error, algun campo esta vacio');

            }   
            else {

                if($user!=null){

                    $user[$id]->set(array(        // POR QUE EL EL INDEX DEL ARRAY ES EL 4?
                    'username'  => $guardarUser,
                    'password' => $guardarPass,
                    'email' => $guardarEmail,
                    'foto' => $guardarFoto
                ));

                $user[$id]->save();
                

                return $user; 

                }

                else{

                return $this->codeInfo($code = 404, $mensaje = 'No existe user con tal ID');
                }

            }    
        }
        else{

            return $this->codeInfo($code = 403, $mensaje = 'Error en verificacion sesion');
        }

    }

    public function post_delete($id) {

        $verificacion = $this->get_userVerify();
        //var_dump($verificacion);

        if ($verificacion == true ) {

            //$header = apache_request_headers();
            //var_dump($header);





            //$guardarID = Input::post("id");
           

            //var_dump($guardarID);


            
            $user = Model_users2::find('all', array(
            'where' => array(
                array('id', $id))));

            //var_dump($user);

            
            
            //var_dump($user);
            
            


            if($user!=null){

                $user[$id]->delete();

                //$user[$guardarID]->save();
                

                return [
                $this->codeInfo($code = 200, $mensaje = 'Exito, usuario borrado'),
                $user ];
                
            } else{

                return $this->codeInfo($code = 404, $mensaje = 'No existe user con tal ID');
            }
        }
        else{

            return $this->codeInfo($code = 403, $mensaje = 'Error verificacion de sesion');
        }

    }





}