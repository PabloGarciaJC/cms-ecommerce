<div class="col-md-7 col-xl-8">
      <div class="tab-content">
        <div class="tab-pane fade show active" id="account" role="tabpanel">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title mb-0">Información pública</h5>
            </div>
            <div class="card-body">
              <form action="<?= base_url ?>Usuario/actualizar" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">                     
                      <label for="inputUsername">Alias</label>
                      <input type="text" class="form-control" value= "<?=$form["usuario"];?>"name="usuario">
                    </div>
                    <div class="form-group">
                      <label for="inputUsername">Nro. de Documentación</label>
                      <input type="text" class="form-control" name="documentacion">
                    </div>
                    <div class="form-group">
                      <label for="inputUsername">Nro. de Telefono</label>
                      <input type="text" class="form-control" name="telefono">
                    </div>                 
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
      </div>
    </div>
  </div>
</div>