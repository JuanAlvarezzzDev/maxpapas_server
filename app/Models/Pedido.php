<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function metodoPago()
    {
        return $this->belongsTo(PaymentPedido::class, 'metodo_pago');
    }
    
    public function state(){
        return $this->belongsTo(StatePedido::class, 'state_pedido_id');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'pedido_productos')->withPivot('detalle', 'cantidad', 'envio', 'comentario', 'totalCombo');
    }
}
