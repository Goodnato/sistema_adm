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
                        <input type="text" class="form-control form-control-sm" id="pesquisaImei" placeholder="DIGITE AQUI">
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
                        <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modalNovoAparelho"><i class="fas fa-plus-square"></i> Novo aparelho</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-5 px-2">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm" id="tabelaAparelhos">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Imei</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Condição</th>
                        <th scope="col">Nota fiscal</th>
                        <th scope="col">Data nota fiscal</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Valor depreciado</th>
                        <th scope="col">Cadastrado por</th>
                        <th scope="col">Data registro</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalNovoAparelho" tabindex="-1">
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
                                        <div id="cadastroAlert" class="alert alert-danger d-none" role="alert">
                                            <div id="cadastroMensagem"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="cadastroImei" class="form-label">IMEI*</label>
                                        <input type="number" name="imei" class="form-control form-control-sm" id="cadastroImei" placeholder="DIGITE AQUI">
                                    </div>
                                    <div class="col">
                                        <label for="cadastroModelo" class="form-label">Modelo*</label>
                                        <select class="form-control form-control-sm" id="cadastroModelo">
                                            <option value>SELECIONE</option>
                                            <?php foreach ($listaModelosAtivos as $modelo) { ?>
                                                <option value="<?= $modelo['id'] ?>"><?= $modelo['nome'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="cadastroMarca" class="form-label">Marca*</label>
                                        <input type="text" class="form-control form-control-sm text-center" id="cadastroMarca" value="SELECIONE UM MODELO" disabled>
                                    </div>
                                    <div class="col">
                                        <label for="cadastroStatusCondicaoAparelho" class="form-label">Condição aparelho*</label>
                                        <select class="form-control form-control-sm" id="cadastroStatusCondicaoAparelho">
                                            <?php foreach ($listaStatusCondicoes as $status) { ?>
                                                <option value="<?= $status['id'] ?>"><?= $status['nome'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <label for="cadastroNotaFiscal" class="form-label">Nota fiscal</label>
                                        <input type="number" class="form-control form-control-sm" id="cadastroNotaFiscal" placeholder="DIGITE AQUI">
                                    </div>
                                    <div class="col-6">
                                        <label for="cadastroDataNotaFiscal" class="form-label">Data nota fiscal</label>
                                        <input type="date" class="form-control form-control-sm" id="cadastroDataNotaFiscal" placeholder="0,00">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <label for="cadastroValorNotaFiscal" class="form-label">Valor nota fiscal R$</label>
                                        <input type="text" class="form-control form-control-sm" id="cadastroValorNotaFiscal" placeholder="0,00">
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