<div class="container-fluid">
    <div class="row justify-content-center mt-5">
        <div class="col-6 p-3" style="background-color: #FAFBFC;">
            <form>
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center">Aparelhos</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="pesquisaMarca" class="form-label">Marca</label>
                        <select id="pesquisaMarca" multiple="multiple">
                            <?php foreach ($listaMarcas as $marca) { ?>
                                <option value="<?= $marca['id'] ?>"><?= $marca['nome'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="pesquisaModelo" class="form-label">Modelo</label>
                        <select id="pesquisaModelo" multiple="multiple">
                            <?php foreach ($listaModelos as $modelo) { ?>
                                <option value="<?= $modelo['id'] ?>"><?= $modelo['nome'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label for="pesquisaImei" class="form-label">IMEI</label>
                        <input type="text" class="form-control form-control-sm" id="pesquisaImei" placeholder="Digite aqui">
                    </div>
                    <div class="col">
                        <label for="pesquisaCadastradoPor" class="form-label">Cadastrado por</label>
                        <select id="pesquisaCadastradoPor" multiple="multiple">
                            <?php foreach ($listaUsuariosCadastroAparelho as $cadastradoPor) { ?>
                                <option value="<?= $cadastradoPor['id'] ?>"><?= $cadastradoPor['nome'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-4">
                        <label for="pesquisaStatusCondicoes" class="form-label">Condições aparelho</label>
                        <select id="pesquisaStatusCondicoes" multiple="multiple">
                            <?php foreach ($listaStatusCondicoes as $status) { ?>
                                <option value="<?= $status['id'] ?>"><?= $status['nome'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="pesquisaDisponibilidade" class="form-label">Disponibilidade</label><br>
                        <select id="pesquisaDisponibilidade" multiple="multiple">
                            <?php foreach ($listaStatusDisponibilidades as $status) { ?>
                                <option value="<?= $status['id'] ?>"><?= $status['nome'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="pesquisaStatus" class="form-label">Status</label><br>
                        <select id="pesquisaStatus" multiple="multiple">
                            <?php foreach (ARRAY_STATUS as $idStatus => $status) { ?>
                                <option value="<?= $idStatus ?>"><?= $status ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <button class="btn btn-primary"><i class="fas fa-search"></i> Pesquisar</button>
                        <button class="btn btn-warning"><i class="fas fa-file-excel"></i> Excel</button>
                        <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus-square"></i> Novo aparelho</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-5">
        <div class="table-responsive">
            <table class="table table-striped" style="min-width: 1200px;">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLabel"><i class="fas fa-plus-square"></i> Novo aparelho</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <form>
                                <div class="row">
                                    <div class="col">
                                        <label for="formGroupExampleInput" class="form-label">IMEI</label>
                                        <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Digite aqui">
                                    </div>
                                    <div class="col">
                                        <label for="formGroupExampleInput" class="form-label">Modelo</label>
                                        <select class="form-control form-control-sm">
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="formGroupExampleInput" class="form-label">Marca</label>
                                        <select class="form-control form-control-sm">
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="formGroupExampleInput" class="form-label">Estado</label>
                                        <select class="form-control form-control-sm">
                                            <option value="1">Selecione aqui</option>
                                            <option value="1">Novo</option>
                                            <option value="2">Usado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <label for="formGroupExampleInput" class="form-label">Nota fiscal</label>
                                        <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Digite aqui">
                                    </div>
                                    <div class="col-6">
                                        <label for="formGroupExampleInput" class="form-label">Data Nota</label>
                                        <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Digite aqui">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <label for="formGroupExampleInput" class="form-label">Valor R$</label>
                                        <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" placeholder="Digite aqui">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
                <button type="button" class="btn btn-success" id="btnSalvarAparelho"><i class="fas fa-save"></i> Salvar</button>
            </div>
        </div>
    </div>
</div>