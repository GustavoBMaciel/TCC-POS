<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//cliente
Route::resource('/cadastros/cliente', 'Cadastros\ClienteController');
Route::any('/cadastros/cliente', 'Cadastros\ClienteController@index')->middleware('consultapaciente')->name('cliente.index');
Route::any('/cadastros/cliente/create', 'Cadastros\ClienteController@create')->name('cliente.create');
Route::any('/cadastros/cliente/store', 'Cadastros\ClienteController@store')->name('cliente.store');
Route::any('/cadastros/cliente/show/{id}', 'Cadastros\ClienteController@show')->middleware('proximaconsulta')->name('cliente.show');
Route::any('/cadastros/cliente/destroy/{id}', 'Cadastros\ClienteController@destroy')->name('cliente.destroy');
Route::any('/cadastros/cliente/pesquisa', 'Cadastros\ClienteController@pesquisa')->name('cliente.pesquisa');
Route::any('/cadastros/proxConsulta', 'Cadastros\ClienteController@agendaProxConsulta')->name('cliente.agendaProxConsulta');
Route::get('/cadastros/pdf/cliente/{id}','Cadastros\ClienteController@generatePDF')->name('cliente.pdf');

//Convenio
Route::resource('/cadastros/convenio', 'Cadastros\ConvenioController');
Route::any('/cadastros/convenio/create', 'Cadastros\ConvenioController@create')->middleware('convenios')->name('convenio.create');
Route::any('/cadastros/convenio/edit/{id}', 'Cadastros\ConvenioController@edit')->middleware('convenios')->name('convenio.edit');
Route::any('/cadastros/convenio/destroy/{id}', 'Cadastros\ConvenioController@destroy')->middleware('convenios')->name('convenio.destroy');
Route::any('/cadastros/convenio/pesquisa', 'Cadastros\ConvenioController@pesquisa')->name('convenio.pesquisa');

//tipo
Route::resource('/cadastros/tipo', 'Cadastros\TipoController');
Route::any('/cadastros/tipo/create', 'Cadastros\TipoController@create')->name('tipo.create');
Route::any('/cadastros/tipo/edit/{id}', 'Cadastros\TipoController@edit')->name('tipo.edit');
Route::any('/cadastros/tipo/destroy/{id}', 'Cadastros\TipoController@destroy')->name('tipo.destroy');
Route::any('/cadastros/tipo/pesquisa', 'Cadastros\TipoController@pesquisa')->name('tipo.pesquisa');

//profissao
Route::resource('/cadastros/profissao', 'Cadastros\ProfissaoController');
Route::any('/cadastros/profissao/create', 'Cadastros\ProfissaoController@create')->middleware('profissoes')->name('profissao.create');
Route::any('/cadastros/profissao/edit/{id}', 'Cadastros\ProfissaoController@edit')->middleware('profissoes')->name('profissao.edit');
Route::any('/cadastros/profissao/destroy/{id}', 'Cadastros\ProfissaoController@destroy')->middleware('profissoes')->name('profissao.destroy');
Route::any('/cadastros/profissao/pesquisa', 'Cadastros\ProfissaoController@pesquisa')->middleware('profissoes')->name('profissao.pesquisa');

//fornecedor
Route::resource('/cadastros/fornecedor', 'Cadastros\FornecedorController');
Route::any('/cadastros/fornecedor/create', 'Cadastros\FornecedorController@create')->middleware('fornecedores')->name('fornecedor.create');
Route::any('/cadastros/fornecedor/edit/{id}', 'Cadastros\FornecedorController@edit')->middleware('fornecedores')->name('fornecedor.edit');
Route::any('/cadastros/fornecedor/destroy/{id}', 'Cadastros\FornecedorController@destroy')->middleware('fornecedores')->name('fornecedor.destroy');
Route::any('/cadastros/fornecedor/pesquisa', 'Cadastros\FornecedorController@pesquisa')->middleware('fornecedores')->name('fornecedor.pesquisa');

