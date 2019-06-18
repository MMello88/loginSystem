<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*function now() {
    return date('Y-m-d H:i:s');
}*/

function my_input($coluna){

}

function my_label($coluna){
	
}

function my_form($tabela){
	
}

function my_data_table($tabela, $rows){
    if(!empty($tabela)){
        $data = "<table id='row-select' class='display table table-borderd table-hover'>";
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
                    $tr .= "<td>Editar" . $row->$col . "</td>";
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