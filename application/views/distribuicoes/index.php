<div class="container-fluid">
    <div class="row justify-content-center mt-5">
        <div class="col-6 p-3" style="background-color: #FAFBFC;">
            <form>
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center">Distribuições</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="pesquisaImei" class="form-label">IMEI</label>
                        <input type="number" class="form-control form-control-sm" id="pesquisaImei" placeholder="DIGITE AQUI">
                    </div>
                    <div class="col">
                        <label for="pesquisaNumero" class="form-label">Número da Linha</label>
                        <input type="text" class="form-control form-control-sm" id="pesquisaNumero" placeholder="DIGITE AQUI">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-4">
                        <label for="pesquisaColaborador" class="form-label">Colaborador</label><br>
                        <select id="pesquisaColaborador" multiple="multiple">
                            <?php foreach ($listaColaboradoresCadastrados as $colaborador) { ?>
                                <option value="<?= $colaborador['id'] ?>"><?= $colaborador['nome'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="pesquisaMatricula" class="form-label">Matrícula</label>
                        <input type="text" class="form-control form-control-sm" id="pesquisaMatricula" placeholder="DIGITE AQUI">
                    </div>
                    <div class="col-4">
                        <label for="pesquisaCidade" class="form-label">Cidade</label>
                        <select id="pesquisaCidade" multiple="multiple">
                            <?php foreach ($listaCidadesCadastradas as $cidade) { ?>
                                <option value="<?= $cidade['cidade'] ?>"><?= $cidade['cidade'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label for="pesquisaArea" class="form-label">Área</label><br>
                        <select id="pesquisaArea" multiple="multiple">
                            <?php foreach ($listaAreasCadastradas as $area) { ?>
                                <option value="<?= $area['area'] ?>"><?= $cidade['area'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="pesquisaDisponibilidade" class="form-label">Disponibilidade</label><br>
                        <select id="pesquisaDisponibilidade" multiple="multiple">
                            <?php foreach ($listaStatusDisponibilidades as $status) { ?>
                                <option value="<?= $status['id'] ?>"><?= $status['nome'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <button class="btn btn-primary" id="btnPesquisarFiltros"><i class="fas fa-search"></i> Pesquisar</button>
                        <button class="btn btn-warning"><i class="fas fa-file-excel"></i> Excel</button>
                        <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modalNovaDistribuicao"><i class="fas fa-plus-square"></i> Nova distribuição</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-5 px-2">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm" id="tabelaDistribuicao">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Imei</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Condição</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalNovaDistribuicao" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success"><i class="fas fa-plus-square"></i> Nova distribuição</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <form autocomplete="off">
                                <div class="row">
                                    <div class="col">
                                        <div id="cadastroAlert" class="alert alert-danger d-none" role="alert">
                                            <div id="cadastroMensagem"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="cadastroMatricula" class="form-label">Matrícula*</label>
                                        <input type="number" name="cadastroMatricula" class="form-control form-control-sm" id="cadastroMatricula" placeholder="DIGITE AQUI">
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Colaborador</label>
                                        <input type="text" class="form-control form-control-sm" id="cadastroColaborador" disabled>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="cadastroImei" class="form-label">Aparelho*</label>
                                        <input type="number" name="imei" class="form-control form-control-sm" id="cadastroImei" placeholder="DIGITE O IMEI">
                                        <div class="form-check">
                                            <input type="checkbox" name="cadastroSemAparelho" id="cadastroSemAparelho" class="form-check-input">
                                            <label for="cadastroSemAparelho" class="form-label"><small>Distribuição sem aparelho</small></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Modelo</label>
                                        <input type="text" class="form-control form-control-sm" id="cadastroModelo" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="cadastroLinha" class="form-label">Linha*</label>
                                        <input type="text" name="linha" class="form-control form-control-sm" id="cadastroLinha" placeholder="DIGITE AQUI">
                                        <div class="form-check">
                                            <input type="checkbox" name="cadastroSemLinha" id="cadastroSemLinha" class="form-check-input">
                                            <label for="cadastroSemLinha" class="form-label"><small>Distribuição sem linha</small></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Categoria</label>
                                        <input type="text" class="form-control form-control-sm" id="cadastroCategoria" disabled>
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

<div class="modal fade" id="modalVerAparelho" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-secondary"><i class="fas fa-edit"></i></i> <span id="tituloAparelho"></span></h5>
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
                                        <div id="editaAlert" class="alert alert-danger d-none" role="alert">
                                            <div id="editaMensagem"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="hidden" id="editaIdAparelho" value="">
                                    <div class="col">
                                        <label for="editaImei" class="form-label">IMEI*</label>
                                        <input type="number" name="imei" class="form-control form-control-sm" id="editaImei" disabled>
                                    </div>
                                    <div class="col">
                                        <label for="editaModelo" class="form-label">Modelo*</label>
                                        <input type="text" class="form-control form-control-sm" id="editaModelo" disabled>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="editaMarca" class="form-label">Marca*</label>
                                        <input type="text" class="form-control form-control-sm" id="editaMarca" disabled>
                                    </div>
                                    <div class="col">
                                        <label for="editaStatusCondicaoAparelho" class="form-label">Condição aparelho*</label>
                                        <select class="form-control form-control-sm" id="editaStatusCondicaoAparelho">
                                            <?php foreach ($listaStatusCondicoes as $status) { ?>
                                                <option value="<?= $status['id'] ?>"><?= $status['nome'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="editaNotaFiscal" class="form-label">Nota fiscal</label>
                                        <input type="number" class="form-control form-control-sm" id="editaNotaFiscal" placeholder="DIGITE AQUI">
                                    </div>
                                    <div class="col">
                                        <label for="editaDataNotaFiscal" class="form-label">Data nota fiscal</label>
                                        <input type="date" class="form-control form-control-sm" id="editaDataNotaFiscal">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="editaValorNotaFiscal" class="form-label">Valor nota fiscal R$</label>
                                        <input type="text" class="form-control form-control-sm" id="editaValorNotaFiscal" placeholder="0,00">
                                    </div>
                                    <div class="col">
                                        <label for="editaValorDepreciado" class="form-label">Valor depreciado R$</label>
                                        <input type="text" class="form-control form-control-sm" id="editaValorDepreciado" disabled>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="editaCadastradoPor" class="form-label">Cadastrado por</label>
                                        <input type="text" class="form-control form-control-sm" id="editaCadastradoPor" disabled>
                                    </div>
                                    <div class="col">
                                        <label for="editaValorDisponibilidade" class="form-label">Disponibilidade</label>
                                        <input type="text" class="form-control form-control-sm" id="editaValorDisponibilidade" disabled>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <label for="editaStatus" class="form-label">Status</label><br>
                                        <select class="form-control form-control-sm" id="editaStatus">
                                            <?php foreach (ARRAY_STATUS as $idStatus => $status) { ?>
                                                <option value="<?= $idStatus ?>"><?= $status ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
                <button type="button" class="btn btn-success" id="btnEditarAparelho"><i class="fas fa-save"></i> Salvar</button>
            </div>
        </div>
    </div>
</div>