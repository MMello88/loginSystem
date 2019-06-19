<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*function now() {
    return date('Y-m-d H:i:s');
}*/

function my_checkbox($coluna, $valor = ''){
    return "
        <div class='form-group'>
            <div class='col-offset-2 col-10'>
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
    return "
    <div class='form-group'>
        ".my_label($coluna)."
        <div class='col-10'>
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
    $funcao = empty($consulta) ? "inserir" : "alterar";
    $form = "
        <section id='main-content'>
            <div class='row'>
                <div class='col-lg-6'>
                    <div class='card'>
                        <div class='card-title'>
                            <h4>$tabela->label</h4>
                            
                        </div>
                        <div class='card-body'>
                            <div class='horizontal-form'>
                                ".form_open("Dashboard/Cadastro/$funcao", ["class" =>"form-horizontal"])."
    ";
    foreach($tabela->colunas as $coluna){
        if (!empty($consulta))
            $form .= my_input($coluna, $consulta->$coluna->coluna);
        else
            $form .= my_input($coluna);
    }
    $form .= "
                                    <div class='form-group'>
                                        <div class='col-sm-offset-2 col-sm-10'>
                                            <button type='submit' class='btn btn-default'>Salvar</button>
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

function my_data_table($tabela, $rows){
    if(!empty($tabela)){
        $data = "<table id='row-select' class='display table table-borderd table-hover mb-5'>";
        $tr = "<thead> <tr>";
        foreach ($tabela->colunas as $coluna) {
            $tr .= "<th>{$coluna->input_label}</th>";
        }
        $data .= $tr . "<th> x </th> </tr> </thead>";
        $tbody = "<tbody>";
        foreach ($rows as $key => $row) {
            $tr = "<tr>";
            
            foreach ($tabela->colunas as $coluna){
                $col = $coluna->coluna;
                $tr .= "<td>" . $row->$col . "</td>";
            }

            foreach ($tabela->colunas as $coluna){
                $col = $coluna->coluna;
                if($coluna->primary == '1'){
                    $tr .= "<td>
                                <div class='btn-group'>
                                    <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                        Action
                                    </button>
                                    <div class='dropdown-menu'>
                                        <a class='dropdown-item' href='#' id='edt' data-table='{$tabela->id_tabela}' data-id_primary='{$row->$col}'>Editar</a>
                                        <a class='dropdown-item' href='#' id='del' data-table='{$tabela->id_tabela}' data-id_primary='{$row->$col}'>Remover</a>
                                        <div class='dropdown-divider'></div>
                                        <a class='dropdown-item' href='#'>Registro Filho</a>
                                    </div>
                                </div>
                            </td>";
                }
            }
            $tr .= "<tr>";
        }
        $tbody .= $tr . "</tbody>";
        $data .= $tbody . "</table>";
        return $data;
    }
    return null;
}