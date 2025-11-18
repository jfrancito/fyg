 	<div class="be-content contenido" style="height: 100vh;">
		<div class="main-content container-fluid">
				<div class='container'>
					<div class="row">
						<div class="col-md-10 col-md-offset-2 bciid">
							<div class="col-md-12">


						            <div class="col-md-2 " style="padding-right: 0px;">
				                      <div class="icon-container color_azul right" style=" height: 163px;">
				                        	<span class="mdi mdi-balance" 
				                        	style="font-size: 80px; color: #fff; padding-top: 15px;"></span>
				                      </div>
						            </div>

						            <div class="col-md-5" style="padding-left: 0px;">
						              <div class="panel panel-contrast color_azul" style="margin-bottom:0px;border-radius:0px;">
						                <div class="panel-body">

						                  	<h4 class="center cblanco"><b> {{Session::get('institucion')->codigo}}</b></h3>
						                  	<h6 class="center color_azulclaro cursiva" style="margin-bottom:0px;margin-top: 0px;"><b>CODIGO LOCAL</b></h5>
						                  	<h4 class="center cblanco"><b> {{strtoupper(Session::get('institucion')->nombre)}}</b></h3>
						                  	<h6 class="center color_azulclaro cursiva" style="margin-bottom:0px;margin-top: 0px;">
						                  		<b>{{strtoupper(Session::get('institucion')->departamento)}}<br>
						                  			{{strtoupper(Session::get('institucion')->provincia)}} | 
						                  			{{strtoupper(Session::get('institucion')->distrito)}}</b>
						                  	</h5>
						                </div>
						              </div>
						            </div>
						    </div>
							<div class="col-md-12">

						            <div class="col-md-2 " style="padding-right: 0px;">
				                      <div class="icon-container right" style=" height: 265px;">
				                        	<span class="mdi mdi-account cazul" 
				                        	style="font-size: 80px; color: #fff; padding-top: 65px;"></span>
				                      </div>
						            </div>
						            <div class="col-md-5" style="padding-left: 0px;">
						              <div class="panel panel-contrast" style="margin-bottom:0px;border-radius:0px;">
						                <div class="panel-body ">
						                  	<h4 class="center cazul"><b> {{strtoupper(Session::get('direccion')->dni)}}</b></h3>
						                  	<h6 class="center color_gris cursiva" style="margin-bottom:0px;margin-top: 0px;"><b>DNI</b></h5>

						                  	<h4 class="center cazul"><b> {{strtoupper(Session::get('direccion')->nombres)}}</b></h3>
						                  	<h6 class="center color_gris cursiva" style="margin-bottom:0px;margin-top: 0px;"><b>NOMBRES</b></h5>

						                  	<h4 class="center cazul"><b> {{strtoupper(Session::get('direccion')->telefono)}}</b></h3>
						                  	<h6 class="center color_gris cursiva" style="margin-bottom:0px;margin-top: 0px;"><b>TELEFONO</b></h5>

						                  	<h4 class="center cazul"><b> {{strtoupper(Session::get('direccion')->correo)}}</b></h3>
						                  	<h6 class="center color_gris cursiva" style="margin-bottom:0px;margin-top: 0px;"><b>CORREO</b></h5>					                  	
						                </div>
						              </div>
						            </div>
						    </div>
						</div>
					</div>
				</div>

				<div class='container' style="margin-top: 10px;">
					<div class="col-xs-12 col-sm-offset-0 col-sm-4 col-md-3 col-lg-3 col-md-offset-2">
						<article class="profile-2" style="margin-left: 30px;">
							<div class="titulo-profile">
								CONEI
							</div>
							<h2 class="profile-username">{{$conei_periodo}}</h2>
							<h2 class="profile-username">
								@include('usuario.estados', ['estado' => $conei_estado])
							</h2>
						</article>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
						<article class="profile-2">
							<div class="titulo-profile">
								APAFA
							</div>
							<h2 class="profile-username">{{$apafa_periodo}}</h2>
							<h2 class="profile-username">
        						@include('usuario.estados', ['estado' => $apafa_estado])
							</h2>

						</article>
					</div>
				</div>

		</div>
	</div>