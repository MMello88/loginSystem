<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*function now() {
    return date('Y-m-d H:i:s');
}*/

function my_checkbox($coluna, $valor = ''){
    return "
        <div class='form-group'>
            <div class='col-offset-2 col-12'>
                <div class='checkbox'>
                    <label>
                        <input type='$coluna->input_type' name='$coluna->coluna' value-'$valor'> $coluna->input_label
                    </label>
                </div>
            </div>
        </div>";
}

function my_input($coluna, $valor = ''){
    if($coluna->input_type == 'checkbox')
        return my_checkbox($coluna, $valor);
    if($coluna->input_type == 'hidden')
        return "<input type='$coluna->input_type' name='$coluna->coluna' value='$valor' class='form-control' placeholder='$coluna->input_label'>";
    return "
    <div class='form-group'>
        ".my_label($coluna)."
        <div class='col-12'>
            <input type='$coluna->input_type' name='$coluna->coluna' value='$valor' class='form-control' placeholder='$coluna->input_label'>
        </div>
    </div>";
}

function my_label($coluna){
    if ($coluna->input_type == 'hidden')
        return "";
	return "<label class='col-2 control-label'>$coluna->input_label</label>";
}

function my_form($tabela, $consulta = ''){
    $funcao = empty($consulta) ? "cadastrar" : "editar";
    $form = "
        <section id='main-content'>
            <div class='row'>
                <div class='col-12'>
                    <div class='card'>
                        <div class='card-title'>
                            <h4>$tabela->label</h4>
                        </div>
                        <div class='card-body'>
                            <div class='basic-form'>
                                ".form_open("Dashboard/Cadastro/$funcao", ["class" => "form-horizontal", "id" => "formCadastro"])."
									<input type='hidden' name='_url' value='$tabela->url'>
    ";
    foreach($tabela->colunas as $coluna){
        if (!empty($consulta))
            $form .= my_input($coluna, $consulta->{$coluna->coluna});
        else
            $form .= my_input($coluna);
    }
    $form .= "
                                    <div class='form-group'>
                                        <div class='col-sm-offset-2 col-sm-12'>
                                            <button type='button' class='btn btn-default float-right' id='btnCadSalvar'>Salvar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    ";
    
    return $form;
}

function my_modal($tabela, $consulta = ''){
    $funcao = empty($consulta) ? "Cadastrar" : "Alterar";
    return "
        <div class='modal-content'>
            <div class='modal-header'>
                <h3>$funcao $tabela->label</h3>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                ".my_form($tabela, $consulta)."
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
            </div>
        </div>
    ";
}

function my_data_table($tabela, $rows){
    if(!empty($tabela)){
        $data = "<table id='rowselect' class='display table table-borderd table-hover mb-5' style='width:100%'>";
        $tr = "<thead> <tr>";
        foreach ($tabela->colunas as $coluna) {
            $tr .= "<th>{$coluna->input_label}</th>";
        }
        $data .= $tr . "<th> x </th> </tr> </thead>";
        $tbody = "<tbody>";
        $tr = "";
        foreach ($rows as $key => $row) {
            $tr .= "<tr>";
            
            foreach ($tabela->colunas as $coluna){
                $col = $coluna->coluna;
                $tr .= "<td>" . $row->$col . "</td>";

                if($coluna->primary == '1'){
                    $arr_primary = ['url' => $tabela->url, 'id_tabela' => $tabela->id_tabela, 'campo' => $coluna->coluna, 'valor' => $row->$col];
                }
            }
            $tr .= "<td>
                        <div class='btn-group'>
                            <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                Action
                            </button>
                            <div class='dropdown-menu'>
                                <a class='dropdown-item' href='#' data-toggle='modal' data-target='#edt' data-table='{$arr_primary['id_tabela']}' data-cp='{$arr_primary['campo']}' data-idp='{$arr_primary['valor']}'>Editar</a>
                                <a class='dropdown-item' href='#' data-toggle='modal' data-target='#del' data-url='{$arr_primary['url']}' data-table='{$arr_primary['id_tabela']}' data-cp='{$arr_primary['campo']}' data-idp='{$arr_primary['valor']}'>Remover</a>
                                <div class='dropdown-divider'></div>
                                <a class='dropdown-item' href='#'>Registro Filho</a>
                            </div>
                        </div>
                    </td>";

            $tr .= "</tr>";
        }
        $tbody .= $tr . "</tbody>";
        $data .= $tbody . "</table>";
        return $data;
    }
    return null;
}