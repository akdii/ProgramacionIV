
<?php
require('header.php');
?>
<br>
                                        <div class="form-button mt-3">
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;     <button id="submit" type="button" onclick="verreporte();"  class="btn btn-danger">ver reporte</button>
                                           </div>
<br>
    <div class="container">
   </div>
        <div class="contact__wrapper shadow-lg mt-n9">
            <div class="row no-gutters">
                <div class="col-lg-5 contact-info__wrapper gradient-brand-color p-5 order-lg-2">
                    <h3 class="color--white mb-5">Contáctanos</h3>
        
                    <ul class="contact-info__list list-style--none position-relative z-index-101">
                        <li class="mb-4 pl-4">
                            <span class="position-absolute"><i class="fas fa-envelope"></i></span> INSAinm@gmail.com
                        </li>
                        <li class="mb-4 pl-4">
                            <span class="position-absolute"><i class="fas fa-phone"></i></span> (+504) 98075770
                        </li>
                        <li class="mb-4 pl-4">
                            <span class="position-absolute"><i class="fas fa-map-marker-alt"></i></span> Nueva Arcadi, santa ana FM
              
                        
        
                            <div class="mt-3">
                                <a href="https://goo.gl/maps/9SW9KQzqXwy2vhB99" target="_blank" class="text-link link--right-icon text-white">Direccion google maps<i class="link__icon fa fa-directions"></i></a>
                            </div>
                        </li>
                    </ul>
        
                    <figure class="figure position-absolute m-0 opacity-06 z-index-100" style="bottom:0; right: 10px">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="444px" height="626px">
                            <defs>
                                <linearGradient id="PSgrad_1" x1="0%" x2="81.915%" y1="57.358%" y2="0%">
                                    <stop offset="0%" stop-color="rgb(255,255,255)" stop-opacity="1"></stop>
                                    <stop offset="100%" stop-color="rgb(0,54,207)" stop-opacity="0"></stop>
                                </linearGradient>
        
                            </defs>
                            <path fill-rule="evenodd" opacity="0.302" fill="rgb(72, 155, 248)" d="M816.210,-41.714 L968.999,111.158 L-197.210,1277.998 L-349.998,1125.127 L816.210,-41.714 Z"></path>
                            <path fill="url(#PSgrad_1)" d="M816.210,-41.714 L968.999,111.158 L-197.210,1277.998 L-349.998,1125.127 L816.210,-41.714 Z"></path>
                        </svg>
                    </figure>
                </div>
        
                <div class="col-lg-7 contact-form__wrapper p-5 order-lg-1">
                    <form action="#" class="contact-form form-validate" novalidate="novalidate">
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label class="required-field" for="firstName">Nombre</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" >
                                    <div class="valid-feedback">Correo ingresado correctamente!</div>
                                 <div class="invalid-feedback">No ingreso su correo!</div>
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="lastName">Apellido</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" >
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label class="required-field" for="email">Correo</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="wendy.a@gmail.com">
                                </div>
                            </div>
        
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="phone">Numero telefono</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" >
                                </div>
                            </div>

							<div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="phone">Fecha</label>
                                    <input type="date" class="form-control" id="date" name="date" >
                                </div>
                            </div>

							<div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="phone">Hora</label>
                                    <input type="time" class="form-control" id="hora" name="hora" >
                                 
                                </div>
                            </div>

                           
                            <div>
                            <label>Lugar</label><br>
                            <div class="form-check-inline">
                            <label class="form-check-label">
                         <input type="checkbox" class="form-check-input" value="">Ciudad Dorada
                           </label>
                           </div>
                           <div class="form-check-inline">
                           <label class="form-check-label">
                           <input type="checkbox" class="form-check-input" value="">Ciudad Los Angeles
                           </label>
                           </div>
                           <div class="form-check-inline">
                          <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" value="">Villa Sebastian
                          </label>
                          </div>
                          </div>                       
                     
        
                        </div>
                        <div class="form-button mt-3">
                                <button id="submit" type="submit" class="btn btn-warning">Registrar Cita</button>
                            </div>
                          
                            
                    </form>
                </div>
                <!-- End Contact Form Wrapper -->
        
            </div>
        </div>
    </div>  
   
<br><br>
<script type="text/javascript" src="script/producto.js">
<script type="text/javascript" src="js/formulario.js"></script>

<?php
require('footer.php');
?>
