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
                                <option value="<?= $area['area'] ?>"><?= $area['area'] ?></option>
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
                        <?php if (!$this->session->dadosUsuario['somente_leitura']) { ?>
                        <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modalNovaDistribuicao"><i class="fas fa-plus-square"></i> Nova distribuição</button>
                    <?php } ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-5 px-2">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm" id="tabelaDistribuicao">
                <thead class="table bg-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Linha</th>
                        <th scope="col">Colaborador</th>
                        <th scope="col">Centro de custo</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">Disponibilidade</th>
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
                                        <input type="text" name="cadastroMatricula" class="form-control form-control-sm" id="cadastroMatricula" placeholder="DIGITE AQUI">
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Colaborador</label>
                                        <input type="text" class="form-control form-control-sm" id="cadastroColaborador" disabled>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="cadastroImei" class="form-label">Aparelho*</label>
                                        <input type="number" name="cadastroImei" class="form-control form-control-sm" id="cadastroImei" placeholder="DIGITE O IMEI">
                                        <div class="form-check">
                                            <input type="checkbox" name="cadastroSemAparelho" id="cadastroSemAparelho" value="1" class="form-check-input">
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
                                        <input type="text" name="cadastroLinha" class="form-control form-control-sm" id="cadastroLinha" placeholder="DIGITE AQUI">
                                        <div class="form-check">
                                            <input type="checkbox" name="cadastroSemLinha" id="cadastroSemLinha" value="1" class="form-check-input">
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
                <button type="button" class="btn btn-success" id="btnSalvarDistribuicao"><i class="fas fa-save"></i> Salvar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalVerDistribuicao" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-secondary"><i class="fas fa-edit"></i></i> <span id="tituloDistribuicao"></span></h5>
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
                                    <input type="hidden" id="editaIdDistribuicao" value="">
                                    <div class="col">
                                        <label for="idColaborador" class="form-label">Matricula</label>
                                        <input type="number" class="form-control form-control-sm" id="idColaborador" disabled>
                                    </div>
                                    <div class="col">
                                        <label for="nomeColaborador" class="form-label">Colaborador</label>
                                        <input type="text" class="form-control form-control-sm" id="nomeColaborador" disabled>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="editaImei" class="form-label">IMEI</label>
                                        <input type="number" class="form-control form-control-sm" id="editaImei" disabled>
                                    </div>
                                    <div class="col">
                                        <label for="editaModelo" class="form-label">Modelo</label>
                                        <input type="text" class="form-control form-control-sm" id="editaModelo" disabled>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="editaNumeroLinha" class="form-label">Número da linha</label>
                                        <input type="text" class="form-control form-control-sm" id="editaNumeroLinha" disabled>
                                    </div>
                                    <div class="col">
                                        <label for="editaCategoria" class="form-label">Categoria</label>
                                        <input type="text" class="form-control form-control-sm" id="editaCategoria" disabled>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="editaCentroCusto" class="form-label">Centro de custo</label>
                                        <input type="text" class="form-control form-control-sm" id="editaCentroCusto" disabled>
                                    </div>
                                    <div class="col">
                                        <label for="editaCidade" class="form-label">Cidade</label>
                                        <input type="text" class="form-control form-control-sm" id="editaCidade" disabled>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="alert alert-primary text-center" role="alert">
                                Registro de alteração
                            </div>
                            <table class="table bg-light">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Usuário</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Data</th>
                                    </tr>
                                </thead>
                                <tbody id="logDistribuicao">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
                <?php if (!$this->session->dadosUsuario['somente_leitura']) { ?>
                <button type="button" class="btn btn-success" id="btnFecharDistribuicao"><i class="fas fa-check-circle"></i> Fechar distribuição</button>
            <?php } ?>
            </div>
        </div>
    </div>
</div>