<?php

namespace App\Http\Livewire;

use App\Events\Enviar;
use App\Models\DetalleOC;
use App\Models\Maquina;
use App\Models\Material;
use App\Models\OrdenesConstruccion;
use App\Models\PausasOC;
use App\Models\TiemposOC;
use DateTime;
use Request;
use Livewire\Component;

class Cronometro extends Component
{
    public $detalleOC;
    public $maquina;
    public $material;
    public $fallidas;
    public $exitosas;
    public $cantidad;
    public $ordenC;
    public $tiempoOC;
    public $idTiempo;
    public $pausa;
    public $estado;
    public $msj;



    protected $listeners = [
        'reset' => 'fin',
        'start' => 'inicio',
        'pausa' => 'pausa',
        'finPausa' => 'finPausa',
        'recarga'
    ];

    public function mount($id)
    {
        $this->msj= '.';
        $idMaq = Request::cookie('maquina');

        $this->maquina = Maquina::where('CodMaquina', $idMaq)->first();
        $this->detalleOC = DetalleOC::find($id);

        if ($this->detalleOC != null) {

            $this->ordenC = OrdenesConstruccion::where('NroOC', $this->detalleOC->NroOC)->first();

            $this->material = Material::where('CodigoMaterial', $this->ordenC->CodigoMaterial)->first();

            $this->cantidadPiezas();
        }
    }

    public function render()
    {
        $idMaq = Request::cookie('maquina');
        $this->maquina = Maquina::where('CodMaquina', $idMaq)->first();
        return view('livewire.cronometro');
        /* if ($this->msj == 'ok') {
        }else{
            return route('horarios.maquinas');
            $this->msj = 'okaa';
        } */
    }

    public function inicio($tiempoStart)
    {
        $idMaq = Request::cookie('maquina');
        $this->maquina = Maquina::where('CodMaquina', $idMaq)->first();

        $numero = TiemposOC::where('idDetalleOC', $this->detalleOC->id)
            ->orderBy('Numero', 'DESC')->first();

        $tiempo = new TiemposOC();
        $tiempo->idDetalleOC = $this->detalleOC->id;
        $tiempo->NroOC = $this->ordenC->NroOC;
        $tiempo->Tiempo = $tiempoStart;
        $tiempo->Estado = 'inicio';
        $tiempo->CodMaquina = $this->maquina->CodMaquina;
        $tiempo->Fecha = date("y-m-d H:i:s");
        $tiempo->idUsuario = auth()->user()->id;

        if ($numero != null) {
            $tiempo->Numero = $numero->Numero + 1;
        } else {
            $tiempo->Numero = 1;
        }

        $tiempo->save();

        $this->tiempoOC = TiemposOC::where('idDetalleOC', $this->detalleOC->id)
            ->where('Numero', $tiempo->Numero)->first();
        $this->idTiempo = $this->tiempoOC->id;
        $this->emit("idTiempo");
        $this->estado = 'inicio';

        event(new Enviar($this->estado));
        //$this->idTiempoOC = $this->tiempoOC->id;
        //$this->emit("guardado", $this->idTiempoOC);
    }

    public function fin($estado, $tiempoPieza)
    {
        if ($this->tiempoOC->id != '0') {
            $tiempo = TiemposOC::find($this->tiempoOC->id);
            if ($tiempo->Estado == 'pausa') {
                $this->finPausa();
            }
            $tiempo->Tiempo = $tiempoPieza;
            $tiempo->Estado = $estado;
            $tiempo->Fecha = date("y-m-d H:i:s");
            $tiempo->save();
        }
        
        $this->cantidadPiezas();
        
        event(new Enviar($this->maquina->CodMaquina));
        
        if ($this->exitosas >= $this->ordenC->Cantidad) {
            $this->msj='ok';
            $detalle = DetalleOC::find($this->detalleOC->id);
            $detalle->Estado = 'finalizado';
            $detalle->save();
            
            return redirect()->route('horarios.maquinas');

        }
    }

    public function pausa($tipo)
    {
        $pausa = new PausasOC();
        $pausa->Tipo = $tipo;
        $pausa->inicio = date("y-m-d H:i:s");
        $pausa->IdDetalleOC = $this->detalleOC->id;
        $pausa->idUsuario = auth()->user()->id;
        $pausa->saveOrFail();
        $this->pausa = $pausa;
        $this->estado = 'pausa';

        if ($this->tiempoOC->id != '0') {
            $tiempo = TiemposOC::find($this->tiempoOC->id);
            $tiempo->Estado = 'pausa';
            $tiempo->save();
            event(new Enviar($this->estado));
        }
    }

    public function finPausa()
    {
        if ($this->estado == 'pausa') {
            $pausa = PausasOC::where('IdDetalleOC', $this->detalleOC->id)
                ->orderBy('id', 'DESC')->first();;
            $pausa->Fin = date("y-m-d H:i:s");
            $pausa->saveOrFail();
            $this->estado = 'inicio';

            if ($this->tiempoOC->id != '0') {
                $tiempo = TiemposOC::find($this->tiempoOC->id);
                $tiempo->Estado = 'inicio';
                $tiempo->save();
                event(new Enviar($this->estado));
            }
        }
    }

    public function cantidadPiezas()
    {
        $fallas = TiemposOC::where('idDetalleOC', $this->detalleOC->id)
            ->where('Estado', 'fallida')->get();
        $exitos = TiemposOC::where('idDetalleOC', $this->detalleOC->id)
            ->where('Estado', 'exitosa')->get();

        $this->fallidas = count($fallas);
        $this->exitosas = count($exitos);

        $this->cantidad = $this->fallidas + $this->exitosas;
    }

    public function recarga($id)
    {
        $this->tiempoOC = TiemposOC::find($id);
        if ($this->tiempoOC != null) {
            $this->idTiempo = $this->tiempoOC->id;
            $this->estado = $this->tiempoOC->Estado;
        }
    }
}