//tipo agendamento
Route::resource('/cadastros/tbtipoagendamento', 'Cadastros\TipoAgendamentoController');
Route::any('/cadastros/tbtipoagendamento/create', 'Cadastros\TipoAgendamentoController@create')->middleware('tiposagendamento')->name('tbtipoagendamento.create');
Route::any('/cadastros/tbtipoagendamento/edit/{id}', 'Cadastros\TipoAgendamentoController@edit')->middleware('tiposagendamento')->name('tbtipoagendamento.edit');
Route::any('/cadastros/tbtipoagendamento/destroy/{id}', 'Cadastros\TipoAgendamentoController@destroy')->middleware('tiposagendamento')->name('tbtipoagendamento.destroy');
Route::any('/cadastros/tbtipoagendamento/pesquisa', 'Cadastros\TipoAgendamentoController@pesquisa')->middleware('tiposagendamento')->name('tbtipoagendamento.pesquisa');

//status agenda
Route::resource('/cadastros/tbstatusagenda', 'Cadastros\StatusAgendaController');
Route::any('/cadastros/tbstatusagenda/create', 'Cadastros\StatusAgendaController@create')->middleware('statusagenda')->name('tbstatusagenda.create');
Route::any('/cadastros/tbstatusagenda/edit/{id}', 'Cadastros\StatusAgendaController@edit')->middleware('statusagenda')->name('tbstatusagenda.edit');
Route::any('/cadastros/tbstatusagenda/destroy/{id}', 'Cadastros\StatusAgendaController@destroy')->middleware('statusagenda')->name('tbstatusagenda.destroy');
Route::any('/cadastros/tbstatusagenda/pesquisa', 'Cadastros\StatusAgendaController@pesquisa')->middleware('statusagenda')->name('tbstatusagenda.pesquisa');

//acesso
Route::resource('/cadastros/acesso', 'Cadastros\AcessoController');
Route::any('/cadastros/acesso/create', 'Cadastros\AcessoController@create')->name('acesso.create');
Route::any('/cadastros/acesso/edit/{id}', 'Cadastros\AcessoController@edit')->name('acesso.edit');
Route::any('/cadastros/acesso/destroy/{id}', 'Cadastros\AcessoController@destroy')->name('acesso.destroy');
Route::any('/cadastros/acesso/pesquisa', 'Cadastros\AcessoController@pesquisa')->name('acesso.pesquisa');

//exames
Route::resource('/cadastros/exame', 'Cadastros\ExameController');
Route::any('/cadastros/exame/create', 'Cadastros\ExameController@create')->middleware('exames')->name('exame.create');
Route::any('/cadastros/exame/pesquisa', 'Cadastros\ExameController@pesquisa')->middleware('exames')->name('exame.pesquisa');
Route::get('/cadastros/pdf/exames/{id}','Cadastros\TbexamesController@generatePDF')->name('exames.pdf');
Route::any('/cadastros/tbexamesItens','Cadastros\TbexamesController@examesItens')->name('tbexames.tbexamesItens');
Route::resource('/cadastros/tbexames', 'Cadastros\TbexamesController');

//medicamentos
Route::resource('/cadastros/medicamento', 'Cadastros\MedicamentoController');
Route::any('/cadastros/medicamento/create', 'Cadastros\MedicamentoController@create')->middleware('medicamentos')->name('medicamento.create');
Route::any('/cadastros/medicamento/edit/{id}', 'Cadastros\MedicamentoController@edit')->middleware('medicamentos')->name('medicamento.edit');
Route::any('/cadastros/medicamento/destroy/{id}', 'Cadastros\MedicamentoController@destroy')->middleware('medicamentos')->name('medicamento.destroy');
Route::any('/cadastros/medicamento/pesquisa', 'Cadastros\MedicamentoController@pesquisa')->middleware('medicamentos')->name('medicamento.pesquisa');
Route::get('/cadastros/pdf/medicamentos/{id}','Cadastros\TbmedicamentosController@generatePDF')->name('medicamentos.pdf');
Route::any('/cadastros/tbmedicamentosItens','Cadastros\TbmedicamentosController@medicamentosItens')->name('tbmedicamentos.tbmedicamentosItens');
Route::resource('/cadastros/tbmedicamentos', 'Cadastros\TbmedicamentosController');

