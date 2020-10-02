<?php

namespace App\Imports;

use App\Price;
use App\Estacion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Mail;

class PriceImport implements ToModel, WithHeadingRow
{
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }
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

        if(count($estacion_select) > 0 ){

            $precio_con_utilidad_r = $row['extra'] - ($estacion_select[0]->utilidad_r + ($estacion_select[0]->utilidad_r * 0.16));
            $precio_con_utilidad_p = $row['supreme'] - ($estacion_select[0]->utilidad_p + ($estacion_select[0]->utilidad_p * 0.16));
            $precio_con_utilidad_d = $row['diesel'] - ($estacion_select[0]->utilidad_d + ($estacion_select[0]->utilidad_d * 0.16));
            $subject = "Precios del día de mañana";

            // for($i=0; $i<count($estacion_select[0]->users); $i++){
            //     $for = $estacion_select[0]->users[$i]->email;
            //     // $for = "andrees0801@gmail.com";
            //     Mail::send('mail.prices',$row, function($msj) use($subject, $for){
            //         $msj->from("pruebamobil@lealtaddigitalsoft.mx","Mobil");
            //         $msj->subject($subject);
            //         $msj->to($for);
            //     });
            // }

            //dd(Price::find($estacion_select[0]->id));

            return new price([
                'id_estacion' => $estacion_select[0]->id,
                'extra' => $row['extra'],
                'supreme' => $row['supreme'],
                'diesel' => $row['diesel'],
                'extra_u' => $precio_con_utilidad_r,
                'supreme_u' => $precio_con_utilidad_p,
                'diesel_u' => $precio_con_utilidad_d,
                'created_at' => $this->data[0],
            ]);

        }else{
            return null;
        }
    }
}
