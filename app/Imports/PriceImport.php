<?php

namespace App\Imports;

use App\Price;
use App\Estacion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Mail;

class PriceImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!isset($row['cre'])) {
            return null;
        }
        
        $estacion_select = Estacion::where('cre', $row['cre'])->get();
        
        $precio_con_utilidad_r = $row['extra'] - ($estacion_select[0]->utilidad_r + ($estacion_select[0]->utilidad_r * 0.16));
        $precio_con_utilidad_p = $row['supreme'] - ($estacion_select[0]->utilidad_p + ($estacion_select[0]->utilidad_p * 0.16));
        $precio_con_utilidad_d = $row['diesel'] - ($estacion_select[0]->utilidad_d + ($estacion_select[0]->utilidad_d * 0.16));
        
        $subject = "Precios del día de mañana";

        for($i=0; $i<count($estacion_select[0]->users); $i++){
            $for = $estacion_select[0]->users[$i]->email;
            // $for = "l4l0_love@hotmail.com";
            Mail::send('mail.prices',$row, function($msj) use($subject, $for){
                $msj->from("pruebamobil@lealtaddigitalsoft.mx","Mobil");
                $msj->subject($subject);
                $msj->to($for);
            });
        }
        

        return new price([
            'id_estacion' => $estacion_select[0]->id,
            'extra' => $row['extra'],
            'supreme' => $row['supreme'],
            'diesel' => $row['diesel'],
            'extra_u' => $precio_con_utilidad_r,
            'supreme_u' => $precio_con_utilidad_p,
            'diesel_u' => $precio_con_utilidad_d,
        ]);
    }
}
