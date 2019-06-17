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
	/* "<!-- <table id='row-select' class='display table table-borderd table-hover'>
                <thead>
                    <tr>
                        
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </tfoot>
            </table>-->";*/
    $data = "<table id='row-select' class='display table table-borderd table-hover'>";
    $tr = "<thead> <tr>";
    foreach ($tabela->colunas as $coluna) {
   		$tr .= "<th>{$coluna->input_label}</th>";
    }
    $data .= $tr . "</tr> </thead>";
    $tbody = "<tbody>";
    foreach ($rows as $key => $row) {
    	$tr = "<tr>";
	    foreach ($tabela->colunas as $coluna) {
	    	$col = $coluna->coluna;
	    	$tr .= "<td>" . $col . "</td>";
	    }
	    $tr = "<tr>";
	}
    $tbody .= $tr . "</tbody>";
    $data .= $tbody . "</table>";
    return $data;
}