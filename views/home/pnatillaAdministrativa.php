<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<div class="container p-0">
  <div class="row">
    <div class="col-md-5 col-xl-4">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">Panel Administrativo</h5>
        </div>
        <div class="list-group list-group-flush" role="tablist">
          <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
            Cuenta
          </a>
          <a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
            Cambio de contraseña
          </a>
          <a class="list-group-item list-group-item-action" data-toggle="list" href="#orders" role="tab">
            Mis Pedidos
          </a>
          <a class="list-group-item list-group-item-action" data-toggle="list" href="#localitation" role="tab">
            Localizador
          </a>
          <a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
            Cerrar Sesion
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-7 col-xl-8">
      <div class="tab-content">
        <div class="tab-pane fade show active" id="account" role="tabpanel">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title mb-0">Información pública</h5>
            </div>
            <div class="card-body">
              <form action="<?= BASE_URL ?>Usuario/actualizar" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label for="inputUsername">Alias</label>
                      <input type="text" class="form-control" name="usuario">
                    </div>
                    <div class="form-group">
                      <label for="inputUsername">Nro. de Documentación</label>
                      <input type="text" class="form-control" name="documentacion">
                    </div>
                    <div class="form-group">
                      <label for="inputUsername">Nro. de Telefono</label>
                      <input type="text" class="form-control" name="telefono">
                    </div>
                    <!-- <div class="form-group">
                      <label for="inputUsername">Biografía</label>
                      <textarea rows="2" class="form-control" id="inputBio"></textarea>
                    </div> -->
                  </div>                  
                  <div class="col-md-4">
                    <div class="text-center">
                      <img alt="Andrew Jones" src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle img-responsive mt-2" width="128" height="128">
                      <div class="mt-2">                       
                        <input type="file" name="avatar">
                         <!-- <span class="btn btn-primary"><i class="fa fa-upload"></i></span>  -->
                      </div>
                      <small>Use una imagen de al menos 128 px por 128 px en formato .jpg</small>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </form>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h5 class="card-title mb-0">Información Privada</h5>
            </div>
            <div class="card-body">
              <form>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Nombres</label>
                    <input type="text" class="form-control">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Apellidos</label>
                    <input type="text" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control">
                </div>
                <div class="form-group">
                  <label>Dirección</label>
                  <input type="text" class="form-control">
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>País</label>
                    <input type="text" class="form-control">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputState">Estado</label>
                    <select id="inputState" class="form-control">
                      <option selected="">Seleccione...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="inputZip">Código Postal</label>
                    <input type="text" class="form-control" id="inputZip">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </form>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="password" role="tabpanel">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Cambio de Contraseña</h5>
              <form>
                <div class="form-group">
                  <label for="inputPasswordCurrent">Contraseña Actual</label>
                  <input type="password" class="form-control" id="inputPasswordCurrent">
                  <small><a href="#">Forgot your password?</a></small>
                </div>
                <div class="form-group">
                  <label for="inputPasswordNew">Contraseña Nueva</label>
                  <input type="password" class="form-control" id="inputPasswordNew">
                </div>
                <div class="form-group">
                  <label for="inputPasswordNew2">Repite Contraseña</label>
                  <input type="password" class="form-control" id="inputPasswordNew2">
                </div>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </form>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="orders" role="tabpanel">
          <div class="card">
            <div class="card-body">
              <h4 class="header-title mb-3">My Projects</h4>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nro. Referencia</th>
                      <th>Fecha de Incio</th>
                      <th>Fecha de Vencimiento</th>
                      <th>Estado de Compra</th>
                      <th>Estado de Envío</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Adminox Admin</td>
                      <td>01/01/2015</td>
                      <td>07/05/2015</td>
                      <td><span class="label label-info">Work in Progress</span></td>
                      <td>Coderthemes</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Adminox Frontend</td>
                      <td>01/01/2015</td>
                      <td>07/05/2015</td>
                      <td><span class="label label-success">Pending</span></td>
                      <td>Coderthemes</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Adminox Admin</td>
                      <td>01/01/2015</td>
                      <td>07/05/2015</td>
                      <td><span class="label label-pink">Done</span></td>
                      <td>Coderthemes</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Adminox Frontend</td>
                      <td>01/01/2015</td>
                      <td>07/05/2015</td>
                      <td><span class="label label-purple">Work in Progress</span></td>
                      <td>Coderthemes</td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>Adminox Admin</td>
                      <td>01/01/2015</td>
                      <td>07/05/2015</td>
                      <td><span class="label label-warning">Coming soon</span></td>
                      <td>Coderthemes</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>