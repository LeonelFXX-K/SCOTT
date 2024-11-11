<?php

namespace App\Livewire\App\Reports;

use Livewire\Component;
use App\Models\Report;

class ReportMomentlyTable extends Component
{
    // Escucha el evento 'reportCreated' para actualizar la lista de reportes
    protected $listeners = ['reportCreated' => 'updateReports'];

    public $reports;

    public function mount()
    {
        // Obtén los reportes de tipo 'Momentary' al cargar el componente
        $this->reports = Report::where('type', 'Momentary')
            ->with(['reportDetails', 'reportedBy'])
            ->get();
    }

    public function updateReports()
    {
        // Actualiza los reportes al recibir el evento
        $this->reports = Report::where('type', 'Momentary')
            ->with(['reportDetails', 'reportedBy'])
            ->get();
    }

    public function render()
    {
        return view('livewire.app.reports.report-momently-table', [
            'reports' => $this->reports, // Pasa la lista de reportes actualizada
        ]);
    }
}