//agenda
Route::resource('/cadastros/agenda', 'Cadastros\AgendaController');
Route::any('/cadastros/agenda/create', 'Cadastros\AgendaController@create')->middleware('agendamentos')->name('agenda.create');
Route::any('/cadastros/agenda/edit/{id}', 'Cadastros\AgendaController@edit')->middleware('alteraragendamentos')->name('agenda.edit');
Route::any('/cadastros/agenda/destroy/{id}', 'Cadastros\AgendaController@destroy')->middleware('excluiragendamentos')->name('agenda.destroy');
Route::any('/cadastros/agenda/pesquisa', 'Cadastros\AgendaController@pesquisa')->name('agenda.pesquisa');

//profissional
Route::resource('/cadastros/profissional', 'Cadastros\ProfissionalController');
Route::any('/cadastros/profissional/create', 'Cadastros\ProfissionalController@create')->name('profissional.create');
Route::any('/cadastros/profissional/edit/{id}', 'Cadastros\ProfissionalController@edit')->name('profissional.edit');
Route::any('/cadastros/profissional/destroy/{id}', 'Cadastros\ProfissionalController@destroy')->name('profissional.destroy');
Route::any('/cadastros/profissional/pesquisa', 'Cadastros\ProfissionalController@pesquisa')->name('profissional.pesquisa');

//caixa
Route::resource('/cadastros/caixa', 'Cadastros\CaixaController');
Route::any('/cadastros/caixa/create', 'Cadastros\CaixaController@create')->middleware('caixa')->name('caixa.create');
Route::any('/cadastros/caixa/destroy/{id}', 'Cadastros\CaixaController@destroy')->middleware('caixa')->name('caixa.destroy');
Route::any('/cadastros/caixa/pesquisa', 'Cadastros\CaixaController@pesquisa')->middleware('caixa')->name('caixa.pesquisa');

//contas a receber
Route::resource('/cadastros/conrec', 'Cadastros\ConrecController');
Route::any('/cadastros/conrec/create', 'Cadastros\ConrecController@create')->middleware('receber')->name('conrec.create');
Route::any('/cadastros/conrec/destroy/{id}', 'Cadastros\ConrecController@destroy')->middleware('receber')->name('conrec.destroy');
Route::any('/cadastros/conrec/pesquisa', 'Cadastros\ConrecController@pesquisa')->middleware('receber')->name('conrec.pesquisa');

//contas a pagar
Route::resource('/cadastros/conpag', 'Cadastros\ConpagController');
Route::any('/cadastros/conpag/create', 'Cadastros\ConpagController@create')->middleware('pagar')->name('conpag.create');;
Route::any('/cadastros/conpag/destroy/{id}', 'Cadastros\ConpagController@destroy')->middleware('pagar')->name('conpag.destroy');
Route::any('/cadastros/conpag/pesquisa', 'Cadastros\ConpagController@pesquisa')->middleware('pagar')->name('conpag.pesquisa');

//cid10
Route::resource('/cadastros/cid10', 'Cadastros\CID10Controller');

//permissao
Route::resource('/cadastros/permissao', 'Cadastros\PermissaoController');
Route::any('/cadastros/permissaoConsulta', 'Cadastros\PermissaoController@consulta')->name('permissao.consulta');

//anamnese
Route::resource('/cadastros/anamnese', 'Cadastros\AnamneseController');
Route::any('/cadastros/anamnese/create', 'Cadastros\AnamneseController@create')->middleware('anamneses');
Route::get('/cadastros/pdf/anamnese/{id}','Cadastros\AnamneseController@generatePDF')->name('anamnese.pdf');











