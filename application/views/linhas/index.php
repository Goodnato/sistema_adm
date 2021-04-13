<!-- Painel de filtros de linhas -->
    <div class="container-fluid">
                <div class="row justify-content-center mt-5">
                    <div class="col-6 p-3" style="background-color: #FAFBFC;">
                        <form>
                            <div class="row">
                                <div class="col-12">
                                    <h1 class="text-center">Linhas</h1>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="pesquisaNumero" class="form-label">Número da Linha</label>
                                    <input type="text" class="form-control" id="pesquisaNumero" placeholder="DIGITE AQUI">
                                </div>
                                <div class="col">
                                    <label for="pesquisaCodigoChip" class="form-label">Código do Chip</label>
                                    <input type="text" class="form-control" id="pesquisaCodigoChip" placeholder="DIGITE AQUI">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <label for="pesquisaCategoria" class="form-label">Categoria</label>
                                        <select id="pesquisaCategoria" multiple="multiple">
                                            <?php foreach ($listaCategorias as $categoria) { ?>
                                                <option value="<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></option>
                                            <?php } ?>
                                        </select>
                                </div>
                                <div class="col-6">
                                    <label for="pesquisaCadastradoPor" class="form-label">Cadastrado por</label><br>
                                    <select id="pesquisaCadastradoPor" multiple="multiple">
                                        <?php foreach ($listaUsuariosCadastroLinha as $cadastradoPor) { ?>
                                            <option value="<?= $cadastradoPor['id'] ?>"><?= $cadastradoPor['nome'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <label for="pesquisaDisponibilidade" class="form-label">Disponibilidade</label><br>
                                    <select id="pesquisaDisponibilidade" multiple="multiple">
                                        <?php foreach ($listaStatusDisponibilidades as $status) { ?>
                                            <option value="<?= $status['id'] ?>"><?= $status['nome'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="pesquisaStatusLinha" class="form-label">Status</label><br>
                                    <select id="pesquisaStatusLinha" multiple="multiple">
                                        <?php foreach (ARRAY_STATUS as $idStatus => $status) { ?>
                                            <option value="<?= $idStatus ?>"><?= $status ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <button class="btn btn-primary" id="btnPesquisarFiltros"><i class="fas fa-search"></i> Pesquisar</button>
                                    <button class="btn btn-warning"><i class="fas fa-file-excel"></i> Excel</button>
                                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modalNovaLinha"><i class="fas fa-plus-square"></i> Nova Linha</button>
                                    <!-- botão do modal botão do modal /// ids do modal => data-toggle="modal" data-target="#exampleModal" -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- tabela -->
                <div class="row mt-5 px-2">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-sm" id="tabelaLinhas">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Número da Linha</th>
                                <th scope="col">Código do Chip</th>
                                <th scope="col">Categoria</th>
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

    <!-- modal cadastrar linhas-->
    <div class="modal fade" id="modalNovaLinha" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel"><i class="fas fa-plus-square"></i> Nova Linha</h5>
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
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <label for="cadastroNumero" class="form-label">Número da Linha</label>
                                            <input type="text" class="form-control form-control-sm" id="cadastroNumero" placeholder="DIGITE AQUI">
                                        </div>
                                        <div class="col-6">
                                            <label for="cadastroCodigoChip" class="form-label">Código do Chip</label>
                                            <input type="text" class="form-control form-control-sm" id="cadastroCodigoChip" placeholder="DIGITE AQUI">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <label for="cadastroCategoria" class="form-label">Categoria</label>
                                            <select class="form-control form-control-sm" id="cadastroCategoria">
                                                <option value>SELECIONE</option>
                                                <?php foreach ($listaCategoriasAtivas as $categoria) { ?>
                                                    <option value="<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label for="cadastroOperadora" class="form-label">Operadoras</label>
                                            <select class="form-control form-control-sm" id="cadastroOperadora">
                                                <option value>SELECIONE</option>
                                                <?php foreach ($listaOperadorasAtivas as $operadora) { ?>
                                                    <option value="<?= $operadora['id'] ?>"><?= $operadora['nome'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <label for="cadastroPinPuk1" class="form-label">PIN-PUK1</label>
                                            <input type="text" class="form-control form-control-sm" id="cadastroPinPuk1" placeholder="DIGITE AQUI">
                                        </div>
                                        <div class="col-6">
                                        <label for="cadastroPinPuk2" class="form-label">PIN-PUK2</label>
                                            <input type="text" class="form-control form-control-sm" id="cadastroPinPuk2" placeholder="DIGITE AQUI">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
                    <button type="button" class="btn btn-success" id="btnSalvarLinha"><i class="fas fa-save"></i> Cadastrar </button>
                </div>
            </div>
        </div>
    </div>

     <!-- modal cadastrar linhas-->
    <div class="modal fade" id="modalVerLinha" tabindex="-1">
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
                                        <div id="cadastroAlert" class="alert alert-danger d-none" role="alert">
                                            <div id="editaMensagem"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
    <script>
        const statusCondicaoAparelho = <?= json_encode($listaStatusCondicoes); ?>
    </script>
