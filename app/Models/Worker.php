<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'dni',
        'fecha_nacimiento',
        'sexo',
        'cantidad_hijos',
        'area',
        'cargo',
        'fecha_ingreso',
        'sueldo',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_ingreso' => 'date',
        'sueldo' => 'decimal:2',
        'cantidad_hijos' => 'integer',
    ];

    /**
     * Obtener el nombre completo del trabajador
     */
    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombres} {$this->apellido_paterno} {$this->apellido_materno}";
    }

    /**
     * Calcular la asignación familiar
     * S/ 102.50 si tiene uno o más hijos
     */
    public function getAsignacionFamiliarAttribute(): float
    {
        return $this->cantidad_hijos > 0 ? 102.50 : 0.00;
    }

    /**
     * Calcular AFP - Aportación Obligatoria (10%)
     */
    public function getAfpAportacionAttribute(): float
    {
        return round($this->sueldo * 0.10, 2);
    }

    /**
     * Calcular AFP - Comisión (2.5%)
     */
    public function getAfpComisionAttribute(): float
    {
        return round($this->sueldo * 0.025, 2);
    }

    /**
     * Calcular Renta de 5ta Categoría (10%)
     */
    public function getRentaQuintaAttribute(): float
    {
        return round($this->sueldo * 0.10, 2);
    }

    /**
     * Descuento EPS (monto fijo)
     */
    public function getEpsAttribute(): float
    {
        return 100.00;
    }

    /**
     * Calcular el total de descuentos
     */
    public function getTotalDescuentosAttribute(): float
    {
        return round(
            $this->afp_aportacion + 
            $this->afp_comision + 
            $this->renta_quinta + 
            $this->eps,
            2
        );
    }

    /**
     * Calcular el sueldo bruto (sueldo + asignación familiar)
     */
    public function getSueldoBrutoAttribute(): float
    {
        return round($this->sueldo + $this->asignacion_familiar, 2);
    }

    /**
     * Calcular el sueldo neto
     * Sueldo + Asignación Familiar - Descuentos
     */
    public function getSueldoNetoAttribute(): float
    {
        return round($this->sueldo_bruto - $this->total_descuentos, 2);
    }

    /**
     * Obtener el detalle completo del cálculo de sueldo
     */
    public function getDetalleCalculoAttribute(): array
    {
        return [
            'sueldo_base' => $this->sueldo,
            'asignacion_familiar' => $this->asignacion_familiar,
            'sueldo_bruto' => $this->sueldo_bruto,
            'descuentos' => [
                'afp_aportacion' => $this->afp_aportacion,
                'afp_comision' => $this->afp_comision,
                'renta_quinta' => $this->renta_quinta,
                'eps' => $this->eps,
                'total' => $this->total_descuentos,
            ],
            'sueldo_neto' => $this->sueldo_neto,
        ];
    }
}
